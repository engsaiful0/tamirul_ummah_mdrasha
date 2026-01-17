<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Modules\RolePermission\Entities\InfixRole;
use Modules\RolePermission\Entities\Permission;
use Modules\RolePermission\Entities\InfixModuleInfo;
use Modules\RolePermission\Entities\InfixPermissionAssign;
use Modules\RolePermission\Entities\InfixModuleStudentParentInfo;
use Illuminate\Support\Facades\DB;

class UserRolePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $route = null)
    {
       if (!Auth::guard('web')->check()) {
            return redirect()->route('login');
        }

        $permissions =  app('permission');
       

        if(auth()->user()->role_id == 3 && Cache::get('have_due_fees_'.auth()->user()->id)){
            $url = explode('/',$request->getRequestUri());
            $param = end($url);
            $students = Cache::get('have_due_fees_'.auth()->user()->id);
            
            if(in_array($param, $students) && ! in_array(Route::currentRouteName(), ["parent_fees", "fees.student-fees-list-parent"]) ){
               
                abort(403);
            }else{
                return $next($request);
            }
        }
       
        // Special handling for sorting-student-section-list route: allow teachers assigned to class/section
        // Check this BEFORE hasPermission to avoid early abort
        if ($route == 'unassigned_student' && Auth::user()->role_id == 4) {
            // Check if this is the sorting-student-section-list route by URL pattern
            $path = $request->path();
            $isSortingSectionRoute = preg_match('/sorting-student-section-list\/(\d+)\/(\d+)/', $path, $matches);
            
            if ($isSortingSectionRoute) {
                // Extract class_id and section_id from URL
                $class_id = $matches[1];
                $section_id = $matches[2];
                
                // Also try to get from route parameters as fallback
                if (!$class_id) $class_id = $request->route('class_id');
                if (!$section_id) $section_id = $request->route('section_id');
            
                if ($class_id && $section_id && Auth::user()->staff) {
                    $teacher_id = Auth::user()->staff->id;
                    $academic_id = getAcademicId();
                    
                    // Check if teacher is assigned to this class/section
                    // First try with all conditions including active_status and academic_id
                    $query = DB::table('sm_class_teachers')
                        ->join('sm_assign_class_teachers', 'sm_assign_class_teachers.id', '=', 'sm_class_teachers.assign_class_teacher_id')
                        ->where('sm_class_teachers.teacher_id', $teacher_id)
                        ->where('sm_assign_class_teachers.class_id', $class_id)
                        ->where('sm_assign_class_teachers.section_id', $section_id)
                        ->where('sm_assign_class_teachers.school_id', Auth::user()->school_id)
                        ->where('sm_assign_class_teachers.active_status', 1)
                        ->where('sm_class_teachers.active_status', 1);
                    
                    if ($academic_id) {
                        $query->where('sm_assign_class_teachers.academic_id', $academic_id);
                    }
                    
                    $isAssigned = $query->exists();
                    
                    // If not found with academic_id, try without it
                    if (!$isAssigned && $academic_id) {
                        $query2 = DB::table('sm_class_teachers')
                            ->join('sm_assign_class_teachers', 'sm_assign_class_teachers.id', '=', 'sm_class_teachers.assign_class_teacher_id')
                            ->where('sm_class_teachers.teacher_id', $teacher_id)
                            ->where('sm_assign_class_teachers.class_id', $class_id)
                            ->where('sm_assign_class_teachers.section_id', $section_id)
                            ->where('sm_assign_class_teachers.school_id', Auth::user()->school_id)
                            ->where('sm_assign_class_teachers.active_status', 1)
                            ->where('sm_class_teachers.active_status', 1);
                        
                        $isAssigned = $query2->exists();
                    }
                    
                    if ($isAssigned) {
                        return $next($request);
                    }
                }
            }
        }
        
        if(!$this->hasPermission($route)){
            abort(403);
        }
        
        if( (! is_null($permissions)) && (Auth::user()->role_id != 1) ){
           
            if( in_array($route , $permissions )){
                return $next($request);
            }
            else{
                abort('403');
            }
        }else{
            return $next($request);
        }
    }

    public function hasPermission($route){
        $permissions = Permission::with(['subModule'])->get();
        $parent_module = $permissions->where('route', $route)->first();
        if(!$parent_module){
            foreach($permissions as $permission){
                $children_module = $permission->subModule->where('route', $route)->first();
                if($children_module){
                    $parent_module = $permission;
                    break;
                }
            }
        }

        if($parent_module){
            $parent_module_id = $parent_module->id;
            // get permission name
            $school_permissions = planPermissions('menus', true);
            $key = false;
            foreach($school_permissions as $permission => $id){
                if($id == $parent_module_id){
                    $key = $permission;
                    break;
                }
            }

            if($key) {
                return isMenuAllowToShow($key);
            }
        }
        return true;
    }
}