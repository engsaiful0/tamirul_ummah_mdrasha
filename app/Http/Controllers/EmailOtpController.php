<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use App\EmailOtp;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\User;
use App\SmEmailSetting;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;
use DB;
use session;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class EmailOtpController extends Controller
{

    public function emailOtpFrom(Request $request)
    {
        $adminInfo = User::find(1);
        $user = Auth::user();
        EmailOtp::where('email', $user->email)->delete();
        return view('frontEnd.otp.otp',compact('adminInfo','user'));
    }
    public function enterOtpFrom(Request $request)
    {
        $user = Auth::user();
        
        return view('frontEnd.otp.enterOtp',compact('user'));
    }
    

    public function generate(Request $request)
    {

        // Validate email
        $request->validate([
            'email' => 'required|email|unique:email_otps',
        ]);

        // Generate OTP
        //$otp = Str::random(6); // Generate a 6-character random OTP
        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT); 
        // Store OTP in the database with expiration timestamp
        $expiresAt = Carbon::now()->addMinutes(5); // OTP expires after 5 minutes

        
        EmailOtp::create([
            'email' => $request->email,
            'otp' => $otp,
            'expires_at' => $expiresAt,
        ]);

        $e = SmEmailSetting::where('active_status',1)->where('school_id', 1)->first();
        if (empty($e)) {
            Toastr::error('Email Setting is Not Complete', 'Failed');
            return redirect()->back();
        }


        if ( ($e->mail_driver == "smtp") &&( $e->mail_username == '' || $e->mail_password == ''
                || $e->mail_encryption == ''
                || $e->mail_port == ''
                || $e->mail_host == ''
                || $e->mail_driver == '' ))
        {
            Toastr::error('All Field in Smtp Details Must Be filled Up', 'Failed');
            return redirect()->back();
        }

        try {
            $user = User::find(1);

            $receiverEmail = $request->receiver_email;
            $receiverName = $user->full_name;

            $authUser = Auth::user();

            $data = [
                'receiver_name' => $receiverName,
                'otp' => $otp,
                'user_name' => $authUser->full_name,
                'user_email' => $authUser->email,
            ];
            //dd($data);
            try {

                 if (Schema::hasTable('sm_email_settings')) {
                    $config =  DB::table('sm_email_settings')
                            ->where('mail_driver', 'smtp')
                            ->first();

                    if ($config) {
                        Config::set('mail.driver', $config->mail_driver);
                        Config::set('mail.from', $config->mail_username);
                        Config::set('mail.name', $config->from_name);
                        Config::set('mail.host', $config->mail_host);
                        Config::set('mail.port', $config->mail_port);
                        Config::set('mail.username', $config->mail_username);
                        Config::set('mail.password', $config->mail_password);
                        Config::set('mail.encryption', $config->mail_encryption);
                    }
                }

                $setting = SmEmailSetting::where('school_id',1)->where('active_status', 1)->first();

                if (!$setting) {
                    return;
                }

                $senderEmail = $setting->from_email;
                $senderName = $setting->from_name;
                //$email_driver = $setting->mail_driver;

                Mail::to($receiverEmail)->send(new SendEmail($data, $senderEmail, $senderName));
                return redirect()->route('enter-otp')->with('message', 'OTP send successfully.');
                //return redirect('enter-otp');
            } catch (\Exception $e) {
                // Log the exception message
                // print_r($e->getMessage());
                // exit;
                logger()->error('Error sending email: ' . $e->getMessage());

                // Return an error response or redirect with an error message
                return response()->json(['error' => 'Failed to send email'], 500);
            }

        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Failed');
            return redirect()->back();
        }

    }

    public function verify(Request $request)
    {
       
        // Validate OTP and email
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        // Retrieve the OTP from the database
        $emailOtp = EmailOtp::where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', now())
            ->first();

        session(['otp-verify' => 'false']);
        if ($emailOtp) {
            // OTP is valid
            // Perform further actions (e.g., login the user)
            // Clear the OTP from the database
            $emailOtp->delete();
            session(['otp-verify' => 'true']);
            return redirect()->route('dashboard')->with('success', 'OTP verified successfully.');
        } else {
            // Invalid OTP or OTP expired
            return redirect()->back()->with('error', 'Invalid or expired OTP. Please try again.');
        }
    }
}

