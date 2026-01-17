<?php

namespace App\Http\Controllers\Admin\Hr;

use App\Role;
use App\SmStaff;
use Carbon\Carbon;
use App\SmAddExpense;
use App\SmBankAccount;
use App\SmLeaveDefine;
use App\SmBankStatement;
use App\SmChartOfAccount;
use App\SmPaymentMethhod;
use App\SmGeneralSettings;
use App\SmStaffAttendence;
use App\SmHrPayrollGenerate;
use Illuminate\Http\Request;
use App\SmHrPayrollEarnDeduc;
use App\SmLeaveDeductionInfo;
use App\Models\PayrollPayment;
use App\PayrollSettingsDeduction;
use App\PayrollSettingsEarning;
use App\PayrollSettingsGroup;
use App\PayrollSettingsEpfwages;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\RolePermission\Entities\InfixRole;
use App\ApiBaseMethod;
use App\SmStaffEarnings;
use App\SmStaffDeductions;
use App\PayrollGenerate;
use App\SmSchool;
use session;
use PDF; 

class SmPayrollController extends Controller
{
    public function __construct()
    {
        $this->middleware('PM');
        // User::checkAuth();
    }

    public function payrollSettings(Request $request)
    {
        try { 
            $earnings = PayrollSettingsEarning::get();
            $deductions = PayrollSettingsDeduction::get();
            $setting_group = PayrollSettingsGroup::get();
            $earningsData=[];
            $deductionsData=[];
            if (Session::has('earningsData')) {
                $request->session()->forget('deductionsData'); 
                $earningsData = Session::get('earningsData');
            }
            if (Session::has('deductionsData')) {
                $request->session()->forget('earningsData'); 
                $deductionsData = Session::get('deductionsData');
            }
            $schoolInfo = SmSchool::first();
            $ctc_salary_month =  $schoolInfo->ctc_salary_month;
            return view('backEnd.humanResource.payroll.payrollSettings',compact('earnings','deductions','earningsData','deductionsData','setting_group','ctc_salary_month'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    
    public function payrollEarningStore(Request $request)
    {
        try{
            $request->session()->forget('earningsData');      
            $request->session()->forget('deductionsData');      
            if($request->earning_id){                
                $payroll_earning = PayrollSettingsEarning::find($request->earning_id);
                $payroll_earning->name = $request->earnings_name;
                $payroll_earning->group_id = $request->earnings_group_name;
                $payroll_earning->type_name = $request->earnings_type_name;
                $payroll_earning->update();
            }else{
                $payroll_earnings = PayrollSettingsEarning::where('name',$request->earnings_name)->where('school_id',Auth::user()->school_id)
                ->first();                
                if(!$payroll_earnings){
                    $payroll_earning = new PayrollSettingsEarning();
                    $payroll_earning->name = $request->earnings_name;
                    $payroll_earning->group_id = $request->earnings_group_name;
                    $payroll_earning->type_name = $request->earnings_type_name;
                    $payroll_earning->school_id = Auth::user()->school_id;
                    $payroll_earning->save();
                }else{
                    Toastr::error('Name Already Exist!', 'Failed');
                    return redirect()->back();
                }
            }
                
            Toastr::success('Operation Sucessful', 'Success');
            return redirect()->route('payroll_settings');
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }

    }

    public function payrollDeductionStore(Request $request)
    {
        try{   
            $request->session()->forget('earningsData');          
            $request->session()->forget('deductionsData');          
            if($request->deduction_id){                
                $payroll_deduction = PayrollSettingsDeduction::find($request->deduction_id);
                $payroll_deduction->name = $request->deductions_name;
                $payroll_deduction->group_id = $request->deductions_group_name;
                $payroll_deduction->type_name = $request->deductions_type_name;
                $payroll_deduction->update();
            }else{
                $payroll_deductions = PayrollSettingsDeduction::where('name',$request->deductions_name)->where('school_id',Auth::user()->school_id)
                ->first();                
                if(!$payroll_deductions){
                    $payroll_deduction = new PayrollSettingsDeduction();
                    $payroll_deduction->name = $request->deductions_name;
                    $payroll_deduction->group_id = $request->deductions_group_name;
                    $payroll_deduction->type_name = $request->deductions_type_name;
                    $payroll_deduction->school_id = Auth::user()->school_id;
                    $payroll_deduction->save();
                }else{
                    Toastr::error('Name Already Exist!', 'Failed');
                    return redirect()->back();
                }
            }
                
            Toastr::success('Operation Sucessful', 'Success');
            return redirect()->route('payroll_settings');
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }

    }
    
    public function editEarnings(Request $request, $id)
    {
        try {                       
            $deductions = PayrollSettingsDeduction::get();
            $earnings = PayrollSettingsEarning::get(); 
            $earningsData = PayrollSettingsEarning::find($id);

            $request->session()->put('earningsData', $earningsData);
            return redirect()->route('payroll_settings');
            //return view('backEnd.humanResource.payroll.payrollSettings', compact('earningsData','earnings','deductions'));
            
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function editDeductions(Request $request, $id)
    {
        try {
            $earnings = PayrollSettingsEarning::get();            
            $deductions = PayrollSettingsDeduction::get();
            $deductionsData = PayrollSettingsDeduction::find($id);
            $request->session()->put('deductionsData', $deductionsData);
            return redirect()->route('payroll_settings');
            //return view('backEnd.humanResource.payroll.payrollSettings', compact('earnings','deductionsData','deductions'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }


    public function deleteEarnings(Request $request, $id)
    {
        try {
            // $tables = tableList::getTableList('extra_class_id', $id);
            // if($tables == null || $tables == "Class sections, ") {
                DB::beginTransaction();
                $extraClass = PayrollSettingsEarning::destroy($id);
                DB::commit();
                if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                    if ($extraClass) {
                        return ApiBaseMethod::sendResponse(null, 'Earning field has been deleted successfully');
                    } else {
                        return ApiBaseMethod::sendError('Something went wrong, please try again.');
                    }
                }  
                
                Toastr::success('Operation successful', 'Success');
                return redirect()->route('payroll_settings');

            // } else{
            //     DB::rollback();
            //     $msg = 'This data already used in  : ' . $tables . ' Please remove those data first';
            //     Toastr::error($msg, 'Failed');
            //     return redirect()->back();
            // }

        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function deleteDeductions(Request $request, $id)
    {
        try {
            // $tables = tableList::getTableList('extra_class_id', $id);
            // if($tables == null || $tables == "Class sections, ") {
                DB::beginTransaction();
                $extraClass = PayrollSettingsDeduction::destroy($id);
                DB::commit();
                if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                    if ($extraClass) {
                        return ApiBaseMethod::sendResponse(null, 'Deduction field has been deleted successfully');
                    } else {
                        return ApiBaseMethod::sendError('Something went wrong, please try again.');
                    }
                }  
                
                Toastr::success('Operation successful', 'Success');
                return redirect()->route('payroll_settings');

            // } else{
            //     DB::rollback();
            //     $msg = 'This data already used in  : ' . $tables . ' Please remove those data first';
            //     Toastr::error($msg, 'Failed');
            //     return redirect()->back();
            // }

        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    
    //Save payroll settings details(Earnings%,Deductions %)
    public function payrollDeductionSettingsStore(Request $request)
    {
        try{       
            $i=0;
            foreach($request->deduction_ids as $deduction_ids){

                $percentage=$request->deduction_data[$i];
                if($percentage==''){
                    $percentage=0;
                }
                $updateDeduction = PayrollSettingsDeduction::where('id', $deduction_ids)->first();
                    $updateDeduction->percentage = $percentage;
                    $updateDeduction->update();
                $i++;
            }
            Toastr::success('Operation Sucessful', 'Success');
            return redirect()->route('payroll_settings');
        } catch (\Exception $e) {
            // echo $e->getMessage();
            // exit;
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function payrollEarningSettingsStore(Request $request)
    {
        try{       
            $i=0;
            foreach($request->earning_ids as $earning_ids){
                $percentage=$request->earning_data[$i];
                if($percentage==''){
                    $percentage=0;
                }
                $updateEarning = PayrollSettingsEarning::where('id', $earning_ids)->first();
                    $updateEarning->percentage = $percentage;
                    $updateEarning->update();
                $i++;
            }
                
            Toastr::success('Operation Sucessful', 'Success');
            return redirect()->route('payroll_settings');
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }

    }
    
    public function ajaxPayrollEarnings(Request $request)
    {
        try {
            $earnings = PayrollSettingsEarning::get();
            $setting_group = PayrollSettingsGroup::get();
            $earning_percentage = PayrollSettingsEarning::where('group_id',2)->sum('percentage');
            $basic_percentage = 100 - $earning_percentage;
            
            return view('backEnd.humanResource.payroll.payroll_earnings', compact('earnings','setting_group','basic_percentage','earning_percentage'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function ajaxPayrollDeduction(Request $request)
    {
        try {
            $deductions = PayrollSettingsDeduction::get();
            $setting_group = PayrollSettingsGroup::get();
            return view('backEnd.humanResource.payroll.payroll_deduction', compact('deductions','setting_group'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function ajaxEpfWages(Request $request)
    {
        try {
            $epfwages_setting = PayrollSettingsEpfwages::first();
            return view('backEnd.humanResource.payroll.epf_wages', compact('epfwages_setting'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    //Save payroll epfwages settings details(Earnings%,Deductions %)
    public function epfWagesSettingsStore(Request $request)
    {
        try{       
            PayrollSettingsEpfwages::where('id', 1)
            ->update(['epfwages' => $request->epf_wages, 'epf' => $request->epf, 'eps' => $request->eps, 'esi_salary_limit' => $request->esi_salary_limit, 'da_allawance' => $request->da_allwance_max]);
            Toastr::success('Operation Sucessful', 'Success');
            return redirect()->route('payroll_settings');
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }


    public function index(Request $request)
    {

        try {
            $data['roles'] = InfixRole::where('active_status', '=', '1')->where('id', '!=', 1)->where('id', '!=', 2)->where('id', '!=', 3)->where('id', '!=', 10)->where(function ($q) {
                $q->where('school_id', Auth::user()->school_id)->orWhere('type', 'System');
            })
                ->orderBy('name', 'asc')
                ->get();
            //$data['role_id'] = $request->role_id;
            $currentMonth  = date('F'); 
            $currentYear = date('Y'); 
            $data['payroll_month'] = isset($request->payroll_month) ? $request->payroll_month : $currentMonth;
            $data['payroll_year'] = isset($request->payroll_year) ? $request->payroll_year : $currentYear;   
            //if( $request->role_id) {
                //$request->session()->put('role_id', $request->role_id);
                $request->session()->put('payroll_month', $request->payroll_month);
                $request->session()->put('payroll_year', $request->payroll_year);

                $data['staffs'] = SmStaff::where('active_status', '=', '1')
                ->where('role_id','!=',1)
                ->where('school_id', Auth::user()->school_id)->get();
            //}
            return view('backEnd.humanResource.payroll.index')->with($data);
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function searchStaffPayr(Request $request)
    {

        $request->validate([
            'role_id' => "required",
            'payroll_month' => "required",
            'payroll_year' => "required",

        ],[
            'role_id.required' => 'The role field is required.'
        ]);

        try {
            $role_id = $request->role_id;
            $payroll_month = $request->payroll_month;
            $payroll_year = $request->payroll_year;
           
            $staffs = SmStaff::where('active_status', '=', '1')->whereRole($role_id)->where('school_id', Auth::user()->school_id)->get();

            $roles = InfixRole::where('active_status', '=', '1')->where('id', '!=', 1)->where('id', '!=', 2)->where('id', '!=', 3)->where(function ($q) {
                $q->where('school_id', Auth::user()->school_id)->orWhere('type', 'System');
            })->get();
            return view('backEnd.humanResource.payroll.index', compact('staffs', 'roles', 'payroll_month', 'payroll_year', 'role_id'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function generatePayroll(Request $request, $id, $payroll_month, $payroll_year)
    {
        try {
            $staffDetails = SmStaff::find($id);
            // return $staffDetails;
            $month = date('m', strtotime($payroll_month));
           
            $attendances = SmStaffAttendence::where('staff_id', $id)->where('attendence_date', 'like', $payroll_year . '-' . $month . '%')->where('school_id', Auth::user()->school_id)->get();

            $staff_leaves = SmLeaveDefine::where('user_id', $staffDetails->user_id)->where('role_id', $staffDetails->role_id)->where('academic_id', getAcademicId())->where('school_id', Auth::user()->school_id)->get();
            $staff_leave_deduct_days = SmLeaveDeductionInfo::where('staff_id', $id)->where('pay_year', $payroll_year)->where('academic_id', getAcademicId())->where('school_id', Auth::user()->school_id)->get()->sum("extra_leave");

            // return $payroll_year;
            foreach ($staff_leaves as $staff_leave) {
                //  $approved_leaves = SmLeaveRequest::approvedLeave($staff_leave->id);
                $remaining_days = $staff_leave->days - $staff_leave->remainingDays;
                $extra_Leave_days = $remaining_days < 0 ? $staff_leave->remainingDays - $staff_leave->days : 0;
            }

            if ($staff_leave_deduct_days != "") {
                $extra_days = @$extra_Leave_days-@$staff_leave_deduct_days;
            } else {
                $extra_days = @$extra_Leave_days;
            }

            // return $extra_days;

            // $approved_leave = SmLeaveRequest::where('staff_id', $id)->where('active_status',1)->where('approve_status','A')->where('school_id', Auth::user()->school_id)->get();
            // return $extra_days;
            $p = 0;
            $l = 0;
            $a = 0;
            $f = 0;
            $h = 0;
            foreach ($attendances as $value) {
                if ($value->attendence_type == 'P') {
                    $p++;
                } elseif ($value->attendence_type == 'L') {
                    $l++;
                } elseif ($value->attendence_type == 'A') {
                    $a++;
                } elseif ($value->attendence_type == 'F') {
                    $f++;
                } elseif ($value->attendence_type == 'H') {
                    $h++;
                }
            }
            // for teacher commission Lms module-abu nayem
             if (moduleStatusCheck('Lms')==true) {
                $data['courses'] = \Modules\Lms\Entities\CourseTeacher::where('staff_id', $id)->get(['id','course_id']);
                $data['courseIds'] = $data['courses']->pluck('course_id')->toArray();
                $data['totalCourse'] = $data['courses']->count();
                $totalSellCourse = \Modules\Lms\Entities\CoursePurchaseLog::whereIn('course_id', $data['courseIds'])->where('active_status', 'approve');
                $data['totalSellCourseCount'] = $totalSellCourse->count();
                $data['thisMonthSell'] = $totalSellCourse->whereMonth('created_at', $month)
                                                         ->whereYear('created_at', $payroll_year)
                                                         ->count();
                $thisMonthSellAmount =  $totalSellCourse->sum('amount');
                $teacher_commission = courseSetting()->teacher_commission;
                $data['thisMonthRevenue'] = earnRevenue($thisMonthSellAmount, $teacher_commission);
                return view('backEnd.humanResource.payroll.generatePayroll', compact('staffDetails', 'payroll_month', 'payroll_year', 'p', 'l', 'a', 'f', 'h', 'extra_days'))->with($data);
             }
             //end teacher commission 
            return view('backEnd.humanResource.payroll.generatePayroll', compact('staffDetails', 'payroll_month', 'payroll_year', 'p', 'l', 'a', 'f', 'h', 'extra_days'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function savePayrollData(Request $request)
    {
        // return $request->all();
        $request->validate([
            'net_salary' => "required",
        ]);

        try {
            $payrollGenerate = new SmHrPayrollGenerate();
            $payrollGenerate->staff_id = $request->staff_id;
            $payrollGenerate->payroll_month = $request->payroll_month;
            $payrollGenerate->payroll_year = $request->payroll_year;
            $payrollGenerate->basic_salary = $request->basic_salary;
            $payrollGenerate->total_earning = $request->total_earning;
            $payrollGenerate->total_deduction = $request->total_deduction;
            $payrollGenerate->gross_salary = $request->final_gross_salary;
            $payrollGenerate->tax = $request->tax;
            $payrollGenerate->net_salary = $request->net_salary;
            $payrollGenerate->payroll_status = 'G';
            $payrollGenerate->created_by = Auth()->user()->id;
            $payrollGenerate->school_id = Auth::user()->school_id;
            if(moduleStatusCheck('University')){
                $payrollGenerate->un_academic_id = getAcademicId();
            }else{
                $payrollGenerate->academic_id = getAcademicId();
            }
            $result = $payrollGenerate->save();
            $payrollGenerate->toArray();

            if ($request->leave_deduction > 0) {
                $leave_deduct = new SmLeaveDeductionInfo;
                $leave_deduct->staff_id = $request->staff_id;
                $leave_deduct->payroll_id = $payrollGenerate->id;
                $leave_deduct->extra_leave = $request->extra_leave_taken;
                $leave_deduct->salary_deduct = $request->leave_deduction;
                $leave_deduct->pay_month = $request->payroll_month;
                $leave_deduct->pay_year = $request->payroll_year;
                $leave_deduct->created_by = Auth()->user()->id;
                $leave_deduct->school_id = Auth::user()->school_id;
                if(moduleStatusCheck('University')){
                    $leave_deduct->un_academic_id = getAcademicId();
                }else{
                    $leave_deduct->academic_id = getAcademicId();
                }
                $leave_deduct->save();
            }

            if ($result) {
                $earnings = count($request->get('earningsType', []));
                for ($i = 0; $i < $earnings; $i++) {
                    if (!empty($request->earningsType[$i]) && !empty($request->earningsValue[$i])) {
                         // for teacher commission Lms module-abu nayem                      
                            if ($request->earningsType[0]=='lms_balance' && moduleStatusCheck('Lms')==true) {
                                $payable_amount =  $request->earningsValue[0];
                                $staff = SmStaff::findOrFail($request->staff_id);
                                $lms_balance = $staff->lms_balance;
                                if ($payable_amount>0) {
                                    $balance = $lms_balance - $payable_amount;
                                    $staff->lms_balance = $balance;
                                    $staff->save();
                                }
                            }
                        //end    
                        $payroll_earn_deducs = new SmHrPayrollEarnDeduc;
                        $payroll_earn_deducs->payroll_generate_id = $payrollGenerate->id;
                        $payroll_earn_deducs->type_name = $request->earningsType[$i];
                        $payroll_earn_deducs->amount = $request->earningsValue[$i];
                        $payroll_earn_deducs->earn_dedc_type = 'E';
                        $payroll_earn_deducs->created_by = Auth()->user()->id;
                        $payroll_earn_deducs->school_id = Auth::user()->school_id;
                        if(moduleStatusCheck('University')){
                            $payroll_earn_deducs->un_academic_id = getAcademicId();
                        }else{
                            $payroll_earn_deducs->academic_id = getAcademicId();
                        }
                        $result = $payroll_earn_deducs->save();
                    }
                }

                $deductions = count($request->get('deductionstype', []));
                for ($i = 0; $i < $deductions; $i++) {
                    if (!empty($request->deductionstype[$i]) && !empty($request->deductionsValue[$i])) {
                       
                     
                        $payroll_earn_deducs = new SmHrPayrollEarnDeduc;
                        $payroll_earn_deducs->payroll_generate_id = $payrollGenerate->id;
                        $payroll_earn_deducs->type_name = $request->deductionstype[$i];
                        $payroll_earn_deducs->amount = $request->deductionsValue[$i];
                        $payroll_earn_deducs->earn_dedc_type = 'D';
                        $payroll_earn_deducs->school_id = Auth::user()->school_id;
                        if(moduleStatusCheck('University')){
                            $payroll_earn_deducs->un_academic_id = getAcademicId();
                        }else{
                            $payroll_earn_deducs->academic_id = getAcademicId();
                        }
                        $result = $payroll_earn_deducs->save();
                    }
                }
                Toastr::success('Operation successful', 'Success');
                return redirect()->route('payroll', ['role_id'=>$request->id, 'payroll_month'=>$request->payroll_month, 'payroll_year'=>$request->payroll_year]);
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function paymentPayroll(Request $request, $id, $role_id)
    {
        try {
            $chart_of_accounts = SmChartOfAccount::where('type', 'E')
                ->where('school_id', Auth::user()->school_id)
                ->get();

            $payrollDetails = SmHrPayrollGenerate::find($id);          
           
            $paymentMethods = SmPaymentMethhod::whereIn('method', ['Cash', 'Cheque', 'Bank'])
                ->where('school_id', Auth::user()->school_id)
                ->get();

            $account_id = SmBankAccount::where('school_id', Auth::user()->school_id)
                ->get();

            return view('backEnd.humanResource.payroll.paymentPayroll', compact('payrollDetails', 'paymentMethods', 'role_id', 'chart_of_accounts', 'account_id'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function savePayrollPaymentData(Request $request)
    {
       
        $request->validate([
            'expense_head_id' => "required",
            'payment_mode' => "required"
        ]);

        try {
            $payroll_month = $request->payroll_month;
            $payroll_year = $request->payroll_year;

            $payments = SmHrPayrollGenerate::find($request->payroll_generate_id);
        
            $payrollPayment = new PayrollPayment;
            $payrollPayment->sm_hr_payroll_generate_id = $request->payroll_generate_id;
            $payrollPayment->amount = $request->submit_amount;
            $payrollPayment->payment_date = date('Y-m-d', strtotime($request->payment_date));
            $payrollPayment->bank_id = $request->bank_id;
            $payrollPayment->payment_mode = $request->payment_mode;
            $payrollPayment->payment_method_id = $request->payment_method;
            $payrollPayment->note = $request->note;
            $payrollPayment->created_by = auth()->user()->id;
            $result = $payrollPayment->save();

            if($payments->payrollPayments->sum('amount') >= $payments->net_salary || $request->submit_amount >= $payments->net_salary) {
                $payments->payment_date = date('Y-m-d', strtotime($request->payment_date));
                $payments->payment_mode = $request->payment_mode;
                $payments->note = $request->note;
                $payments->payroll_status = 'P';
                $payments->updated_by = Auth()->user()->id;
                if(moduleStatusCheck('University')){
                    $payments->un_academic_id = getAcademicId();
                }else{
                    $payments->academic_id = getAcademicId();
                }
                $result = $payments->update();
            }


            $leave_deduct = SmLeaveDeductionInfo::where('payroll_id', $request->payroll_generate_id)->first();
            if (!empty($leave_deduct)) {
                $leave_deduct->active_status = 1;
                $leave_deduct->save();
            }

            if ($result ) {
                $store = new SmAddExpense();
                $store->name = 'Staff Payroll';
                $store->expense_head_id = $request->expense_head_id;
                $store->payroll_payment_id = $payrollPayment->id;
                $store->payment_method_id = $request->payment_mode;
                if ($request->payment_mode == 3) {
                    $store->account_id = $request->bank_id;
                }
                if(moduleStatusCheck('University')){
                    $store->un_academic_id = getAcademicId();
                }else{
                    $store->academic_id = getAcademicId();
                }
                $store->date = Carbon::now();
                $store->amount = $request->submit_amount;
                $store->description = 'Staff Payroll Payment';
                $store->school_id = Auth::user()->school_id;
                $store->save();
            }

            if ($request->payment_mode == 3) {
                $bank = SmBankAccount::where('id', $request->bank_id)
                    ->where('school_id', Auth::user()->school_id)
                    ->first();
                $after_balance = $bank->current_balance - $request->submit_amount;

                $bank_statement = new SmBankStatement();
                $bank_statement->amount = $request->submit_amount;
                $bank_statement->after_balance = $after_balance;
                $bank_statement->type = 0;
                $bank_statement->details = "Staff Payroll Payment";
                $bank_statement->item_receive_id = $payments->id;
                $bank_statement->payroll_payment_id = $payrollPayment->id;
                $bank_statement->payment_date = date('Y-m-d', strtotime($request->payment_date));
                $bank_statement->bank_id = $request->bank_id;
                $bank_statement->school_id = Auth::user()->school_id;
                $bank_statement->payment_method = $request->payment_method;
                $bank_statement->save();

                $current_balance = SmBankAccount::find($request->bank_id);
                $current_balance->current_balance = $after_balance;
                $current_balance->update();
            }

            $data['staffs'] = SmStaff::where('active_status', '=', '1')->where('school_id', Auth::user()->school_id)->get();
            $data['roles'] = InfixRole::where('active_status', '=', '1')->where('id', '!=', 1)->where('id', '!=', 2)->where('id', '!=', 3)->where(function ($q) {
                $q->where('school_id', Auth::user()->school_id)->orWhere('type', 'System');
            })->get();
            $data['payroll_month'] = $payroll_month;
            $data['payroll_year'] = $payroll_year;
           
            Toastr::success('Operation successful', 'Success');
            return redirect()->route('payroll', ['role_id'=>$request->role_id, 'payroll_month'=>$payroll_month, 'payroll_year'=>$payroll_year]);
          
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function viewPayslip_old($id)
    {

        try {
            $schoolDetails = SmGeneralSettings::where('school_id', auth()->user()->school_id)->first();
            $payrollDetails = SmHrPayrollGenerate::find($id);

            $payrollEarnDetails = SmHrPayrollEarnDeduc::where('active_status', '=', '1')->where('payroll_generate_id', '=', $id)->where('earn_dedc_type', '=', 'E')->where('school_id', Auth::user()->school_id)->get();

            $payrollDedcDetails = SmHrPayrollEarnDeduc::where('active_status', '=', '1')->where('payroll_generate_id', '=', $id)->where('earn_dedc_type', '=', 'D')->where('school_id', Auth::user()->school_id)->get();

            return view('backEnd.humanResource.payroll.viewPayslip', compact('payrollDetails', 'payrollEarnDetails', 'payrollDedcDetails', 'schoolDetails'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function printPayslip($id)
    {

        try {
            $schoolDetails = SmGeneralSettings::where('school_id', auth()->user()->school_id)->first();
            $payrollDetails = SmHrPayrollGenerate::find($id);

            $payrollEarnDetails = SmHrPayrollEarnDeduc::where('active_status', '=', '1')->where('payroll_generate_id', '=', $id)->where('earn_dedc_type', '=', 'E')->where('school_id', Auth::user()->school_id)->get();

            $payrollDedcDetails = SmHrPayrollEarnDeduc::where('active_status', '=', '1')->where('payroll_generate_id', '=', $id)->where('earn_dedc_type', '=', 'D')->where('school_id', Auth::user()->school_id)->get();

            return view('backEnd.humanResource.payroll.payslip_print', compact('payrollDetails', 'payrollEarnDetails', 'payrollDedcDetails', 'schoolDetails'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }

    }

    public function payrollReport(Request $request)
    {
        try {
            $roles = InfixRole::where('active_status', '=', '1')->where('id', '!=', 1)->where('id', '!=', 2)->where('id', '!=', 3)->where(function ($q) {
                $q->where('school_id', Auth::user()->school_id)->orWhere('type', 'System');
            })
                ->orderBy('name', 'asc')
                ->get();
            return view('backEnd.reports.payroll', compact('roles'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function searchPayrollReport(Request $request)
    {
        $request->validate([
            'role_id' => "required",
            'payroll_month' => "required",
            'payroll_year' => "required",

        ]);
        try {
            $role_id = $request->role_id;
            $payroll_month = $request->payroll_month;
            $payroll_year = $request->payroll_year;

            $query = '';
            if ($request->role_id != "") {
                $query = "AND s.role_id = '$request->role_id'";
            }
            if ($request->payroll_month != "") {
                $query .= "AND pg.payroll_month = '$request->payroll_month'";
            }

            if ($request->payroll_year != "") {
                $query .= "AND pg.payroll_year = '$request->payroll_year'";
            }

            $school_id = Auth::user()->school_id;

            // $staffsPayroll = DB::select(DB::raw("SELECT pg.*, s.full_name, r.name, d.title
												// FROM sm_hr_payroll_generates pg
												// LEFT JOIN sm_staffs s ON pg.staff_id = s.id
												// LEFT JOIN roles r ON s.role_id = r.id
												// LEFT JOIN sm_designations d ON s.designation_id = d.id
												// WHERE pg.active_status =1 AND pg.school_id = '$school_id'
												// $query"));

            $staffsPayroll = DB::select("SELECT pg.*, s.full_name, r.name, d.title
                                                FROM sm_hr_payroll_generates pg
                                                LEFT JOIN sm_staffs s ON pg.staff_id = s.id
                                                LEFT JOIN roles r ON s.role_id = r.id
                                                LEFT JOIN sm_designations d ON s.designation_id = d.id
                                                WHERE pg.active_status =1 AND pg.school_id = '$school_id'
                                                $query");

            $roles = InfixRole::where('active_status', '=', '1')->where('id', '!=', 1)->where('id', '!=', 2)->where('id', '!=', 3)->where(function ($q) {
                $q->where('school_id', Auth::user()->school_id)->orWhere('type', 'System');
            })->get();
            return view('backEnd.reports.payroll', compact('staffsPayroll', 'roles', 'payroll_month', 'payroll_year', 'role_id'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function viewPayrollPayment($generate_id)
    {
        $generatePayroll = SmHrPayrollGenerate::find($generate_id);
        $payrollPayments = $generatePayroll->payrollPayments;
        return view('backEnd.humanResource.payroll.view_payroll_payment_modal', compact('generatePayroll', 'payrollPayments'));
    }
    public function deletePayrollPayment(Request $request)
    {
       try {
            $msg = 'Id Not Found';
          
            if($request->ids) {
                foreach($request->ids as $payroll_payment_id) {
                    $payrollPayment = PayrollPayment::find($payroll_payment_id);
                   
                    if(auth()->user()->id == $payrollPayment->created_by || auth()->user()->role_id == 1) {
                        $expenseDetail = SmAddExpense::where('payroll_payment_id', $payroll_payment_id)->first();
                        if($expenseDetail) {  
                                                  
                            $expenseDetail->delete();
                        }
                        $bankStatementDetail = SmBankStatement::where('payroll_payment_id', $payroll_payment_id)->first();
                        if($bankStatementDetail) {
                            $bankStatementDetail->delete();
                        }
                        $generatePayroll = SmHrPayrollGenerate::find($payrollPayment->sm_hr_payroll_generate_id);
                        $generatePayroll->net_salary = $generatePayroll->net_salary + $payrollPayment->amount;
                        $generatePayroll->save();
                        $payrollPayment->delete();
                       
                    }
                } 
                $msg = 'Operation Successfully';
                
            }
           return response()->json(['msg'=>$msg]);

       } catch (\Throwable $th) {
            return response()->json(['msg'=>$th->getMessage()]);
       }
    }
    public function printPayrollPayment($id)
    {
        try {
            $payrollPayment = PayrollPayment::find($id);
            $schoolDetails = SmGeneralSettings::where('school_id', auth()->user()->school_id)->first();
            $payrollDetails = SmHrPayrollGenerate::find($payrollPayment->sm_hr_payroll_generate_id);

            $payrollEarnDetails = SmHrPayrollEarnDeduc::where('active_status', '=', '1')->where('payroll_generate_id', '=', $id)->where('earn_dedc_type', '=', 'E')->where('school_id', Auth::user()->school_id)->get();

            $payrollDedcDetails = SmHrPayrollEarnDeduc::where('active_status', '=', '1')->where('payroll_generate_id', '=', $id)->where('earn_dedc_type', '=', 'D')->where('school_id', Auth::user()->school_id)->get();
            return view('backEnd.humanResource.payroll.payment_payslip_print', compact('payrollDetails', 'payrollEarnDetails', 'payrollDedcDetails', 'schoolDetails', 'payrollPayment'));
        } catch (\Throwable $th) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }


    //New Payroll functionality
    public function staffEarningStore(Request $request)
    {
        try{               
            $staff_earnings = SmStaffEarnings::where('staff_id',$request->earnings_staff_id)
            ->where('active_status',1)
            ->where('school_id',Auth::user()->school_id)
            ->first();                
            if(!$staff_earnings){

                $staff_earnings = new SmStaffEarnings();
                $staff_earnings->staff_id = $request->earnings_staff_id;
                $staff_earnings->reason = $request->reason;
                $staff_earnings->amount = $request->amount;
                $staff_earnings->remarks = $request->remarks;
                $staff_earnings->school_id = Auth::user()->school_id;
                $staff_earnings->save();

            }else{
                $staff_earnings->staff_id = $request->earnings_staff_id;
                $staff_earnings->reason = $request->reason;
                $staff_earnings->amount = $request->amount;
                $staff_earnings->remarks = $request->remarks;
                $staff_earnings->update();
            }            
                
            Toastr::success('Operation Sucessful', 'Success');
            return redirect()->route('payroll');
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }

    }

    
    public function staffDeductionStore(Request $request)
    {
        try{               
            $staff_deductions = SmStaffDeductions::where('staff_id',$request->deductions_staff_id)                
            ->where('active_status',1)
            ->where('school_id',Auth::user()->school_id)
            ->first();                
            if(!$staff_deductions){

                $staff_deductions = new SmStaffDeductions();
                $staff_deductions->staff_id = $request->deductions_staff_id;
                $staff_deductions->reason = $request->reason;
                $staff_deductions->amount = $request->amount;
                $staff_deductions->remarks = $request->remarks;
                $staff_deductions->school_id = Auth::user()->school_id;
                $staff_deductions->save();

            }else{
                $staff_deductions->staff_id = $request->deductions_staff_id;
                $staff_deductions->reason = $request->reason;
                $staff_deductions->amount = $request->amount;
                $staff_deductions->remarks = $request->remarks;
                $staff_deductions->update();
            }            
                
            Toastr::success('Operation Sucessful', 'Success');
            return redirect()->route('payroll');
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }

    }

    public function trailrun(Request $request)
    {

        try {
            //$request->session()->forget('earningsData'); 
            //$role_id = Session::get('role_id');
            $payroll_month = Session::get('payroll_month');
            $payroll_year = Session::get('payroll_year');

            $data['roles'] = InfixRole::where('active_status', '=', '1')->where('id', '!=', 1)->where('id', '!=', 2)->where('id', '!=', 3)->where('id', '!=', 10)->where(function ($q) {
                $q->where('school_id', Auth::user()->school_id)->orWhere('type', 'System');
            })
                ->orderBy('name', 'asc')
                ->get();
            //$data['role_id'] = $role_id;
            $currentMonth  = date('F'); 
            $currentYear = date('Y'); 

            $data['payroll_month'] = isset($payroll_month) ? $payroll_month : $currentMonth;
            $data['payroll_year'] = isset($payroll_year) ? $payroll_year : $currentYear;   
            //if( $role_id) {
                $data['staffs'] = SmStaff::where('active_status', '=', '1')
                ->where('role_id','!=',1)
                ->where('school_id', Auth::user()->school_id)->get();
            //}

            return view('backEnd.humanResource.payroll.verify_payout')->with($data);
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    

    public function generateEmployeePayroll(Request $request)
    {

        try {
            $schoolInfo = SmSchool::first();
            $ctc_salary_month =  $schoolInfo->ctc_salary_month;
            //$request->session()->forget('earningsData'); 
            //$role_id = Session::get('role_id');
            $payroll_month = Session::get('payroll_month');
            $payroll_year = Session::get('payroll_year');

            $data['roles'] = InfixRole::where('active_status', '=', '1')->where('id', '!=', 1)->where('id', '!=', 2)->where('id', '!=', 3)->where('id', '!=', 10)->where(function ($q) {
                $q->where('school_id', Auth::user()->school_id)->orWhere('type', 'System');
            })
                ->orderBy('name', 'asc')
                ->get();
            //$data['role_id'] = $role_id;
            $currentMonth  = date('F'); 
            $currentYear = date('Y'); 
            $payroll_month = isset($payroll_month) ? $payroll_month : $currentMonth;
            $payroll_year = isset($payroll_year) ? $payroll_year : $currentYear;
            $data['payroll_month'] = $payroll_month;
            $data['payroll_year'] = $payroll_year;   

            //if($role_id) {
                $staffs = SmStaff::select('sm_staffs.*','sm_staff_earnings.amount as earning','sm_staff_deductions.amount as deduction')
                ->leftjoin('sm_staff_earnings','sm_staff_earnings.staff_id','=','sm_staffs.id')
                ->leftjoin('sm_staff_deductions','sm_staff_deductions.staff_id','=','sm_staffs.id')
                ->where('sm_staffs.active_status','=','1')
                //->whereRole($role_id)
                ->where('sm_staffs.school_id', Auth::user()->school_id)->get();
            //}

            $setting_earnings = PayrollSettingsEarning::get();
            $setting_deductions = PayrollSettingsDeduction::get();
            $epfwages_setting = PayrollSettingsEpfwages::first();
            $da_perecentage = $epfwages_setting->epfwages;//75;
            $epf_remitted_percent = $epfwages_setting->epf; //12;
            $eps_remitted_percent = $epfwages_setting->eps;//8.33;
            $esi_salary_limit = $epfwages_setting->esi_salary_limit;
            $max_da_allawance = $epfwages_setting->da_allawance;

            $esi_salary_limit = $esi_salary_limit * $ctc_salary_month;

            foreach($staffs as $staff){
                                
                $yearly_salary = $staff->basic_salary+$staff->earning-$staff->deduction;


                $permonth_salary = $yearly_salary/$ctc_salary_month;
                
                $yearly_tds = $this->payrollCalculation($yearly_salary);


                $monthly_tds = $yearly_tds/$ctc_salary_month;
                $ctc = $permonth_salary;
                //Deductions
                $emp_deductions=[];
                $emp_deductions['tds']=$monthly_tds;                
                $emp_other_deductions=[];
                foreach($setting_deductions as $deduction){
                    //$ctc=200000;
                if($staff->esipf_status==1)
                {
                    if($deduction->name=='ESI'){
                        //$esi_salary_limit = 252000;
                        if($yearly_salary<$esi_salary_limit){
                            $esi = (($ctc * $deduction->percentage) / 100);
                        }else{
                            $esi=0;
                        }
                        $emp_deductions['esi']=$esi;
                    }
                    //Provident Fund (PF)
                    if($deduction->name=='Employer Contribution'){
                        $emp_deductions['employer_contribution'] = (($ctc * $deduction->percentage) / 100);
                    }
                    if($deduction->name=='Employee Contribution'){
                        $emp_deductions['employee_contribution'] = (($ctc * $deduction->percentage) / 100);
                    }

                }
                    //Bank 
                    // if($deduction->name=='C/Bank Loan'){
                    //     $emp_deductions['bank_loan'] = (($ctc * $deduction->percentage) / 100);
                    // }
                    //Other Allowance
                    if($deduction->name=='Other Deduction - LOAN'){
                        $emp_deductions['other_deduction'] = (($ctc * $deduction->percentage) / 100);
                    }

                    //Additional Deductions
                    $gross_wages = $permonth_salary;

                    $dearness_allawance =  (($gross_wages * $da_perecentage) / 100);                   

                    if($dearness_allawance>$max_da_allawance){
                        $dearness_allawance = $max_da_allawance;//15000;
                    }
                    

                    $epf_remitted =  (($dearness_allawance * $epf_remitted_percent) / 100);  
                    $eps_remitted =  (($dearness_allawance * $eps_remitted_percent) / 100); 
                    $epf_eps_diff = $epf_remitted - $eps_remitted;

                    $emp_other_deductions['epf_wages'] = $dearness_allawance;
                    $emp_other_deductions['eps_wages'] = $dearness_allawance;
                    $emp_other_deductions['edli_wages'] = $dearness_allawance;

                    $emp_other_deductions['epf_remitted'] = $epf_remitted;
                    $emp_other_deductions['eps_remitted'] = $eps_remitted;
                    $emp_other_deductions['epf_eps_diff'] = $epf_eps_diff;
                    $emp_other_deductions['ncp_days'] = 0;
                    $emp_other_deductions['refund_advance'] = 0;

                    //EPF CONTRI REMITTED G
                    //EPS CONTRI REMITTED H
                    //EPF EPS DIFF REMITTED I
                    //NCP DAYS J 
                    //REFUND OF ADVANCES K               
                }

                //Earnings
                $emp_earnings=[];                
                foreach($setting_earnings as $earnings){

                    if($earnings->name=='Basic Pay'){
                        $emp_basic_salary = (($ctc * $earnings->percentage) / 100);
                        $emp_earnings['emp_basic_salary'] = $emp_basic_salary;
                        //$emp_earnings['emp_basic_salary'] = (($ctc * $earnings->percentage) / 100);
                    }
                    //Provident Fund (PF)
                    if($earnings->name=='House Rent Allowance (H.R.A.)'){
                        //$emp_hra = (($emp_basic_salary * $earnings->percentage) / 100);
                        $emp_earnings['emp_hra'] = (($emp_basic_salary * $earnings->percentage) / 100);
                    }
                    if($earnings->name=='Bonus'){
                        //$bonus = (($ctc * $earnings->percentage) / 100);
                        $emp_earnings['bonus'] = (($ctc * $earnings->percentage) / 100);
                    }

                    //Bank 
                    if($earnings->name=='Conveyance'){
                        //$conveyance = (($ctc * $earnings->percentage) / 100);
                        $emp_earnings['conveyance'] = (($ctc * $earnings->percentage) / 100);
                    }
                    //Other Allowance
                    if($earnings->name=='Medical'){
                        //$medical = (($ctc * $earnings->percentage) / 100);
                        $emp_earnings['medical'] = (($ctc * $earnings->percentage) / 100);
                    }
                    if($earnings->name=='Other Allowance'){
                        //$other_allawance = (($ctc * $earnings->percentage) / 100);
                        $emp_earnings['other_allawance'] = (($ctc * $earnings->percentage) / 100);
                    }
                    if($earnings->name=='Performance Allowance'){
                        //$performance_allawance = (($ctc * $earnings->percentage) / 100);
                        $emp_earnings['performance_allawance'] = (($ctc * $earnings->percentage) / 100);
                    }  
                }
                

                // $payroll_generate = PayrollGenerate::where('staff_id',$staff->id)->where('school_id',Auth::user()->school_id)->whereDate('created_at', today())->first();
                $payslip_number=$staff->id."-".$staff->first_name."-".$payroll_month."-".$payroll_year;
                $emp_earnings_data = json_encode($emp_earnings, true);
                $emp_deductions_data = json_encode($emp_deductions, true);
                $emp_other_deductions_data = json_encode($emp_other_deductions, true);
                //delete existing
                //PayrollGenerate::where('staff_id', '=', $staff->id)->delete();

                $payroll_generate = new PayrollGenerate();
                $payroll_generate->staff_id = $staff->id;
                $payroll_generate->payslip_number = $payslip_number;
                $payroll_generate->salary = $permonth_salary;
                $payroll_generate->ctc = $ctc;
                $payroll_generate->earnings = $emp_earnings_data;
                $payroll_generate->deductions = $emp_deductions_data;
                $payroll_generate->other_deductions = $emp_other_deductions_data;
                $payroll_generate->school_id = Auth::user()->school_id;
                $payroll_generate->save();                
            }
            Toastr::success('Operation Sucessful', 'Success');
            return redirect()->route('staff_directory');
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function viewPayslip($id)
    {

        try {
            $payroll = SmStaff::select('payroll_generate.*','payroll_generate.created_at as payslip_date','sm_staffs.*','sm_staff_earnings.amount as earning','sm_staff_earnings.reason','sm_staff_deductions.amount as additional_deduction','sm_staff_deductions.reason','roles.name as role_name')
                ->leftjoin('sm_staff_earnings','sm_staff_earnings.staff_id','=','sm_staffs.id')
                ->leftjoin('sm_staff_deductions','sm_staff_deductions.staff_id','=','sm_staffs.id')
                ->leftjoin('payroll_generate','payroll_generate.staff_id','=','sm_staffs.id')
                ->leftjoin('roles','roles.id','=','sm_staffs.role_id')
                ->where('sm_staffs.active_status','=','1')
                ->where('sm_staffs.id',$id)
                ->where('sm_staffs.school_id', Auth::user()->school_id)
                ->orderBy('payroll_generate.created_at','desc')->first();
                $school = SmGeneralSettings::join('sm_academic_years', 'sm_academic_years.id', '=', 'sm_general_settings.session_id')->find(Auth::user()->school_id);
                
            //return view('backEnd.humanResource.payroll.payslip_all',compact('payroll_records','school'));
            return view('backEnd.humanResource.payroll.payslip',compact('payroll','school'));
            
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function downloadPayslip($id)
    {
        try {

            $payroll_records = SmStaff::select('payroll_generate.*','payroll_generate.created_at as payslip_date','sm_staffs.*','sm_staff_earnings.amount as earning','sm_staff_earnings.reason','sm_staff_deductions.amount as additional_deduction','sm_staff_deductions.reason','roles.name as role_name')
                ->leftjoin('sm_staff_earnings','sm_staff_earnings.staff_id','=','sm_staffs.id')
                ->leftjoin('sm_staff_deductions','sm_staff_deductions.staff_id','=','sm_staffs.id')
                ->leftjoin('payroll_generate','payroll_generate.staff_id','=','sm_staffs.id')
                ->leftjoin('roles','roles.id','=','sm_staffs.role_id')
                ->where('sm_staffs.active_status','=','1')
                ->where('sm_staffs.id',$id)
                ->where('sm_staffs.school_id', Auth::user()->school_id)
                ->orderBy('payroll_generate.created_at','desc')->get();
                
                $school = SmGeneralSettings::join('sm_academic_years', 'sm_academic_years.id', '=', 'sm_general_settings.session_id')->find(Auth::user()->school_id);

            //return view('backEnd.humanResource.payroll.payslip_download',compact('payroll'));
            
              //$pdf = PDF::loadView('backEnd.humanResource.payroll.payslip_download',compact('payroll','school'));
              $pdf = PDF::loadView('backEnd.humanResource.payroll.payslip_download_all',compact('payroll_records','school'));
                  return $pdf->download('document.pdf');
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

     public function downloadEmpPayslip(Request $request)
    {
        try {
            $id= $request->emp_id;
            $monthval= ($request->month==0) ? 1 : $request->month;
            $monthsAgo = Carbon::now()->subMonths($monthval);

            $payroll_records = SmStaff::select('payroll_generate.*','payroll_generate.created_at as payslip_date','sm_staffs.*','sm_staff_earnings.amount as earning','sm_staff_earnings.reason','sm_staff_deductions.amount as additional_deduction','sm_staff_deductions.reason','roles.name as role_name')
                ->leftjoin('sm_staff_earnings','sm_staff_earnings.staff_id','=','sm_staffs.id')
                ->leftjoin('sm_staff_deductions','sm_staff_deductions.staff_id','=','sm_staffs.id')
                ->leftjoin('payroll_generate','payroll_generate.staff_id','=','sm_staffs.id')
                ->leftjoin('roles','roles.id','=','sm_staffs.role_id')
                ->where('sm_staffs.active_status','=','1')
                ->where('sm_staffs.id',$id)
                ->where('sm_staffs.school_id', Auth::user()->school_id)
                ->where('payroll_generate.created_at', '>=', $monthsAgo)
                ->orderBy('payroll_generate.created_at','desc')->get();
                $school = SmGeneralSettings::join('sm_academic_years', 'sm_academic_years.id', '=', 'sm_general_settings.session_id')->find(Auth::user()->school_id);

            //return view('backEnd.humanResource.payroll.payslip_download',compact('payroll'));
            
              //$pdf = PDF::loadView('backEnd.humanResource.payroll.payslip_download',compact('payroll','school'));

              $pdf = PDF::loadView('backEnd.humanResource.payroll.payslip_download_all',compact('payroll_records','school'));
                 return $pdf->download('document.pdf');


        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function downloadEpf($id)
    {
        try 
        {
            $payroll_records = SmStaff::select('payroll_generate.*','payroll_generate.created_at as payslip_date','sm_staffs.*','sm_staff_earnings.amount as earning','sm_staff_earnings.reason','sm_staff_deductions.amount as additional_deduction','sm_staff_deductions.reason','roles.name as role_name')
                ->leftjoin('sm_staff_earnings','sm_staff_earnings.staff_id','=','sm_staffs.id')
                ->leftjoin('sm_staff_deductions','sm_staff_deductions.staff_id','=','sm_staffs.id')
                ->leftjoin('payroll_generate','payroll_generate.staff_id','=','sm_staffs.id')
                ->leftjoin('roles','roles.id','=','sm_staffs.role_id')
                ->where('sm_staffs.active_status','=','1')
                ->where('sm_staffs.esipf_status','=','1')
                //->where('sm_staffs.id',$id)
                ->where('sm_staffs.school_id', Auth::user()->school_id)
                ->whereYear('payroll_generate.created_at', now()->year)
                ->whereMonth('payroll_generate.created_at', now()->month)
                ->orderBy('payroll_generate.created_at','desc')->get();
                
                $school = SmGeneralSettings::join('sm_academic_years', 'sm_academic_years.id', '=', 'sm_general_settings.session_id')->find(Auth::user()->school_id);

                $filename = 'epf_' . time() . '.txt';
                foreach($payroll_records as $payroll)
                {
                    $emp_other_deductions = json_decode($payroll->other_deductions, true);

                    $epf_wages = $this->numberFormat($emp_other_deductions['eps_wages']);

                    $eps_wages = $this->numberFormat($emp_other_deductions['eps_wages']);
                    $edli_wages = $this->numberFormat($emp_other_deductions['edli_wages']);
                    $epf_remitted = $this->numberFormat($emp_other_deductions['epf_remitted']);
                    $eps_remitted = $this->numberFormat($emp_other_deductions['eps_remitted']);
                    $epf_eps_diff = $this->numberFormat($emp_other_deductions['epf_eps_diff']);
                    $ncp_days = $this->numberFormat($emp_other_deductions['ncp_days']);
                    $refund_advance = $this->numberFormat($emp_other_deductions['refund_advance']);

                    $content[] = $payroll->epf_no.'#~#'.$payroll->first_name.$payroll->last_name.'#~#'.$payroll->salary.'#~#'.$epf_wages.'#~#'.$eps_wages.'#~#'.$edli_wages.'#~#'.$epf_remitted.'#~#'.$eps_remitted.'#~#'.$epf_eps_diff.'#~#'.$ncp_days.'#~#'.$refund_advance."\n";                
                }
                
                // Path to the storage directory
                $path = storage_path('app/public/epf/' . $filename);
                // Create the text file
                file_put_contents($path, $content);
                // Download the file
                return response()->download($path, $filename)->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function downloadEpfAll()
    {
        try 
        {
            $payroll_records = SmStaff::select('payroll_generate.*','payroll_generate.created_at as payslip_date','sm_staffs.*','sm_staff_earnings.amount as earning','sm_staff_earnings.reason','sm_staff_deductions.amount as additional_deduction','sm_staff_deductions.reason','roles.name as role_name')
                ->leftjoin('sm_staff_earnings','sm_staff_earnings.staff_id','=','sm_staffs.id')
                ->leftjoin('sm_staff_deductions','sm_staff_deductions.staff_id','=','sm_staffs.id')
                ->leftjoin('payroll_generate','payroll_generate.staff_id','=','sm_staffs.id')
                ->leftjoin('roles','roles.id','=','sm_staffs.role_id')
                ->where('sm_staffs.active_status','=','1')
                ->where('sm_staffs.esipf_status','=','1')
                //->where('sm_staffs.id',$id)
                ->where('sm_staffs.school_id', Auth::user()->school_id)
                ->whereYear('payroll_generate.created_at', now()->year)
                ->whereMonth('payroll_generate.created_at', now()->month)
                ->orderBy('payroll_generate.created_at','desc')->get();
                
                $school = SmGeneralSettings::join('sm_academic_years', 'sm_academic_years.id', '=', 'sm_general_settings.session_id')->find(Auth::user()->school_id);

                $currentMonth = date('F'); 
                $filename = 'Epf_'.$currentMonth.'_' . time() . '.txt';
                foreach($payroll_records as $payroll)
                {
                    $emp_other_deductions = json_decode($payroll->other_deductions, true);

                    $epf_wages = $this->numberFormat($emp_other_deductions['eps_wages']);

                    $eps_wages = $this->numberFormat($emp_other_deductions['eps_wages']);
                    $edli_wages = $this->numberFormat($emp_other_deductions['edli_wages']);
                    $epf_remitted = $this->numberFormat($emp_other_deductions['epf_remitted']);
                    $eps_remitted = $this->numberFormat($emp_other_deductions['eps_remitted']);
                    $epf_eps_diff = $this->numberFormat($emp_other_deductions['epf_eps_diff']);
                    $ncp_days = $this->numberFormat($emp_other_deductions['ncp_days']);
                    $refund_advance = $this->numberFormat($emp_other_deductions['refund_advance']);

                    $content[] = $payroll->epf_no.'#~#'.$payroll->first_name.$payroll->last_name.'#~#'.$payroll->salary.'#~#'.$epf_wages.'#~#'.$eps_wages.'#~#'.$edli_wages.'#~#'.$epf_remitted.'#~#'.$eps_remitted.'#~#'.$epf_eps_diff.'#~#'.$ncp_days.'#~#'.$refund_advance."\n";                
                }
                
                // Path to the storage directory
                $path = storage_path('app/public/epf/' . $filename);
                // Create the text file
                file_put_contents($path, $content);
                // Download the file
                return response()->download($path, $filename)->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function payrollCalculation($salary)
    {
        try
        {
            $getTaxCharge = array(
                array(
                    'amount_range_from' => 0,
                    'amount_range_to' => 250000,
                    'tax_percentage' => 0,
                     ),
                array(
                    'amount_range_from' => 250001,
                    'amount_range_to' => 500000,
                    'tax_percentage' => 5,
                     ),
                array(
                    'amount_range_from' => 500001,
                    'amount_range_to' => 1000000,
                    'tax_percentage' =>20,
                     ),
                array(
                    'amount_range_from' => 1000001,
                    'amount_range_to' => 100000000000,
                    'tax_percentage' =>30,
                     )            
                );
                $calculateTaxOnAmount = $salary;
                $remainingAmount      = $calculateTaxOnAmount;
                $amount               = $calculateTaxOnAmount;
                $arrayAmount          = array();
                foreach ($getTaxCharge as $key => $value) {
                    $resultArray = array();
                    if ($calculateTaxOnAmount > $value['amount_range_to']) {
                        $sum                       = $value['amount_range_to'] - $value['amount_range_from'];
                        $resultArray['amount']     = $sum;
                        $resultArray['percentage'] = $value['tax_percentage'];
                        array_push($arrayAmount, $resultArray);
                        $remainingAmount = $remainingAmount - $sum;
                    } else {
                        $resultArray['amount']     = $remainingAmount;
                        $resultArray['percentage'] = $value['tax_percentage'];
                        array_push($arrayAmount, $resultArray);
                        break;
                    }
                }
                $resultantTaxAmount = 0;

                foreach ($arrayAmount as $key => $value) {
                    $cal                = (($value['amount'] * $value['percentage']) / 100);
                    $resultantTaxAmount = $resultantTaxAmount + $cal;
                }

                return round($resultantTaxAmount);
                // //echo "Tax paid on $starting_income is $total_tax_paid";

                //     exit;
                // Toastr::success('Operation Sucessful', 'Success');
                // return redirect()->route('payroll_settings');
            } catch (\Exception $e) {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
        }

    }

    public function numberFormat($number){
        $roundedNumber = round($number);

        // Format the rounded number without decimal places
        $formattedNumber = number_format($roundedNumber, 0, '', '');
        //$formattedNumber = number_format((float)$roundedNumber, 2, '.', '');
        return $formattedNumber;
    }

    public function updateCtcFormat(Request $request)
    {
        // Get the value to update from the request
        $ctc_month = $request->input('ctc_month');
        SmSchool::where('id', Auth::user()->school_id)
          ->update(['ctc_salary_month' => $ctc_month]);
        // Respond with a success message or any data you want
        return response()->json(['message' => 'CTC month Updated successfully']);
    }

}
