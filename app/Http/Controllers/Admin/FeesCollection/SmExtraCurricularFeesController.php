<?php
namespace App\Http\Controllers\Admin\FeesCollection;

use App\SmClass;
use App\SmParent;
use App\SmStudent;
use App\SmAddIncome;
use App\SmsTemplate;
use App\SmExtraclassFees;
use App\SmFeesMaster;
use App\SmSmsGateway;
use App\SmBankAccount;
use App\SmExtraCurricularFeesPayment;
use App\SmFeesDiscount;
use Twilio\Rest\Client;
use App\SmBankStatement;
use App\SmPaymentMethhod;
use Illuminate\Http\Request;
use App\Models\StudentRecord;
use App\SmFeesAssignDiscount;
use App\SmPaymentGatewaySetting;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\DirectFeesInstallmentAssign;
use Modules\University\Entities\UnFeesInstallmentAssign;
use App\Http\Requests\Admin\Accounts\SmFineReportSearchRequest;
use App\Models\DirectFeesReminder;
use App\Models\DirectFeesSetting;
use App\Models\DireFeesInstallmentChildPayment;
use App\Models\FeesInvoice;
use App\Models\StudentExtraCurricularRecord;
use Modules\University\Entities\UnFeesInstallAssignChildPayment;

class SmExtraCurricularFeesController extends Controller
{
    public function __construct()
    {
        $this->middleware('PM');
        // User::checkAuth();
    }

