<?php

namespace App\Http\Controllers\Admin\FeesCollection;

use App\User;
use App\SmClass;
use App\SmSection;
use App\SmStudent;
use App\ApiBaseMethod;
use App\SmExtraclassFees;
use App\SmAcademicYear;
use App\SmFeesGroup;
use App\SmFeesMaster;
use App\SmFeesAssign;
use App\SmFeesPayment;
use App\SmPaymentMethhod;
use App\SmAddIncome;
use App\SmTransportFeesPayment;
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
use Carbon\Carbon;

class SmQuickFeesCollectionController extends Controller
{

    public function __construct()
	{
        $this->middleware('PM');
        // User::checkAuth();
	}

    public function index(Request $request)
    {
        $students  = null;
        $data = [];
        
        // if(!empty($request->all())) {
        //     $record_student_ids  = StudentRecord::when($request->class_id, function($q) use($request) {
        //         $q->where('class_id', $request->class_id);
        //     })->when($request->section_id, function($q) use($request){
        //         $q->where('section_id', $request->section_id);
        //     })->when($request->academic_year, function($q) use($request){
        //         $q->where('session_id', $request->academic_year);
        //     }, function($q){
        //         $q->where('session_id', getAcademicId());
        //     })->when($request->student, function ($q) use ($request) {
        //         $q->where('student_id', $request->student);
        //     })->pluck('student_id')->toArray();
            
        //   $students = SmStudent::whereIn('id', $record_student_ids)->where('active_status', 1)->get();

        // }       
 
        $fees_category = SmFeesGroup::where('active_status', 1)->where('academic_id',getAcademicId())->get();
       
        $selected['student_id'] = $request->student;
        $selected['academic_year'] = $request->academic_year;
        $selected['class_id'] = $request->class_id;
        $selected['section_id'] = $request->section_id;
        
        $sessions = SmAcademicYear::where('school_id', auth()->user()->school_id)->get();       
        $classes = SmClass::get(); 

        $student_extra_classes = StudentExtraCurricularRecord::where('student_id',$request->student)->select('extra_class_id')->get(); 
        
        $student = StudentRecord::with('studentDetail','feesDiscounts','fees')->where('student_id', $request->student);

        return view('backEnd.studentInformation.quick_payment', compact('sessions', 'students', 'classes', 'data', 'selected', 'fees_category'));
    }


    public function feeDetails(Request $request)
    {

        $students  = null;
        $data = [];
        
        $sm_student = SmStudent::find($request->student);
        $student = StudentRecord::with('studentDetail','feesDiscounts','fees')->where('student_id', $request->student)->first();
        $fees_category = SmFeesGroup::where('active_status', 1)->where('academic_id',getAcademicId())->get();

        $classes = SmClass::get(); 

        $fees_assign_groups = SmFeesMaster::where('fees_group_id', $request->fees_category)->where('school_id', Auth::user()->school_id)->get();

        $student_fees_paid=array();
        $rec_count=0;
        $student_fees_discount = [];
        foreach($fees_assign_groups as $index => $fee_type) {

            $student_fees_paid[] = SmFeesPayment::where('fees_type_id', $fee_type->fees_type_id)
                                    ->where('school_id', Auth::user()->school_id)
                                    ->where('student_id', $request->student)
                                    ->where('record_id', $student->id)
                                    ->sum('amount');

            $student_fees_discount[] = SmFeesPayment::where('fees_type_id', $fee_type->fees_type_id)
                                    ->where('school_id', Auth::user()->school_id)
                                    ->where('student_id', $request->student)
                                    ->where('record_id', $student->id)
                                    ->sum('discount_amount');

            if($student_fees_paid[$index]){
                $rec_count=1;
            }        
        }
        

        return view('backEnd.studentInformation.quickPayment.fee_details', compact('classes', 'student', 'sm_student', 'fees_category', 'fees_assign_groups', 'student_fees_paid', 'student_fees_discount', 'rec_count'));
    }


