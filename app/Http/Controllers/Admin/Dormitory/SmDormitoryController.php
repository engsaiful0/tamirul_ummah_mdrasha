<?php

namespace App\Http\Controllers\Admin\Dormitory;

use App\SmClass;
use App\SmStudent;
use App\YearCheck;
use App\ApiBaseMethod;
use App\SmDormitoryList;
use Illuminate\Http\Request;
use App\Models\StudentRecord;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\StudentInfo\SmStudentReportController;
use Modules\University\Repositories\Interfaces\UnCommonRepositoryInterface;

class SmDormitoryController extends Controller
{
    public function __construct()
	{
        $this->middleware('PM');
        // User::checkAuth();
	}


    public function studentDormitoryReport(Request $request)
    {
        try{
            $classes = SmClass::where('active_status', 1)
                ->where('school_id', Auth::user()->school_id)
                ->get();
            $dormitories = SmDormitoryList::where('active_status', 1)
                ->where('school_id', Auth::user()->school_id)
                ->get();
            
            // Load all students with dormitories on initial page load
            $students = SmStudent::where('active_status', 1)
                ->where('school_id', Auth::user()->school_id)
                ->whereNotNull('dormitory_id')
                ->where('dormitory_id', '!=', '')
                ->where('dormitory_id', '!=', 0)
                ->with([
                    'studentRecords' => function($q) {
                        if(!moduleStatusCheck('University')){
                            $q->where('academic_id', getAcademicId());
                        }
                        $q->where('is_promote', 0)
                          ->with('class', 'section');
                    },
                    'studentRecord' => function($q) {
                        if(!moduleStatusCheck('University')){
                            $q->where('academic_id', getAcademicId());
                        }
                        $q->where('is_promote', 0)
                          ->with('class', 'section');
                    },
                    'parents', 
                    'dormitory',
                    'room.roomType'
                ])
                ->get();
                      
            return view('backEnd.dormitory.student_dormitory_report', compact('classes', 'students', 'dormitories'));
        }catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }

    }


    public function studentDormitoryReportSearch(Request $request)
    {
        try{
            $data = [];
            $student_ids = [];
            
            // Build student query
            $students = SmStudent::query();
            $students->where('active_status', 1)
                ->where('school_id', Auth::user()->school_id);
            
            // Filter by dormitory - only show students with assigned dormitory
            if ($request->has('dormitory') && $request->dormitory != "") {
                $students->where('dormitory_id', $request->dormitory);
            } else {
                // Show all students with any dormitory assigned
                $students->whereNotNull('dormitory_id')
                    ->where('dormitory_id', '!=', '')
                    ->where('dormitory_id', '!=', 0);
            }
            
            // Get student IDs based on class/section or university filters (only if filters are provided)
            $has_class_filter = ($request->has('class') && $request->class != "") || 
                                ($request->has('section') && $request->section != "");
            $has_university_filter = false;
            
            if(moduleStatusCheck('University')){
                $has_university_filter = ($request->has('un_session_id') && $request->un_session_id != "") ||
                                        ($request->has('un_faculty_id') && $request->un_faculty_id != "") ||
                                        ($request->has('un_department_id') && $request->un_department_id != "") ||
                                        ($request->has('un_semester_id') && $request->un_semester_id != "") ||
                                        ($request->has('un_semester_label_id') && $request->un_semester_label_id != "");
                
                if($has_university_filter){
                    $student_records = StudentRecord::query();
                    $student_records->where('school_id', Auth::user()->school_id)
                        ->where('un_academic_id', getAcademicId())
                        ->where('is_promote', 0);
                    
                    if($request->has('un_session_id') && $request->un_session_id != ""){
                        $student_records->where('un_session_id', $request->un_session_id);
                    }
                    if($request->has('un_faculty_id') && $request->un_faculty_id != ""){
                        $student_records->where('un_faculty_id', $request->un_faculty_id);
                    }
                    if($request->has('un_department_id') && $request->un_department_id != ""){
                        $student_records->where('un_department_id', $request->un_department_id);
                    }
                    if($request->has('un_academic_id') && $request->un_academic_id != ""){
                        $student_records->where('un_academic_id', $request->un_academic_id);
                    }
                    if($request->has('un_semester_id') && $request->un_semester_id != ""){
                        $student_records->where('un_semester_id', $request->un_semester_id);
                    }
                    if($request->has('un_semester_label_id') && $request->un_semester_label_id != ""){
                        $student_records->where('un_semester_label_id', $request->un_semester_label_id);
                    }
                    
                    $student_ids = $student_records->distinct('student_id')->pluck('student_id')->toArray();
                    if(!empty($student_ids)){
                        $students->whereIn('id', $student_ids);
                    } else {
                        // If filters return no results, return empty
                        $students->whereRaw('1 = 0');
                    }
                }
            } else {
                if($has_class_filter){
                    $student_ids = SmStudentReportController::classSectionStudent($request)->toArray();
                    if(!empty($student_ids)){
                        $students->whereIn('id', $student_ids);
                    } else {
                        // If filters return no results, return empty
                        $students->whereRaw('1 = 0');
                    }
                }
            }
            
            // Eager load relationships
            $students = $students->with([
                'studentRecords' => function($q) {
                    if(!moduleStatusCheck('University')){
                        $q->where('academic_id', getAcademicId());
                    }
                    $q->where('is_promote', 0)
                      ->with('class', 'section');
                },
                'studentRecord' => function($q) {
                    if(!moduleStatusCheck('University')){
                        $q->where('academic_id', getAcademicId());
                    }
                    $q->where('is_promote', 0)
                      ->with('class', 'section');
                },
                'parents', 
                'dormitory',
                'room.roomType'
            ])->get();

            $data['classes'] = SmClass::where('active_status', 1)
                ->where('school_id', Auth::user()->school_id)
                ->get();
            $data['dormitories'] = SmDormitoryList::where('active_status', 1)
                ->where('school_id', Auth::user()->school_id)
                ->get();
            $data['students'] = $students;
            $data['class_id'] = $request->class;
            $data['section_id'] = $request->section;
            $data['dormitory_id'] = $request->dormitory;
            
            if (moduleStatusCheck('University')) {
                $interface = App::make(UnCommonRepositoryInterface::class);
                $data += $interface->getCommonData($request);
            }
            
            return view('backEnd.dormitory.student_dormitory_report', $data);
        }catch (\Exception $e) {
            Toastr::error('Operation Failed: ' . $e->getMessage(), 'Failed');
            return redirect()->back();
        }
    }
}
