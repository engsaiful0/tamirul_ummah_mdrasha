<?php

namespace App\Http\Controllers\Admin\Transport;

use App\SmRoute;
use App\SmClass;
use App\SmVehicle;
use App\SmAssignVehicle;
use App\SmFeesMaster;
use App\SmStudent;
use App\Models\StudentRecord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\Transport\SmAssignVehicleRequest;
use Illuminate\Support\Facades\DB;

class SmAssignVehicleController extends Controller
{
    public function __construct()
	{
        $this->middleware('PM');
	}

    public function index(Request $request)
    {
        try {
            $routes = SmRoute::get();
            $assign_vehicles = SmAssignVehicle::with('route','vehicle')->where('school_id', Auth::user()->school_id)->get();
            $vehicles = SmVehicle::select('id', 'vehicle_no')->where('school_id', Auth::user()->school_id)->get();
            return view('backEnd.transport.assign_vehicle', compact('routes', 'assign_vehicles', 'vehicles'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function store(SmAssignVehicleRequest $request)
    {
        try {
            foreach ($request->vehicles as $vehicle) {
                $vehicleCount = SmAssignVehicle::where('vehicle_id',$vehicle)
                                ->where('route_id',$request->route)
                                ->where('school_id',Auth::user()->school_id)
                                ->where('academic_id',getAcademicId())
                                ->count();
                if($vehicleCount>0){
                    Toastr::error('Operation Failed', 'Vehicle Already Assigned to this route!');
                    return redirect()->back();
                }else{
                    $assign_vehicle = new SmAssignVehicle();
                    $assign_vehicle->route_id = $request->route;
                    $assign_vehicle->vehicle_id = $vehicle;
                    $assign_vehicle->school_id = Auth::user()->school_id;
                    if(moduleStatusCheck('University')){
                        $assign_vehicle->un_academic_id = getAcademicId();
                    }else{
                        $assign_vehicle->academic_id = getAcademicId();
                    }
                    $assign_vehicle->save(); 
                }
                
            }
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $routes = SmRoute::get();
            $assign_vehicles = SmAssignVehicle::with('route','vehicle')->where('school_id', Auth::user()->school_id)->get();
            $assign_vehicle  = SmAssignVehicle::find($id);
            $vehiclesIds     = explode(',', $assign_vehicle->vehicle_id);
            $vehicles        = SmVehicle::select('id', 'vehicle_no')->get();
            return view('backEnd.transport.assign_vehicle', compact('routes', 'assign_vehicles', 'assign_vehicle', 'vehicles', 'vehiclesIds'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function update(SmAssignVehicleRequest $request, $id)
    {
        try {
            
            foreach ($request->vehicles as $vehicle) {
            SmAssignVehicle::where('vehicle_id', $vehicle)->delete();
            $vehicleCount = SmAssignVehicle::where('vehicle_id',$vehicle)
                                ->where('route_id',$request->route)
                                ->where('school_id',Auth::user()->school_id)
                                ->where('academic_id',getAcademicId())
                                ->count();
                if($vehicleCount>0){
                    Toastr::error('Operation Failed', 'Vehicle Already Assigned to this route!');
                    return redirect()->back();
                }else{

                    $assign_vehicle = new SmAssignVehicle();
                    $assign_vehicle->route_id = $request->route;
                    $assign_vehicle->vehicle_id = $vehicle;
                    $assign_vehicle->school_id = Auth::user()->school_id;
                    if(moduleStatusCheck('University')){
                        $assign_vehicle->un_academic_id = getAcademicId();
                    }else{
                        $assign_vehicle->academic_id = getAcademicId();
                    }
                    $assign_vehicle->save(); 
                }
            }           

            Toastr::success('Operation successful', 'Success');
            return redirect('assign-vehicle');
        } catch (\Exception $e) {
            // echo $e->getMessage();
            // exit;
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function delete(Request $request)
    {
        try {
            SmAssignVehicle::where('id', $request->id)->delete();
            
            Toastr::success('Operation successful', 'Success');
            return redirect('assign-vehicle');
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    // Assign Route to multiple students

    public function assignStudents(Request $request, $id)
    {
        try {
            $route_id = $id;
            $classes = SmClass::get();
            $routes = SmRoute::get();

            return view('backEnd.transport.assign_student', compact('classes', 'routes','route_id'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    private function studentIds($request)
    {
        $sm_student_ids = [];
        if($request->category || $request->group)
        {
            $sm_student_ids = SmStudent::when($request->category, function($query) use($request){
                $query->where('student_category_id', $request->category);
            })
            ->when($request->group, function($query) use($request){
                $query->where('student_group_id', $request->group);
            })
            ->pluck('id')
            ->toArray();
        }
        $students = StudentRecord::query();
        if (moduleStatusCheck('University')) {
            $students = universityFilter($students, $request)->where('is_promote', 0);
        } else {
            if ($request->class != "") {
                $students->where('class_id', $request->class);
            }
            if ($request->section != "") {
                $students->where('section_id', $request->section);
                $section_id = $request->section;
            }
        }
        
        $students = $students->when($request->category || $request->group, function($query) use($sm_student_ids){
            $query->whereIn('student_id', $sm_student_ids);
        })
            ->with('studentDetail.gender', 'studentDetail.parents', 'studentDetail.category', 'class', 'section', 'studentDetail')
            ->whereHas('studentDetail',function($query){
                $query->where('active_status',1);
            })->get();
        return $students;
    }

     public function studentsAssignSearch(Request $request)
    {

        $input = $request->all();
        try {

            $requestData = [];
            $requestData['class'] = $request->class;
            $requestData['section'] = $request->section;
            $requestData['route_id'] = $request->route_id;
            $route_id = $request->route_id;
            $section_id = 0;
            $routes = SmRoute::where('id', $route_id)->where('school_id', Auth::user()->school_id)->get();
            $classes = SmClass::get();
            $student_count = StudentRecord::count();

            $students = $this->studentIds($request);
            $student_ids = $students->pluck('id')->toArray();

            $pre_assigned = SmStudent::where('route_list_id', $route_id)
                            ->where('school_id', Auth::user()->school_id)
                            ->pluck('id')->toArray();

            if ($pre_assigned != null) {
                $assigned_value = 1;
            } else {
                $assigned_value = 0;
            }
            $class_id = $request->class;
            $category_id = $request->category;
            $group_id = $request->group;

            $fees_assign_groups = SmFeesMaster::where('fees_group_id', $request->route_id)->where('school_id', Auth::user()->school_id)->get();

            return view('backEnd.transport.assign_student', compact('classes', 'students', 'student_count', 'fees_assign_groups', 'pre_assigned', 'class_id', 'category_id', 'group_id', 'assigned_value', 'section_id', 'requestData', 'student_ids','routes','route_id'));

        } catch (\Exception $e) {
            // echo $e->getMessage();
            // exit;
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function transportAssignStore(Request $request)
    {
        DB::beginTransaction();
        $datas= collect($request->data);
        try{
            $fee_master='';  
            foreach ($datas as $data) { 
                $studentId= gv($data,'student_id');
                if (!gbv($data, 'checked')){
                    continue;
                }
                $student = SmStudent::find($studentId);
                if ($student) {
                    $student->update(['route_list_id' => $request->route_id]);
                }
            }
            DB::commit();
            Toastr::success('Operation Sucessful', 'Success');
            return redirect()->route('assign-vehicle-student', $request->route_id);
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
}