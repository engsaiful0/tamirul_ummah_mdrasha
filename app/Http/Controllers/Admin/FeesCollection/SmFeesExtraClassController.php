<?php
namespace App\Http\Controllers\Admin\FeesCollection;
use App\SmClass;
use App\SmStudent;
use App\tableList;
use App\SmBaseSetup;
use App\SmFeesAssign;
use App\ApiBaseMethod;
use App\SmFeesPayment;
use App\SmFeesDiscount;
use App\SmStudentGroup;
use App\SmStudentCategory;
use Illuminate\Http\Request;
use App\Models\StudentRecord;
use App\Models\StudentExtraCurricularRecord;
use App\SmExtraclassFees;
use App\SmExtraCurricularFeesSettings;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\FeesCollection\SmFeesDiscountRequest;
use App\Models\DirectFeesInstallmentAssign;
use App\Traits\DirectFeesAssignTrait;
use Modules\University\Entities\UnFeesInstallmentAssign;

class SmFeesExtraClassController extends Controller
{
    use DirectFeesAssignTrait;
    public function __construct()
    {
        $this->middleware('PM');
        // User::checkAuth();
    }    

    public function feesExtraClassAssign(Request $request)
    {
        try{
            $fees_discount_id = '';
            $classes = SmClass::get();
        
            $extraclasses = DB::table('sm_extra_curricular_classes')
            ->where('academic_id', '=', old('session', getAcademicId()))
            ->get();

            if(moduleStatusCheck('University')){
                return view('university::fees_extra_class_assign', compact('classes','extraclasses','fees_discount_id'));
            }else{
                return view('backEnd.feesCollection.fees_extra_class_assign', compact('classes','extraclasses','fees_discount_id'));
            }
           
        }catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function feesExtraClassAssignSearch(Request $request)
    {
        try {
            $studentsExtraRecords = StudentExtraCurricularRecord::query();

            if ($request->extra_class != "") {
                $studentsExtraRecords->where('extra_class_id', $request->extra_class);
            }
            if ($request->class != "") {
                $studentsExtraRecords->where('class_id', $request->class);
            }
            $studentsExtraRecords = $studentsExtraRecords->with('studentDetail.parents', 'class', 'section', 'studentDetail.category', 'studentDetail.gender')->where('school_id', Auth::user()->school_id)
                ->whereHas('studentDetail', function ($q)  {
                    $q->where('active_status', 1);
                })->get();
                        
            $studentsExtraRecord_ids = $studentsExtraRecords->pluck('id')->toArray();
            $pre_assigned = SmExtraclassFees::whereIn('extra_curricular_record_id', $studentsExtraRecord_ids)
                ->where('school_id', Auth::user()->school_id)
                ->pluck('extra_curricular_record_id')->toArray();
           
            $assigned_fees_amount = SmExtraclassFees::whereIn('extra_curricular_record_id', $studentsExtraRecord_ids)
                ->where('school_id', Auth::user()->school_id)
                ->pluck('fees_amount')->toArray();

            $already_paid = [];
            $classes = SmClass::get();
            $extraclasses = DB::table('sm_extra_curricular_classes')
            ->where('academic_id', '=', old('session', getAcademicId()))
            ->get();

            $selectedExtraClass = DB::table('sm_extra_curricular_classes')
            ->leftjoin('sm_extra_curricular_fees_settings','sm_extra_curricular_fees_settings.extra_class_id','=','sm_extra_curricular_classes.id')
            ->where('sm_extra_curricular_fees_settings.class_id',$request->class)
            ->where('sm_extra_curricular_fees_settings.extra_class_id',$request->extra_class)
            ->select('sm_extra_curricular_classes.id','sm_extra_curricular_classes.class_name','sm_extra_curricular_fees_settings.fees_amount')
            ->first();

            $extraClassName = $selectedExtraClass->class_name;
            $extraClassId = $selectedExtraClass->id;
            $fees_amount = $selectedExtraClass->fees_amount;
            $std_class_id = $request->class;

            return view('backEnd.feesCollection.fees_extra_class_assign', compact('studentsExtraRecords', 'pre_assigned','already_paid','extraclasses','extraClassName','extraClassId','fees_amount','assigned_fees_amount','classes','std_class_id'));

        }catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function feesExtraClassAssignStore(Request $request)
    {
        $datas= collect($request->data);
        try{
            
            foreach ($datas as $data) {
                $studentId= gv($data,'student_id');

                if (!gbv($data, 'checked')){
                    continue;
                }
                $recordId= gv($data,'record_id');
           
                /******** Extra Class Fee Assign *********/
                // DB::enableQueryLog();
                $fees_amount = $request->extra_class_fees;
                $extra_class_id = $request->extra_class_id;
                $std_class_id = $request->std_class_id;

                $extra_curricular_fees_assigns = SmExtraCurricularFeesSettings::where('class_id', $std_class_id)
                ->where('extra_class_id', $extra_class_id)
                ->where('academic_id', getAcademicId())
                ->where('school_id',Auth::user()->school_id)
                ->first();

                if(!$extra_curricular_fees_assigns){
                    $extra_curricular_fees_assigns = new SmExtraCurricularFeesSettings();
                    
                    $extra_curricular_fees_assigns->class_id = $std_class_id;
                    $extra_curricular_fees_assigns->extra_class_id = $extra_class_id;
                    $extra_curricular_fees_assigns->fees_amount = $fees_amount;
                    $extra_curricular_fees_assigns->school_id = Auth::user()->school_id;
                    $extra_curricular_fees_assigns->academic_id = getAcademicId();
                    $extra_curricular_fees_assigns->save();
                    
                }else{
                    DB::table('sm_extra_curricular_fees_settings')
                    ->where('class_id', $std_class_id)
                    ->where('extra_class_id', $extra_class_id)
                    ->where('school_id', Auth::user()->school_id)
                    ->where('academic_id', getAcademicId())
                    ->update(['fees_amount' => $fees_amount]);
                }

                $fees_assigns = SmExtraclassFees::where('student_id', $studentId)->where('extra_curricular_record_id', $recordId)->where('extra_class_id', $extra_class_id)->where('school_id',Auth::user()->school_id)
                ->first();
                
                if(!$fees_assigns){
                    $fees_assign = new SmExtraclassFees();
                    $fees_assign->fees_amount = $fees_amount;
                    $fees_assign->extra_class_id = $extra_class_id;
                    $fees_assign->student_id = $studentId;
                    $fees_assign->extra_curricular_record_id = $recordId;
                    $fees_assign->school_id = Auth::user()->school_id;
                    $fees_assign->academic_id = getAcademicId();
                    $fees_assign->save();
                }                           
            
            }
            Toastr::success('Operation Sucessful', 'Success');
            //redirect()->back()
            return redirect()->route('fees_extra_class');
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }

    }
}