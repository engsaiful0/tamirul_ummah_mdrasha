<?php

namespace App\Http\Controllers\Admin\FeesCollection;

use App\User;
use App\SmClass;
use App\SmSection;
use App\SmStudent;
use App\ApiBaseMethod;
use App\SmExtraclassFees;
use App\Models\FeesInvoice;
use App\Models\StudentExtraCurricularRecord;
use Illuminate\Http\Request;
use App\Models\StudentRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\FeesCollection\SmExtraClassFeesCollectSearchRequest;
use Modules\University\Repositories\Interfaces\UnCommonRepositoryInterface;

class SmExtraCurricularFeesCollectController extends Controller
{

    public function __construct()
	{
        $this->middleware('PM');
        // User::checkAuth();
	}
    public function index(Request $request)
    {
        try {
            $extraclasses = DB::table('sm_extra_curricular_classes')
            ->where('academic_id', '=', old('session', getAcademicId()))
            ->get();
            return view('backEnd.feesCollection.collect_extraclass_fees', compact('extraclasses'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }   


    public function search(SmExtraClassFeesCollectSearchRequest $request)
    {
        try {
            $data = [];
            $students = StudentExtraCurricularRecord::query();
            if(moduleStatusCheck('University')){
                $students =  universityFilter($students, $request);
                $students = $students->with('studentDetail.parents')
                            ->whereHas('studentDetail', function ($q){
                                $q->where('active_status', 1);
                            })->get();
            }else{
                if ($request->extra_class != "") {
                    $students->where('extra_class_id', $request->extra_class);
                }
                if ($request->keyword != "") {
                    $students->whereHas('studentDetail', function($q) use($request) {
                        $q->where('full_name', 'like', '%' . $request->keyword . '%')->orWhere('admission_no', $request->keyword)->orWhere('roll_no', $request->keyword)->orWhere('national_id_no', $request->keyword)->orWhere('local_id_no', $request->keyword);
                    });                    
                }
                
                $students = $students->with('class','section','studentDetail.parents')->whereHas('studentDetail', function ($q)  {
                    $q->where('active_status', 1);
                })->get();
            }
            if ($students->isEmpty()) {
                if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                    return ApiBaseMethod::sendError('No result found');
                }
                Toastr::error('No result found', 'Failed');
                return redirect('collect-fees');
            }
            $extraclasses = DB::table('sm_extra_curricular_classes')
            ->where('academic_id', '=', old('session', getAcademicId()))
            ->get(); 
            $class_info = SmClass::find($request->class);
            $search_info['class_name'] = @$class_info->class_name;
            if ($request->section != "") {
                $section_info = SmSection::find($request->section);
                $search_info['section_name'] = @$section_info->section_name;
            }
            if ($request->keyword != "") {
                $search_info['keyword'] = $request->keyword;
            }
            $data['extraclasses'] = $extraclasses;
            $data['students'] = $students;
            $data['search_info'] = $search_info;

            if (moduleStatusCheck('University')) {
                $interface = App::make(UnCommonRepositoryInterface::class);
                $data += $interface->getCommonData($request);
            }        
            return view('backEnd.feesCollection.collect_extraclass_fees', $data);
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function collectFeesStudent(Request $request, $id)
    {
       try {

        $student = StudentExtraCurricularRecord::with('studentDetail','fees')->find($id);
        $studentRecord = StudentRecord::find($student->student_id);
        $fees_assigneds = SmExtraclassFees::where('student_id', $student->student_id)
            ->where('fees_amount', '>',0)
            ->orderBy('id', 'desc')
            ->where('school_id',Auth::user()->school_id)
            ->get();
         if (count($fees_assigneds) <= 0) { 
            Toastr::warning('Fees assign not yet!');
            return redirect('/collect-fees');
         }    

        $data['student'] = $student;
        $data['studentRecord'] = $studentRecord;
        $data['invoice_settings'] = FeesInvoice::where('school_id', auth()->user()->school_id)->first(['prefix','start_form']);
        $data['fees_assigneds'] = $student->fees;;
        $data['extra_curricular_fees_assigneds'] = $fees_assigneds;

        return view('backEnd.feesCollection.collect_extraclass_fees_student_wise', $data);
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
}
