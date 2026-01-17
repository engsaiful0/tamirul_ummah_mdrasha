<?php

namespace App\Http\Controllers\Admin\StudentInfo;

use App\SmClass;
use App\SmStudent;
use App\SmAcademicYear;
use App\Traits\CustomFields;
use Illuminate\Http\Request;
use App\Models\StudentRecord;
use App\Models\StudentExtraCurricularRecord;
use App\Traits\DatabaseTableTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentRecordTemporary;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Schema;

class StudentExtraClassRecordController extends Controller
{
    use DatabaseTableTrait;
    public function multiRecord(Request $request)
    {
        $students  = null;
        $data = [];
        
        if(!empty($request->all())) {
            $record_student_ids  = StudentRecord::when($request->class_id, function($q) use($request) {
                $q->where('class_id', $request->class_id);
            })->when($request->section_id, function($q) use($request){
                $q->where('section_id', $request->section_id);
            })->when($request->academic_year, function($q) use($request){
                $q->where('session_id', $request->academic_year);
            }, function($q){
                $q->where('session_id', getAcademicId());
            })->when($request->student, function ($q) use ($request) {
                $q->where('student_id', $request->student);
            })->pluck('student_id')->toArray();

         
          $students = SmStudent::whereIn('id', $record_student_ids)->where('active_status', 1)->get();
        }       
        $selected['student_id'] = $request->student;
        $selected['academic_year'] = $request->academic_year;
        $selected['class_id'] = $request->class_id;
        $selected['section_id'] = $request->section_id;

        $extraclasses = DB::table('sm_extra_curricular_classes')
        ->where('academic_id', '=', old('session', getAcademicId()))
        ->get();
        
        $sessions = SmAcademicYear::where('school_id', auth()->user()->school_id)->get();       
        $classes = SmClass::get(); 

        $student_extra_classes = StudentExtraCurricularRecord::where('student_id',$request->student)->select('extra_class_id')->get(); 
        $extra_class_array = array();
        if($student_extra_classes){
            foreach($student_extra_classes as $std_extra_classes){
                $extra_class_array[] = $std_extra_classes['extra_class_id'];
            }
        }
        $extra_class_ids = json_decode(json_encode($extra_class_array), true);
        return view('backEnd.studentInformation.assign_extraclass_student', compact('sessions', 'students', 'classes', 'data', 'selected', 'extraclasses', 'extra_class_ids'));
    }

    public function multiRecordStore(Request $request)
    {
        try {
            StudentExtraCurricularRecord::where('student_id',$request->student_id)->delete();
            if(isset($request->extraclass_id) && $request->extraclass_id!='')
            {
                foreach($request->extraclass_id as $extraclass_id)
                {   
                    $extraCurricularRecord = new StudentExtraCurricularRecord;
                    $extraCurricularRecord->extra_class_id = $extraclass_id;
                    $extraCurricularRecord->school_id = Auth::user()->school_id;
                    $extraCurricularRecord->student_id = $request->student_id;
                    $extraCurricularRecord->academic_id = $request->session ?? getAcademicId();
                    $extraCurricularRecord->class_id = $request->std_class_id;
                    $extraCurricularRecord->save();
                }
            }            
       
           Toastr::success('Operation successful', 'Success');
           return redirect()->back();

        } catch (\Throwable $th) {
            $status = false;
            $message = __('student.Record info updated Failed');
            return response()->json(['status'=>$status, 'message'=>$th->getMessage()]);
        }
    }
}