    public function feesPaymentStore(Request $request)
    {
        try {
            $student_id = $request->student_id;                   
            $student_record_id = $request->student_record_id;                   
            //$fees_master_id = $request->fees_master_id;
            
            $academic_id = getAcademicId();    
            $fees_amount = $request->input('amount');
            $paid_amount = $request->input('paid');
            $fees_type_id = $request->input('fees_type_id');
            $fees_master_id = $request->input('fees_master_id');
            $discount = $request->input('discount');
            $discount_note = $request->input('note');

            //foreach($fees_amount as $amount) {
            foreach($fees_amount as $index => $amount) {

                //DB::enableQueryLog();
                $checkFeeAsassign = SmFeesAssign::where('fees_master_id', $fees_master_id[$index])
                    ->where('student_id', $request->student_id)
                    ->where('record_id', $request->student_record_id)
                    ->where('school_id', Auth::user()->school_id)
                    ->where('academic_id', getAcademicId())
                    ->first();

                    if ($amount >= $discount[$index]) {
                        $payable_fees=$amount - $discount[$index];
                    }else {
                        $payable_fees=0.00;
                    }
                //dd(DB::getQueryLog());

                if (!$checkFeeAsassign) {

                    // Create a new record
                    $assign_fees = new SmFeesAssign();
                    $assign_fees->student_id = $request->student_id;
                    $assign_fees->applied_discount = $discount[$index];
                    $assign_fees->fees_amount = $payable_fees;
                    //$assign_fees->fees_amount = $amount;
                    $assign_fees->fees_master_id = $fees_master_id[$index];
                    $assign_fees->record_id = $request->student_record_id;
                    $assign_fees->school_id = Auth::user()->school_id;
                    $assign_fees->academic_id = getAcademicId();

                    $assign_fees->save();
                    $assign_id = $assign_fees->id;
                } else {
                    // Update the existing record
                    $checkFeeAsassign->applied_discount = $checkFeeAsassign->applied_discount+$discount[$index];
                    $checkFeeAsassign->fees_amount = $amount;
                    $checkFeeAsassign->save();

                    $assign_id = $checkFeeAsassign->id;
                }

                if($paid_amount[$index]>0 || $discount[$index]>0) {

                    $fullUrl = $request->url();
                    $domain = parse_url($fullUrl, PHP_URL_HOST);
                    $prefix = substr($domain, 0, 3);

                    $billNumber = $this->generateUniqueBillNumber($prefix);

                    $fees_payment = new SmFeesPayment();
                    $fees_payment->bill_number = $billNumber;
                    $fees_payment->student_id = $request->student_id;
                    $fees_payment->fees_type_id = $fees_type_id[$index];
                    $fees_payment->assign_id = $assign_id;
                    $fees_payment->amount = $paid_amount[$index];
                    $fees_payment->discount_amount = $discount[$index];
                    $fees_payment->fine = 0;
                    $fees_payment->payment_date = date('Y-m-d');
                    $fees_payment->payment_mode = 'cash';
                    $fees_payment->record_id = $request->student_record_id;
                    $fees_payment->created_by = Auth::id();
                    $fees_payment->note = isset($discount_note[$index]) ? $discount_note[$index] : '';
                    $fees_payment->academic_id = getAcademicId();
                    $fees_payment->school_id = Auth::user()->school_id;
                                   
                    $result = $fees_payment->save();
                
                    $payment_mode_name='Cash';
                    $payment_method=SmPaymentMethhod::where('method',$payment_mode_name)->first();
                    $income_head= generalSetting();

                    $add_income = new SmAddIncome();
                    $add_income->name = 'Fees Collect';
                    $add_income->date =  date('Y-m-d');
                    $add_income->amount = $fees_payment->amount;
                    $add_income->fees_collection_id = $fees_payment->id;
                    $add_income->active_status = 1;
                    $add_income->income_head_id = $income_head->income_head_id;
                    $add_income->payment_method_id = $payment_method->id;
                    $add_income->account_id = null;
                    $add_income->created_by = Auth()->user()->id;
                    $add_income->school_id = Auth::user()->school_id;
                    
                    $add_income->academic_id = getAcademicId();
                    $add_income->save();
                }                
            }
            
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
                // return Redirect::route('fees_collect_student_wise', array('id' => $request->record_id));
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }

        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->route('fees_assign', $request->fees_type_id);
        }
    }


    public function transportFeesPaymentStore(Request $request)
    {
        if( db_engine() != "pgsql"){
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        try {

            $selected_months = $request->input('fees_group');
            foreach($selected_months as $index => $month) {
               
                $carbon = Carbon::createFromDate(null, $month, null);
                $fileName = "";           

                $assigned_route_fees = null;
                //$discount_group = explode('-', $request->discount_group);
                $paidCount = SmTransportFeesPayment::where('student_id',$request->student_id)
                ->where('record_id',$request->student_record_id)
                ->where('route_id',$request->route_list_id)
                ->where('month_id',$month)->count();
                if($paidCount==0){
                    $assigned_route_fees=$request->transport_amount;
                }
                $user = Auth::user();

                $fullUrl = $request->url();
                $domain = parse_url($fullUrl, PHP_URL_HOST);
                $prefix = substr($domain, 0, 3);

                $billNumber = $this->generateUniqueBillNumber($prefix);

                $fees_payment = new SmTransportFeesPayment();
                $fees_payment->bill_number = $billNumber;
                $fees_payment->student_id = $request->student_id;
                $fees_payment->month_id = $month;
                $fees_payment->month = $carbon->monthName;
                $fees_payment->amount = !empty($request->transport_amount) ? $request->transport_amount : 0;
                $fees_payment->assigned_route_fees = !empty($assigned_route_fees) ? $assigned_route_fees : null;
                $fees_payment->payment_date = date('Y-m-d');
                $fees_payment->payment_mode = 'cash';
                $fees_payment->created_by = $user->id;
                $fees_payment->note = isset($request->note) ? $request->note : null;
                $fees_payment->school_id = Auth::user()->school_id;
                $fees_payment->slip = $fileName;
                $fees_payment->route_id = $request->route_list_id;
                $fees_payment->record_id = $request->student_record_id;
                $fees_payment->academic_id = getAcademicid();

                $result = $fees_payment->save();
                
                $payment_mode_name='Cash';
                    $payment_method=SmPaymentMethhod::where('method',$payment_mode_name)->first();
                    $income_head= generalSetting();

                $add_income = new SmAddIncome();
                $add_income->name = 'Fees Collect';
                $add_income->date =  date('Y-m-d');
                $add_income->amount = $fees_payment->amount;
                $add_income->fees_collection_id = $fees_payment->id;
                $add_income->active_status = 1;
                $add_income->income_head_id = $income_head->income_head_id;
                $add_income->payment_method_id = $payment_method->id;
                $add_income->account_id = null;
                $add_income->created_by = Auth()->user()->id;
                $add_income->school_id = Auth::user()->school_id;
                
                $add_income->academic_id = getAcademicId();
                $add_income->save();
            }
            
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            // echo $e->getMessage();
            // exit;
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }


    private function generateUniqueBillNumber($prefix)
    {
        do {
            // Generate a random number between 1000 and 9999 for simplicity
            $randomNumber = mt_rand(1000, 9999);
            // Combine the prefix and the random number to create the bill number
            $billNumber = $prefix . $randomNumber;

        } while (SmFeesPayment::where('bill_number', $billNumber)->exists());

        return $billNumber;
    }

    public function updateTransportFeeStatus(Request $request)
    {
        try {
            $attributes = [
                'month_id' => $request->hid_month,
                'record_id' => $request->hid_record_id,
                'student_id' => $request->hid_student_id,
                'route_id' => $request->hid_route_id,
                'assigned_route_fees' => $request->hid_transport_fee,
                'academic_id' => getAcademicId(),
            ];

            $values = [
                'month' => $request->hid_month_value,
                'active_status' => $request->hid_status_id,
                'note' => $request->inactive_reason, 
                'amount' => '0.00', 
                'assigned_route_fees' => $request->hid_transport_fee, 
                'academic_id' => getAcademicId(), 
            ];

            // Update or create the record
            SmTransportFeesPayment::updateOrCreate($attributes, $values);

            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
        // Optionally, return a response or redirect
        //return back()->with('success', 'Transport fee status updated successfully.');
    }

}
