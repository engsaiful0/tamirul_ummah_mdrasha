<?php

namespace App\Http\Controllers\Admin\Communicate;

use App\Jobs\sendSmsJob;
use Exception;
use Mail;
use Twilio;
use App\Role;
use App\User;
use App\SmClass;
use App\SmStaff;
use App\SmParent;
use App\SmStudent;
use App\YearCheck;
use Carbon\Carbon;
use Clickatell\Rest;
use App\SmSmsGateway;
use App\ApiBaseMethod;
use App\SmEmailSmsLog;
use App\SmNoticeBoard;
use App\SmEmailSetting;
use App\SmNotification;
use App\Jobs\SendEmailJob;
use App\SmGeneralSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Notifications\CommunicateNotification;
use Modules\RolePermission\Entities\InfixRole;
use App\Http\Requests\Admin\Communicate\SendEmailSmsRequest;
use App\Models\StudentRecord;
use Modules\University\Http\Controllers\CommunicateController;
use Modules\University\Http\Controllers\UnCommonController;
use Modules\University\Http\Controllers\UnCommunicateController;

class SmCommunicateController extends Controller
{

    public function __construct()
    {
        $this->middleware('PM');
    }


    public function sendEmailSmsView(Request $request)
    {
        try {
            $roles = InfixRole::select('*')->where('id', '!=', 1)->where(function ($q) {
                $q->where('school_id', Auth::user()->school_id)->orWhere('type', 'System');
            })->get();
            $classes = SmClass::get();

            return view('backEnd.communicate.sendEmailSms', compact('roles', 'classes'));
        } catch (Exception $e) {

            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    
    public function sendEmailSms(SendEmailSmsRequest $request)
    {
        try {
            if(moduleStatusCheck('University')){
                $unCommunicate = new UnCommunicateController();
                return $unCommunicate->unEmailSms($request);
            }else{
                $saveEmailSmsLogData = new SmEmailSmsLog();
                $saveEmailSmsLogData->saveEmailSmsLogData($request);

                if (empty($request->selectTab) or $request->selectTab == 'G') {
                    if (empty($request->role)) {
                        Toastr::error('Please select whom you want to send', 'Failed');
                        return redirect()->back();
                    } else {
                        if ($request->send_through == 'E') {
                            // Check if email settings are configured
                            $school_id = Auth::check() && saasSettings('email_settings') ? Auth::user()->school_id : 1;
                            $emailSetting = SmEmailSetting::where('school_id', $school_id)->where('active_status', 1)->first();
                            
                            if (!$emailSetting) {
                                Toastr::error('Email settings are not configured. Please configure email settings first.', 'Failed');
                                return redirect()->back();
                            }
                            
                            // Check if email template exists
                            $template = getTempleteDetails('communication_sent_email', 'email');
                            if (!$template) {
                                Toastr::error('Email template not found. Please configure email template first.', 'Failed');
                                return redirect()->back();
                            }
                            
                            $to_name = '';
                            $to_email = [];
                            $to_mobile = [];
                            $receiverDetails = '';

                            foreach ($request->role as $role_id) {
                                if ($role_id == 2) {
                                    $receiverDetails = SmStudent::select('email', 'full_name', 'mobile')
                                        ->where('active_status', 1)
                                        ->where('academic_id', getAcademicId())
                                        ->get();
                                } elseif ($role_id == 3) {
                                    $receiverDetails = SmParent::select('guardians_email as email', 'fathers_name as full_name', 'fathers_mobile as mobile')
                                        ->where('academic_id', getAcademicId())
                                        ->get();
                                } else {
                                    $receiverDetails = SmStaff::select('email', 'full_name', 'mobile')
                                        ->where('role_id', $role_id)
                                        ->where('active_status', 1)
                                        ->get();
                                }

                                foreach ($receiverDetails as $receiverDetail) {
                                    $to_name = $receiverDetail->full_name;
                                    if (!empty($receiverDetail->email)) {
                                        $to_email[] = $receiverDetail->email;
                                    }
                                    $to_mobile[] = $receiverDetail->mobile;
                                }
                                $to_email = array_filter($to_email);
                            }

                            if (empty($to_email)) {
                                Toastr::error('No valid email addresses found for selected recipients.', 'Failed');
                                return redirect()->back();
                            }

                            $compact['title'] = $request->email_sms_title;
                            $compact['description'] = $request->description;

                            $sentCount = 0;
                            $failedCount = 0;
                            
                            foreach ($to_email as $reciverEmail) {
                                try {
                                    send_mail($reciverEmail, $to_name, "communication_sent_email", $compact);
                                    $sentCount++;
                                } catch (\Exception $e) {
                                    Log::error('Failed to send email to ' . $reciverEmail . ': ' . $e->getMessage());
                                    $failedCount++;
                                }
                            }

                            if ($sentCount > 0) {
                                Toastr::success("Email sent successfully to {$sentCount} recipient(s)" . ($failedCount > 0 ? ". {$failedCount} failed." : ''), 'Success');
                            } else {
                                Toastr::error('Failed to send emails. Please check email settings and try again.', 'Failed');
                            }
                            return redirect()->back();
                        } else {
                            // Check if SMS gateway is configured
                            $activeGateway = activeSmsGateway();
                            if (!$activeGateway) {
                                Toastr::error('SMS gateway is not configured. Please configure SMS gateway first.', 'Failed');
                                return redirect()->back();
                            }
                            
                            // Check if SMS template exists
                            $template = getTempleteDetails('communicate_sms', 'sms');
                            if (!$template) {
                                Toastr::error('SMS template not found. Please configure SMS template first.', 'Failed');
                                return redirect()->back();
                            }
                            
                            $to_name = '';
                            $to_email = '';
                            $to_mobile = '';
                            $receiverDetails = '';
                            $receiver_numbers = [];
                            
                            foreach ($request->role as $role_id) {
                                if ($role_id == 2) {
                                    $receiverDetails = SmStudent::select('email', 'full_name', 'mobile')
                                        ->where('active_status', 1)
                                        ->where('academic_id', getAcademicId())
                                        ->where('school_id', Auth::user()->school_id)
                                        ->get();

                                } elseif ($role_id == 3) {
                                    $receiverDetails = SmParent::select('guardians_email as email', 'fathers_name as full_name', 'fathers_mobile as mobile')
                                        ->where('school_id', Auth::user()->school_id)
                                        ->where('academic_id', getAcademicId())
                                        ->get();
                                } else {
                                    $receiverDetails = SmStaff::select('email', 'full_name', 'mobile')
                                        ->where('role_id', $role_id)
                                        ->where('active_status', 1)
                                        ->where('school_id', Auth::user()->school_id)
                                        ->get();
                                }

                                foreach ($receiverDetails as $receiverDetail) {
                                    $to_name = $receiverDetail->full_name;
                                    $to_email = $receiverDetail->email;
                                    $to_mobile = $receiverDetail->mobile;
                                    if ($receiverDetail->mobile != null && !empty($receiverDetail->mobile)) {
                                        $receiver_numbers[] = $receiverDetail->mobile;
                                    }

                                    if ($activeGateway->gateway_name != 'Mobile SMS' && !empty($to_mobile)) {
                                        try {
                                            send_sms($to_mobile, 'communicate_sms', ['description' => $request->description]);
                                        } catch (\Exception $e) {
                                            Log::error('Failed to send SMS to ' . $to_mobile . ': ' . $e->getMessage());
                                        }
                                    }
                                }

                                // Send SMS Convert to Flutter Notification Start
                                if ($activeGateway->gateway_name == 'Mobile SMS' && apk_secret()) {
                                    config(['services.fcm.key' => apk_secret()]);
                                    $user = User::find(Auth::user()->id);
                                    $job = (new sendSmsJob($request->description, $request->email_sms_title, $receiver_numbers, $user))
                                        ->delay(now()->addSeconds(2));
                                    dispatch($job);
                                }
                                // Send SMS Convert to Flutter Notification End
                            }
                            
                            if (empty($receiver_numbers)) {
                                Toastr::error('No valid mobile numbers found for selected recipients.', 'Failed');
                                return redirect()->back();
                            }
                            
                            Toastr::success('SMS sent successfully to ' . count($receiver_numbers) . ' recipient(s)', 'Success');
                            return redirect()->back();
                        }
                    }
                } else if ($request->selectTab == 'I') {
                    if (empty($request->message_to_individual)) {
                        Toastr::error('Please select whom you want to send', 'Failed');
                        return redirect()->back();
                    } else {
                        if ($request->send_through == 'E') {
                            // Check if email settings are configured
                            $school_id = Auth::check() && saasSettings('email_settings') ? Auth::user()->school_id : 1;
                            $emailSetting = SmEmailSetting::where('school_id', $school_id)->where('active_status', 1)->first();
                            
                            if (!$emailSetting) {
                                Toastr::error('Email settings are not configured. Please configure email settings first.', 'Failed');
                                return redirect()->back();
                            }
                            
                            // Check if email template exists
                            $template = getTempleteDetails('communication_sent_email', 'email');
                            if (!$template) {
                                Toastr::error('Email template not found. Please configure email template first.', 'Failed');
                                return redirect()->back();
                            }
                            
                            $message_to_individual = $request->message_to_individual;

                            $to_email = [];
                            $to_mobile = [];
                            foreach ($message_to_individual as $key => $value) {
                                $receiver_full_name_email = explode('-', $value);
                                $receiver_full_name = $receiver_full_name_email[0];
                                $receiver_email = $receiver_full_name_email[1];
                                $receiver_mobile = $receiver_full_name_email[2];
                                $to_name = $receiver_full_name;
                                if (!empty($receiver_email)) {
                                    $to_email[] = $receiver_email;
                                }
                                $to_mobile[] = $receiver_mobile;
                            }

                            $to_email = array_filter($to_email);

                            if (empty($to_email)) {
                                Toastr::error('No valid email addresses found for selected recipients.', 'Failed');
                                return redirect()->back();
                            }

                            $compact['title'] = $request->email_sms_title;
                            $compact['description'] = $request->description;

                            $sentCount = 0;
                            $failedCount = 0;
                            
                            foreach ($to_email as $reciverEmail) {
                                try {
                                    send_mail($reciverEmail, $to_name, "communication_sent_email", $compact);
                                    $sentCount++;
                                } catch (\Exception $e) {
                                    Log::error('Failed to send email to ' . $reciverEmail . ': ' . $e->getMessage());
                                    $failedCount++;
                                }
                            }

                            if ($sentCount > 0) {
                                Toastr::success("Email sent successfully to {$sentCount} recipient(s)" . ($failedCount > 0 ? ". {$failedCount} failed." : ''), 'Success');
                            } else {
                                Toastr::error('Failed to send emails. Please check email settings and try again.', 'Failed');
                            }
                            return redirect()->back();
                        } else {
                            // Check if SMS gateway is configured
                            $activeGateway = activeSmsGateway();
                            if (!$activeGateway) {
                                Toastr::error('SMS gateway is not configured. Please configure SMS gateway first.', 'Failed');
                                return redirect()->back();
                            }
                            
                            // Check if SMS template exists
                            $template = getTempleteDetails('communicate_sms', 'sms');
                            if (!$template) {
                                Toastr::error('SMS template not found. Please configure SMS template first.', 'Failed');
                                return redirect()->back();
                            }
                            
                            $message_to_individual = $request->message_to_individual;
                            $receiver_numbers = [];

                            foreach ($message_to_individual as $key => $value) {
                                $receiver_full_name_email = explode('-', $value);
                                $receiver_full_name = $receiver_full_name_email[0];
                                $receiver_email = $receiver_full_name_email[1];
                                $receiver_mobile = $receiver_full_name_email[2];
                                $to_name = $receiver_full_name;
                                $to_email = $receiver_email;
                                $to_mobile = $receiver_mobile;
                                if ($to_mobile != null && !empty($to_mobile)) {
                                    $receiver_numbers[] = $to_mobile;
                                }

                                if ($activeGateway->gateway_name != 'Mobile SMS' && !empty($to_mobile)) {
                                    try {
                                        send_sms($to_mobile, 'communicate_sms',  ['description' => $request->description]);
                                    } catch (\Exception $e) {
                                        Log::error('Failed to send SMS to ' . $to_mobile . ': ' . $e->getMessage());
                                    }
                                }
                            }
                            
                            if (empty($receiver_numbers)) {
                                Toastr::error('No valid mobile numbers found for selected recipients.', 'Failed');
                                return redirect()->back();
                            }
                            
                            // Send SMS Convert to Flutter Notification Start
                            if ($activeGateway->gateway_name == 'Mobile SMS' && apk_secret()) {
                                config(['services.fcm.key' => apk_secret()]);
                                $user = User::find(Auth::user()->id);
                                $job = (new sendSmsJob($request->description, $request->email_sms_title, $receiver_numbers, $user))
                                    ->delay(now()->addSeconds(2));
                                dispatch($job);
                            }
                            // Send SMS Convert to Flutter Notification End
                            
                            Toastr::success('SMS sent successfully to ' . count($receiver_numbers) . ' recipient(s)', 'Success');
                            return redirect()->back();
                        }
                    }
                } else {
                    if (empty($request->message_to_section)) {
                        Toastr::error('Please select whom you want to send', 'Failed');
                        return redirect()->back();
                    } else {
                        if ($request->send_through == 'E') {
                            // Check if email settings are configured
                            $school_id = Auth::check() && saasSettings('email_settings') ? Auth::user()->school_id : 1;
                            $emailSetting = SmEmailSetting::where('school_id', $school_id)->where('active_status', 1)->first();
                            
                            if (!$emailSetting) {
                                Toastr::error('Email settings are not configured. Please configure email settings first.', 'Failed');
                                return redirect()->back();
                            }
                            
                            // Check if email template exists
                            $template = getTempleteDetails('communication_sent_email', 'email');
                            if (!$template) {
                                Toastr::error('Email template not found. Please configure email template first.', 'Failed');
                                return redirect()->back();
                            }
                            
                            $class_id = $request->class_id;
                            $selectedSections = $request->message_to_section;
                            $to_email = [];
                            $to_mobile = [];
                            foreach ($selectedSections as $key => $value) {
                                $student_ids = StudentRecord::where('class_id', $class_id)
                                                ->where('section_id', $value)
                                                ->where('academic_id', getAcademicId())
                                                ->where('school_id', auth()->user()->school_id)
                                                ->pluck('student_id')->unique();
                                $students = SmStudent::select('email', 'full_name', 'mobile')
                                    ->whereIn('id', $student_ids)
                                    ->where('active_status', 1)
                                    ->get();

                                foreach ($students as $student) {
                                    $to_name = $student->full_name;
                                    if (!empty($student->email)) {
                                        $to_email[] = $student->email;
                                    }
                                    $to_mobile[] = $student->mobile;
                                }
                                $to_email = array_filter($to_email);
                            }

                            if (empty($to_email)) {
                                Toastr::error('No valid email addresses found for selected recipients.', 'Failed');
                                return redirect()->back();
                            }

                            $compact['title'] = $request->email_sms_title;
                            $compact['description'] = $request->description;

                            $sentCount = 0;
                            $failedCount = 0;
                            
                            foreach ($to_email as $reciverEmail) {
                                try {
                                    send_mail($reciverEmail, $to_name, "communication_sent_email", $compact);
                                    $sentCount++;
                                } catch (\Exception $e) {
                                    Log::error('Failed to send email to ' . $reciverEmail . ': ' . $e->getMessage());
                                    $failedCount++;
                                }
                            }

                            if ($sentCount > 0) {
                                Toastr::success("Email sent successfully to {$sentCount} recipient(s)" . ($failedCount > 0 ? ". {$failedCount} failed." : ''), 'Success');
                            } else {
                                Toastr::error('Failed to send emails. Please check email settings and try again.', 'Failed');
                            }
                            return redirect()->back();
                        } else {
                            // Check if SMS gateway is configured
                            $activeGateway = activeSmsGateway();
                            if (!$activeGateway) {
                                Toastr::error('SMS gateway is not configured. Please configure SMS gateway first.', 'Failed');
                                return redirect()->back();
                            }
                            
                            // Check if SMS template exists
                            $template = getTempleteDetails('communicate_sms', 'sms');
                            if (!$template) {
                                Toastr::error('SMS template not found. Please configure SMS template first.', 'Failed');
                                return redirect()->back();
                            }
                            
                            $class_id = $request->class_id;
                            $selectedSections = $request->message_to_section;
                            $receiver_numbers = [];
                            
                            foreach ($selectedSections as $key => $value) {
                                $student_ids = StudentRecord::where('class_id', $class_id)
                                                ->where('section_id', $value)
                                                ->where('academic_id', getAcademicId())
                                                ->where('school_id', auth()->user()->school_id)
                                                ->pluck('student_id')->unique();
                                $students = SmStudent::select('email', 'full_name', 'mobile')
                                    ->whereIn('id', $student_ids)
                                    ->where('active_status', 1)
                                    ->get();

                                foreach ($students as $student) {
                                    $to_name = $student->full_name;
                                    $to_email = $student->email;
                                    $to_mobile = $student->mobile;
                                    if ($to_mobile != null && !empty($to_mobile)) {
                                        $receiver_numbers[] = $to_mobile;
                                    }
                                    if ($activeGateway->gateway_name != 'Mobile SMS' && !empty($to_mobile)) {
                                        try {
                                            send_sms($to_mobile, 'communicate_sms',  ['description' => $request->description]);
                                        } catch (\Exception $e) {
                                            Log::error('Failed to send SMS to ' . $to_mobile . ': ' . $e->getMessage());
                                        }
                                    }
                                }
                            }
                            
                            if (empty($receiver_numbers)) {
                                Toastr::error('No valid mobile numbers found for selected recipients.', 'Failed');
                                return redirect()->back();
                            }
                            
                            // Send SMS Convert to Flutter Notification Start
                            if ($activeGateway->gateway_name == 'Mobile SMS' && apk_secret()) {
                                config(['services.fcm.key' => apk_secret()]);
                                $user = User::find(Auth::user()->id);
                                $job = (new sendSmsJob($request->description, $request->email_sms_title, $receiver_numbers, $user))
                                    ->delay(now()->addSeconds(2));
                                dispatch($job);
                            }
                            // Send SMS Convert to Flutter Notification End
                            
                            Toastr::success('SMS sent successfully to ' . count($receiver_numbers) . ' recipient(s)', 'Success');
                            return redirect()->back();
                        }
                    }
                }
            }
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function studStaffByRole(Request $request)
    {
        try {
            if ($request->id == 2) {
                $allStudents = SmStudent::where('active_status', '=', 1)
                            ->where('school_id', Auth::user()->school_id)
                            ->get();
                $students = [];
                foreach ($allStudents as $allStudent) {
                    $students[] = SmStudent::find($allStudent->id);
                }
                return response()->json([$students]);
            }

            if ($request->id == 3) {
                $Parents = SmParent::where('school_id', Auth::user()->school_id)
                    ->get();
                return response()->json([$Parents]);
            }

            if ($request->id != 2 and $request->id != 3) {
                $allStaffs = SmStaff::whereRole($request->id)
                            ->where('school_id', Auth::user()->school_id)
                            ->where('active_status', '=', 1)
                            ->get();
                $staffs = [];
                foreach ($allStaffs as $staffsvalue) {
                    $staffs[] = SmStaff::find($staffsvalue->id);
                }

                return response()->json([$staffs]);
            }
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function emailSmsLog()
    {
        try {
            $emailSmsLogs = SmEmailSmsLog::where('academic_id', getAcademicId())
                ->orderBy('id', 'DESC')
                ->where('school_id', Auth::user()->school_id)
                ->get();
            // return getAcademicId();
            return view('backEnd.communicate.emailSmsLog', compact('emailSmsLogs'));
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }


}