    public function feesGenerateModal(Request $request, $amount, $student_id, $assign_id, $record_id)
    {
        try {
            $amount = $amount;
            $student_id = $student_id;
            $banks = SmBankAccount::where('school_id', Auth::user()->school_id)
                ->get();

            //$discounts=[];
            $data['bank_info'] = SmPaymentGatewaySetting::where('gateway_name', 'Bank')
                ->where('school_id', Auth::user()->school_id)
                ->first();

            $data['cheque_info'] = SmPaymentGatewaySetting::where('gateway_name', 'Cheque')
                ->where('school_id', Auth::user()->school_id)
                ->first();

            $method['bank_info'] = SmPaymentMethhod::where('method', 'Bank')
                ->where('school_id', Auth::user()->school_id)
                ->first();

            $method['cheque_info'] = SmPaymentMethhod::where('method', 'Cheque')
                ->where('school_id', Auth::user()->school_id)
                ->first();

            return view('backEnd.feesCollection.extra_class_fees_generate_modal', compact('amount','assign_id', 'student_id', 'data', 'method','banks','record_id'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function feesPaymentStore(Request $request)
    {
        if( db_engine() != "pgsql"){
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }
        try {
            $fileName = "";
            if ($request->file('slip') != "") {
                $file = $request->file('slip');
                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/bankSlip/', $fileName);
                $fileName = 'public/uploads/bankSlip/' . $fileName;
            }

            //$discount_group = explode('-', $request->discount_group);
            $user = Auth::user();
            $fees_payment = new SmExtraCurricularFeesPayment();
            $fees_payment->student_id = $request->student_id;
            $fees_payment->assign_id = $request->assign_id;
            $fees_payment->amount = !empty($request->amount) ? $request->amount : 0;
            $fees_payment->assign_id = $request->assign_id;
            $fees_payment->payment_date = date('Y-m-d', strtotime($request->date));
            $fees_payment->payment_mode = $request->payment_mode;
            $fees_payment->created_by = $user->id;
            $fees_payment->note = $request->note;
            //$fees_payment->fine_title = $request->fine_title;
            $fees_payment->school_id = Auth::user()->school_id;
            $fees_payment->slip = $fileName;
            $fees_payment->extra_curricular_record_id = $request->record_id;
            $fees_payment->academic_id = getAcademicid();

            $result = $fees_payment->save();
    
            $payment_mode_name=ucwords($request->payment_mode);
            $payment_method=SmPaymentMethhod::where('method',$payment_mode_name)->first();

            $income_head= generalSetting();

            $add_income = new SmAddIncome();
            $add_income->name = 'Extra Fees Collect';
            $add_income->date = date('Y-m-d', strtotime($request->date));
            $add_income->amount = $fees_payment->amount;
            $add_income->fees_collection_id = $fees_payment->id;
            $add_income->active_status = 1;
            $add_income->income_head_id = $income_head->income_head_id;
            $add_income->payment_method_id = $payment_method->id;
            $add_income->account_id = $request->bank_id;
            $add_income->created_by = Auth()->user()->id;
            $add_income->school_id = Auth::user()->school_id;
            if(moduleStatusCheck('University')){
                $add_income->un_academic_id = getAcademicId();
            }
            $add_income->academic_id = getAcademicId();
            $add_income->save();

            if($payment_method->id==3){
                $bank=SmBankAccount::where('id',$request->bank_id)
                    ->where('school_id',Auth::user()->school_id)
                    ->first();
                $after_balance= $bank->current_balance + $request->amount;
                $bank_statement= new SmBankStatement();
                $bank_statement->amount = $request->amount;
                $bank_statement->after_balance= $after_balance;
                $bank_statement->type= 1;
                $bank_statement->details= "Extra Fees Payment";
                $bank_statement->payment_date= date('Y-m-d', strtotime($request->date));
                $bank_statement->bank_id= $request->bank_id;
                $bank_statement->school_id= Auth::user()->school_id;
                $bank_statement->payment_method= $payment_method->id;
                $bank_statement->fees_payment_id= $fees_payment->id;
                $bank_statement->save();

                $current_balance = SmBankAccount::find($request->bank_id);
                $current_balance->current_balance=$after_balance;
                $current_balance->update();
            }

                // New
                $student_record = StudentExtraCurricularRecord::find($request->record_id);
                $real_amount = (float) $request->real_amount;
                $requested_amount = (float) $request->amount;

                if ($real_amount == $requested_amount) {
                    $status = 1; //Paid
                } else {
                    $status = 2;
                }

                $student_record->status=$status;
                $student_record->paid_amount+=$request->amount;
                $student_record->update();
                // New
            
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
                // return Redirect::route('fees_collect_student_wise', array('id' => $request->record_id));
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return Redirect::route('fees_collect_student_wise', array('id' => $request->record_id));
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function feesPaymentInvoicePrint($id, $s_id)
    {

        try {
            set_time_limit(2700);
            $groups = explode("-", $id);
            //$student = StudentRecord::find($s_id);
            $student = StudentExtraCurricularRecord::find($s_id);
            
            if (!$student) {
                Toastr::error('Student record not found', 'Failed');
                return redirect()->back();
            }
            
            $studentRecord = StudentRecord::find($student->student_id);
            
            $fees_assigneds = [];
            if(moduleStatusCheck('University')){
                foreach ($groups as $group) {
                    $fees_assigneds[] = UnFeesInstallmentAssign::find($group);
                }
            }elseif(directFees()){
                foreach ($groups as $group) {
                    $fees_assigneds[] = DirectFeesInstallmentAssign::find($group);
                }
            }
            else{
                foreach ($groups as $group) {
                    $fees_assigneds[] = SmExtraclassFees::find($group);
                }
            }

            $parent = null;
            if ($student->studentDetail && $student->studentDetail->parent_id) {
                $parent = SmParent::where('id', $student->studentDetail->parent_id)
                    ->where('school_id',Auth::user()->school_id)
                    ->first();
            }

            $unapplied_discount_amount = [];
            return view('backEnd.feesCollection.extra_curricular_fees_payment_invoice_print')->with(['fees_assigneds' => $fees_assigneds, 'student' => $student,'unapplied_discount_amount'=>$unapplied_discount_amount, 'parent' => $parent,'id'=>$id,'studentRecord' => $studentRecord]);
        } catch (\Exception $e) {
            Toastr::error('Operation Failed: ' . $e->getMessage(), 'Failed');
            return redirect()->back();
        }
    }    
}

