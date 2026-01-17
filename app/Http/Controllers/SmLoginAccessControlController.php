<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\SmClass;
use App\SmStaff;
use App\SmParent;
use App\SmStudent;
use App\YearCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\StudentRecord;
use App\SmSection;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\RolePermission\Entities\InfixRole;

class SmLoginAccessControlController extends Controller
{
    public function __construct()
    {
        $this->middleware('PM');
        // User::checkAuth();
    }


    public function loginAccessControl()
    {

        try {
            $roles = InfixRole::where('id', '!=', 1)->where(function ($q) {
                $q->where('school_id', Auth::user()->school_id)->orWhere('type', 'System');
            })->orderBy('name', 'asc')->get();
            $classes = SmClass::get();

            return view('backEnd.systemSettings.login_access_control', compact('roles', 'classes'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function searchUser(Request $request)
    {

        if ($request->role == "") {
            $request->validate([
                'role' => 'required'
            ]);
        }
        
        // elseif ($request->role == "2") {
        //     $request->validate([
        //         'role' => 'required',
        //         'class' => 'required',
        //     ]);
        // }

        

        try {
            $role = $request->role;
            $roles = InfixRole::where('id', '!=', 1)->where(function ($q) {
                $q->where('school_id', Auth::user()->school_id)->orWhere('type', 'System');
            })->orderBy('name', 'asc')->get();
            $classes = SmClass::get();
            $students = SmStudent::query();
            $class = SmClass::find($request->class);
            $section = SmSection::find($request->section);
            $records = StudentRecord::query();
            if ($request->role == "2") {
                if (moduleStatusCheck('University')) {
                    $records = universityFilter($records, $request)->where('is_promote', 0);
                    $student_ids = $records->get('student_id')->toArray();
                    $students->whereIn('id', $student_ids);
                }else{
                    
                    $students->with(['parents', 'user','parents.parent_user', 'studentRecords' => function($q) use($request){
                        return $q->where('class_id', $request->class)->when($request->section, function($q) use($request){
                            $q->where('section_id', $request->section);
                        })->where('school_id', auth()->user()->school_id);
                    }])->whereHas('studentRecords', function($q) use($request){
                        return $q->where('class_id', $request->class)->when($request->section, function($q) use($request){
                            $q->where('section_id', $request->section);
                        })->where('school_id', auth()->user()->school_id);
                    });
                }

                $students->where('active_status', 1)
                ->where('school_id', auth()->user()->school_id);
                
                $students = $students->get();
               

                return view('backEnd.systemSettings.login_access_control', compact('students', 'role', 'roles', 'classes', 'class', 'section'));
            } elseif ($request->role == "3") {
                $parents = SmParent::with('parent_user')->where('active_status', 1)->where('school_id', Auth::user()->school_id)->get();
                return view('backEnd.systemSettings.login_access_control', compact('parents', 'role', 'roles', 'classes'));
            } else {
                $staffs = SmStaff::with('staff_user','roles')->where(function($q) use ($request) {
                    $q->where('role_id', $request->role)->orWhere('previous_role_id', $request->role);
                })->get();
                return view('backEnd.systemSettings.login_access_control', compact('staffs', 'role', 'roles', 'classes'));
            }
            return view('backEnd.systemSettings.login_access_control', compact('roles', 'classes'));
        } catch (\Exception $e) {
           
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function loginAccessPermission(Request $request)
    {
        try {
            // Validate that id is provided and not empty
            if (empty($request->id) || !$request->id) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User ID is required'
                ], 400);
            }

            // Determine status
            if ($request->status == 'on') {
                $status = 1;
            } else {
                $status = 0;
            }

            // Find user and check if exists
            $user = User::find($request->id);
            
            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found'
                ], 404);
            }

            // Update access status
            $user->access_status = $status;
            $user->save();

            return response()->json([
                'status' => $request->status, 
                'users' => $user->access_status,
                'message' => 'Access status updated successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Login Access Permission Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Operation Failed: ' . $e->getMessage()
            ], 500);
        }
    }


    public function loginPasswordDefault(Request $request)
    {
        try {
            // Validate that id is provided and not empty
            if (empty($request->id) || !$request->id) {
                return response()->json([
                    'op' => FALSE,
                    'msg' => 'User ID is required'
                ], 400);
            }

            // Find user and check if exists
            $user = User::find($request->id);
            
            if (!$user) {
                return response()->json([
                    'op' => FALSE,
                    'msg' => 'User not found'
                ], 404);
            }

            // Reset password
            $user->password = Hash::make('123456');
            $r = $user->save();
            
            if ($r) {
                $data['op'] = TRUE;
                $data['msg'] = "Success";
            } else {
                $data['op'] = FALSE;
                $data['msg'] = "Failed";
            }
            Log::info($user);
            return response()->json($data);
        } catch (\Exception $e) {
            Log::error('Login Password Reset Error: ' . $e->getMessage());
            return response()->json([
                'op' => FALSE,
                'msg' => 'Operation Failed: ' . $e->getMessage()
            ], 500);
        }
    }
}