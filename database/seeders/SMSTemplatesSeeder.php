<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;


class SMSTemplatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sms_templates = [
  ['id' => '44','type' => 'email','purpose' => 'test_mail','subject' => 'Test Mail','body' => '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
                <tbody>
                    <tr style="vertical-align:top;" valign="top">
                        <td style="vertical-align:top;" valign="top">
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">
                                                    <a href="#">
                                                        <img border="0" class="center fixedwidth" src="" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                                    <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <h1 style="line-height:120%;text-align:center;margin-bottom:0px;">
                                                    <font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif">
                                                        <span style="font-size:36px;">Test Mail</span>
                                                    </font>
                                                </h1>
                                                <div style="line-height:1.8;padding:20px 15px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                                        <h1>Hi [user_name] ,</h1>
                                                        <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                            It is test email . If your email configuration is okay then you will be got this email .Thank You [school_name]
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div style="color:#262b30;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#262b30;">
                                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;">
                                                            <span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">
                                                                [email_footer_content]
                                                            </span>
                                                            <br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>','module' => '','variable' => '[user_name], [school_name],[email_footer_content]','status' => '1','school_id' => '1','created_at' => '2023-08-10 10:06:12','updated_at' => '2023-08-10 10:06:12'],
  ['id' => '45','type' => 'email','purpose' => 'password_reset','subject' => 'Password Reset','body' => '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
                    <tbody>
                        <tr style="vertical-align:top;" valign="top">
                            <td style="vertical-align:top;" valign="top">
                                <div style="background-color:#415094;">
                                    <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                        <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">
                                            <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                                <div class="col_cont" style="width:100%;">
                                                    <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">
                                                        <a href="#">
                                                            <img border="0" class="center fixedwidth" src="" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="background-color:#415094;">
                                    <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                                        <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                            <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                                <div class="col_cont" style="width:100%;">
                                                    <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="background-color:#7c32ff;">
                                    <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                                        <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">
                                            <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                                <div class="col_cont" style="width:100%;">
                                                    <h1 style="line-height:120%;text-align:center;margin-bottom:0px;">
                                                        <font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif">
                                                            <span style="font-size:36px;">Password Reset</span>
                                                        </font>
                                                    </h1>
                                                    <div style="line-height:1.8;padding:20px 15px;">
                                                        <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                                            <h1>Hi [name],</h1>
                                                            <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                                Tap the button below to reset your account password. If you didnt request a new password, you can safely delete this email.
                                                            </p>
                                                            <p style="text-align:center;margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);"> 
                                                                <a href="[reset_link]" target="_blank" style="font-size:12px;line-height:40px;background:#7c32ff;color:#fff;letter-spacing:1px;font-weight:500;padding:19px 52px;text-align:center;text-transform:uppercase;border:0;text-decoration:none;font-family:Arial, Helvetica Neue, Helvetica;" rel="noreferrer noopener">
                                                                    RESET LINK
                                                                </a>
                                                            </p>
                                                            <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                                This password reset link will expire in 60 minutes.
                                                            </p>
                                                            <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                                If you did not request a password reset, no further action is required.
                                                            </p>
                                                            <p style="text-align:left;margin:0px;line-height:1.8;">
                                                                <br>
                                                            </p>
                                                            </br>
                                                            Thank You, [school_name]
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="background-color:#7c32ff;">
                                    <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                        <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                            <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                                <div class="col_cont" style="width:100%;">
                                                    <div style="color:#262b30;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                                        <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#262b30;">
                                                            <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;">
                                                                <span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">
                                                                [email_footer_content]
                                                            </span>
                                                                <br>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
            </table>','module' => '','variable' => '[name], [reset_link], [school_name],[email_footer_content]','status' => '1','school_id' => '1','created_at' => '2023-08-10 10:06:12','updated_at' => '2023-08-10 10:06:12'],
  ['id' => '46','type' => 'email','purpose' => 'student_login_credentials','subject' => 'Student Login Credentials','body' => '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
                <tbody>
                    <tr style="vertical-align:top;" valign="top">
                        <td style="vertical-align:top;" valign="top">
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">
                                                    <a href="#">
                                                        <img border="0" class="center fixedwidth" src="" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                                    <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <h1 style="line-height:120%;text-align:center;margin-bottom:0px;">
                                                    <font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif">
                                                        <span style="font-size:36px;">Student Login Credentials</span>
                                                    </font>
                                                </h1>
                                                <div style="line-height:1.8;padding:20px 15px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                                        <h1>Hi [student_name] ,</h1>
                                                        <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                            Welcome to [school_name]. Congratulations ! You have registered successfully. Please login using this username [username] and password [password]. Thank You, [school_name]
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div style="color:#262b30;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#262b30;">
                                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;">
                                                            <span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">
                                                                [email_footer_content]
                                                            </span>
                                                            <br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>','module' => '','variable' => '[student_name], [school_name], [username], [password],[email_footer_content]','status' => '1','school_id' => '1','created_at' => '2023-08-10 10:06:12','updated_at' => '2023-08-10 10:06:12'],
  ['id' => '47','type' => 'email','purpose' => 'frontend_contact','subject' => 'Contact','body' => '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
                <tbody>
                    <tr style="vertical-align:top;" valign="top">
                        <td style="vertical-align:top;" valign="top">
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">
                                                    <a href="#">
                                                        <img border="0" class="center fixedwidth" src="" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                                    <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div style="line-height:1.8;padding:20px 15px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                                        <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                            Contact Email From : [contact_name]
                                                            </br>
                                                            Email : [contact_email]
                                                            </br>
                                                            Subject : [contact_subject]
                                                            </br>
                                                            message: [contact_message]
                                                            </br>
                                                            Thank You, [school_name]
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div style="color:#262b30;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#262b30;">
                                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;">
                                                            <span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">
                                                                [email_footer_content]
                                                            </span>
                                                            <br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>','module' => '','variable' => '[contact_name], [contact_email], [contact_subject], [contact_message], [school_name],[email_footer_content]','status' => '1','school_id' => '1','created_at' => '2023-08-10 10:06:12','updated_at' => '2023-08-10 10:06:12'],
  ['id' => '48','type' => 'email','purpose' => 'communication_sent_email','subject' => 'Sent Email','body' => '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
                <tbody>
                    <tr style="vertical-align:top;" valign="top">
                        <td style="vertical-align:top;" valign="top">
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">
                                                    <a href="#">
                                                        <img border="0" class="center fixedwidth" src="" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                                    <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <h1 style="line-height:120%;text-align:center;margin-bottom:0px;">
                                                    <font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif">
                                                        <span style="font-size:36px;"></span>
                                                    </font>
                                                </h1>
                                                <div style="line-height:1.8;padding:20px 15px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                                        <h1></h1>
                                                        <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                            Title : [title]
                                                            </br>
                                                            Description : [description]
                                                            </br>
                                                            Thank You, [school_name]
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div style="color:#262b30;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#262b30;">
                                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;">
                                                            <span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">
                                                                [email_footer_content]
                                                            </span>
                                                            <br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>','module' => '','variable' => '[title], [description], [school_name],[email_footer_content]','status' => '1','school_id' => '1','created_at' => '2023-08-10 10:06:12','updated_at' => '2023-08-10 10:06:12'],
  ['id' => '49','type' => 'email','purpose' => 'parent_login_credentials','subject' => 'Parent Login Credentials','body' => '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
                <tbody>
                    <tr style="vertical-align:top;" valign="top">
                        <td style="vertical-align:top;" valign="top">
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">
                                                    <a href="#">
                                                        <img border="0" class="center fixedwidth" src="" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                                    <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <h1 style="line-height:120%;text-align:center;margin-bottom:0px;">
                                                    <font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif">
                                                        <span style="font-size:36px;">Parent Login Credentials</span>
                                                    </font>
                                                </h1>
                                                <div style="line-height:1.8;padding:20px 15px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                                        <h1>Hi [father_name] ,</h1>
                                                        <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                            Welcome to [school_name]. Congratulations ! You have registered successfully. Please login using this username [username] and password [password]. Thank You, [school_name]
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div style="color:#262b30;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#262b30;">
                                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;">
                                                            <span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">
                                                                [email_footer_content]
                                                            </span>
                                                            <br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>','module' => '','variable' => '[student_name], [father_name], [school_name], [username], [password],[email_footer_content]','status' => '1','school_id' => '1','created_at' => '2023-08-10 10:06:12','updated_at' => '2023-08-10 10:06:12'],
  ['id' => '50','type' => 'email','purpose' => 'staff_login_credentials','subject' => 'Staff Login Credentials','body' => '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
                <tbody>
                    <tr style="vertical-align:top;" valign="top">
                        <td style="vertical-align:top;" valign="top">
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">
                                                    <a href="#">
                                                        <img border="0" class="center fixedwidth" src="" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                                    <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <h1 style="line-height:120%;text-align:center;margin-bottom:0px;">
                                                    <font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif">
                                                        <span style="font-size:36px;">Staff Login Credentials</span>
                                                    </font>
                                                </h1>
                                                <div style="line-height:1.8;padding:20px 15px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                                        <h1>Hi [name] ,</h1>
                                                        <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                            Welcome to [school_name]. Congratulations ! You have registered successfully. Please login using this username [username] and password [password]. Thank You, [school_name]
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div style="color:#262b30;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#262b30;">
                                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;">
                                                            <span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">
                                                                [email_footer_content]
                                                            </span>
                                                            <br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>','module' => '','variable' => '[name], [school_name], [username], [password],[email_footer_content]','status' => '1','school_id' => '1','created_at' => '2023-08-10 10:06:12','updated_at' => '2023-08-10 10:06:12'],
  ['id' => '51','type' => 'email','purpose' => 'due_fees_payment','subject' => 'Duee Fees Payment','body' => '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
                <tbody>
                    <tr style="vertical-align:top;" valign="top">
                        <td style="vertical-align:top;" valign="top">
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">
                                                    <a href="#">
                                                        <img border="0" class="center fixedwidth" src="" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                                    <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <h1 style="line-height:120%;text-align:center;margin-bottom:0px;">
                                                    <font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif">
                                                        <span style="font-size:36px;">Dues Payment</span>
                                                    </font>
                                                </h1>
                                                <div style="line-height:1.8;padding:20px 15px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                                        <h1>Hi [student_name],</h1>
                                                        <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                            You fees due amount [due_amount] for [fees_name] on [date]. Thank You, [school_name]
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div style="color:#262b30;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#262b30;">
                                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;">
                                                            <span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">
                                                                [email_footer_content]
                                                            </span>
                                                            <br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>','module' => '','variable' => '[student_name], [due_amount], [fees_name], [date], [school_name],[email_footer_content]','status' => '1','school_id' => '1','created_at' => '2023-08-10 10:06:12','updated_at' => '2023-08-10 10:06:12'],
  ['id' => '52','type' => 'email','purpose' => 'dues_payment','subject' => 'Dues Payment','body' => '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
                <tbody>
                    <tr style="vertical-align:top;" valign="top">
                        <td style="vertical-align:top;" valign="top">
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">
                                                    <a href="#">
                                                        <img border="0" class="center fixedwidth" src="" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                                    <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <h1 style="line-height:120%;text-align:center;margin-bottom:0px;">
                                                    <font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif">
                                                        <span style="font-size:36px;">Dues Payment</span>
                                                    </font>
                                                </h1>
                                                <div style="line-height:1.8;padding:20px 15px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                                        <h1>Hi [student_name],</h1>
                                                        <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                            You fees due amount [due_amount] for [fees_name] on [date]. Thank You, [school_name]
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div style="color:#262b30;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#262b30;">
                                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;">
                                                            <span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">
                                                                [email_footer_content]
                                                            </span>
                                                            <br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>','module' => 'Fees','variable' => '[student_name], [due_amount], [fees_name], [date], [school_name],[email_footer_content]','status' => '1','school_id' => '1','created_at' => '2023-08-10 10:06:12','updated_at' => '2023-08-10 10:06:12'],
  ['id' => '53','type' => 'email','purpose' => 'parent_reject_bank_payment','subject' => 'Reject Bank Payment','body' => '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
                <tbody>
                    <tr style="vertical-align:top;" valign="top">
                        <td style="vertical-align:top;" valign="top">
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">
                                                    <a href="#">
                                                        <img border="0" class="center fixedwidth" src="" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                                    <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <h1 style="line-height:120%;text-align:center;margin-bottom:0px;">
                                                    <font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif">
                                                        <span style="font-size:36px;">Reject Bank Payment</span>
                                                    </font>
                                                </h1>
                                                <div style="line-height:1.8;padding:20px 15px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                                        <h1>Dear [parent_name],</h1>
                                                        <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                            your child [student_name] fees rejected . Reject Note [note] [date].Thank You, [school_name]
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div style="color:#262b30;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#262b30;">
                                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;">
                                                            <span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">
                                                                [email_footer_content]
                                                            </span>
                                                            <br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>','module' => '','variable' => '[parent_name], [student_name], [note], [date], [school_name],[email_footer_content]','status' => '1','school_id' => '1','created_at' => '2023-08-10 10:06:12','updated_at' => '2023-08-10 10:06:12'],
  ['id' => '54','type' => 'email','purpose' => 'student_reject_bank_payment','subject' => 'Reject Bank Payment','body' => '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
                <tbody>
                    <tr style="vertical-align:top;" valign="top">
                        <td style="vertical-align:top;" valign="top">
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">
                                                    <a href="#">
                                                        <img border="0" class="center fixedwidth" src="" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                                    <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <h1 style="line-height:120%;text-align:center;margin-bottom:0px;">
                                                    <font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif">
                                                        <span style="font-size:36px;">Reject Bank Payment</span>
                                                    </font>
                                                </h1>
                                                <div style="line-height:1.8;padding:20px 15px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                                        <h1>Dear [student_name],</h1>
                                                        <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                            Fees rejected . Reject Note [note] at [date] .Thank You, [school_name]
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div style="color:#262b30;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#262b30;">
                                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;">
                                                            <span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">
                                                                [email_footer_content]
                                                            </span>
                                                            <br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>','module' => '','variable' => '[student_name], [note], [date], [school_name],[email_footer_content]','status' => '1','school_id' => '1','created_at' => '2023-08-10 10:06:12','updated_at' => '2023-08-10 10:06:12'],
  ['id' => '55','type' => 'email','purpose' => 'wallet_approve','subject' => 'Approve Wallet Payment','body' => '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
                <tbody>
                    <tr style="vertical-align:top;" valign="top">
                        <td style="vertical-align:top;" valign="top">
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">
                                                    <a href="#">
                                                        <img border="0" class="center fixedwidth" src="" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                                    <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <h1 style="line-height:120%;text-align:center;margin-bottom:0px;">
                                                    <font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif">
                                                        <span style="font-size:36px;">Approve Wallet Payment</span>
                                                    </font>
                                                </h1>
                                                <div style="line-height:1.8;padding:20px 15px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                                        <h1>Hi [name],</h1>
                                                        <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                            Your Wallet Diposit Request [add_balance] via [method] on [create_date] is approved by [school_name] .Your current balance is now [current_balance] <br> Thank You, [school_name]
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div style="color:#262b30;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#262b30;">
                                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;">
                                                            <span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">
                                                                [email_footer_content]
                                                            </span>
                                                            <br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>','module' => 'Wallet','variable' => '[name], [add_balance], [method], [create_date], [school_name], [current_balance],[email_footer_content]','status' => '1','school_id' => '1','created_at' => '2023-08-10 10:06:12','updated_at' => '2023-08-10 10:06:12'],
  ['id' => '56','type' => 'email','purpose' => 'wallet_reject','subject' => 'Reject Wallet Payment','body' => '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
                <tbody>
                    <tr style="vertical-align:top;" valign="top">
                        <td style="vertical-align:top;" valign="top">
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">
                                                    <a href="#">
                                                        <img border="0" class="center fixedwidth" src="" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                                    <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <h1 style="line-height:120%;text-align:center;margin-bottom:0px;">
                                                    <font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif">
                                                        <span style="font-size:36px;">Reject Wallet Payment</span>
                                                    </font>
                                                </h1>
                                                <div style="line-height:1.8;padding:20px 15px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                                        <h1>Hi [name],</h1>
                                                        <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                            Your Wallet Diposit Request [add_balance] via [method] on [create_date] is <strong>Reject</strong> by [school_name] <strong>Reason: [reject_reason] </strong> .Your current balance is now [current_balance] <br> Thank You, [school_name]
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div style="color:#262b30;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#262b30;">
                                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;">
                                                            <span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">
                                                                [email_footer_content]
                                                            </span>
                                                            <br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>','module' => 'Wallet','variable' => '[name], [add_balance], [method], [create_date], [school_name], [reject_reason], [current_balance],[email_footer_content]','status' => '1','school_id' => '1','created_at' => '2023-08-10 10:06:12','updated_at' => '2023-08-10 10:06:12'],
  ['id' => '57','type' => 'email','purpose' => 'fees_extra_amount_add','subject' => 'Fee Extra Amoun Add','body' => '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
                <tbody>
                    <tr style="vertical-align:top;" valign="top">
                        <td style="vertical-align:top;" valign="top">
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">
                                                    <a href="#">
                                                        <img border="0" class="center fixedwidth" src="" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                                    <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <h1 style="line-height:120%;text-align:center;margin-bottom:0px;">
                                                    <font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif">
                                                        <span style="font-size:36px;">Fee Extra Amoun Add</span>
                                                    </font>
                                                </h1>
                                                <div style="line-height:1.8;padding:20px 15px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                                        <h1>Hi [name],</h1>
                                                        <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                            Your Xtra Fees Amount Add [school_name] , In Your Wallet Amount:  [add_balance] . Which Is Fees Add Payment Via [method] on [create_date] Your previous Balance Was [previous_balance] <br> .Your Current Balance Is Now [current_balance] <br> Thank You, [school_name]
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div style="color:#262b30;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#262b30;">
                                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;">
                                                            <span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">
                                                                [email_footer_content]
                                                            </span>
                                                            <br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>','module' => 'Wallet','variable' => '[name], [school_name], [add_balance], [method], [create_date], [previous_balance], [current_balance],[email_footer_content]','status' => '1','school_id' => '1','created_at' => '2023-08-10 10:06:12','updated_at' => '2023-08-10 10:06:12'],
  ['id' => '58','type' => 'email','purpose' => 'wallet_refund','subject' => 'Wallet Refund','body' => '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
                <tbody>
                    <tr style="vertical-align:top;" valign="top">
                        <td style="vertical-align:top;" valign="top">
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">
                                                    <a href="#">
                                                        <img border="0" class="center fixedwidth" src="" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                                    <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <h1 style="line-height:120%;text-align:center;margin-bottom:0px;">
                                                    <font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif">
                                                        <span style="font-size:36px;">Wallet Refund</span>
                                                    </font>
                                                </h1>
                                                <div style="line-height:1.8;padding:20px 15px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                                        <h1>Hi [name],</h1>
                                                        <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                            Your Amount [refund_amount] Is Successfully Refunded by [school_name] on [create_date] <br>.Your Current Balance Is Now [current_balance].Thank You, [school_name]
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div style="color:#262b30;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#262b30;">
                                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;">
                                                            <span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">
                                                                [email_footer_content]
                                                            </span>
                                                            <br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>','module' => 'Wallet','variable' => '[name], [refund_amount], [school_name], [create_date], [current_balance],[email_footer_content]','status' => '1','school_id' => '1','created_at' => '2023-08-10 10:06:12','updated_at' => '2023-08-10 10:06:12'],
  ['id' => '59','type' => 'email','purpose' => 'student_registration','subject' => 'Student Registration','body' => '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
                <tbody>
                    <tr style="vertical-align:top;" valign="top">
                        <td style="vertical-align:top;" valign="top">
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">
                                                    <a href="#">
                                                        <img border="0" class="center fixedwidth" src="" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                                    <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <h1 style="line-height:120%;text-align:center;margin-bottom:0px;">
                                                    <font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif">
                                                        <span style="font-size:36px;">Student Registration</span>
                                                    </font>
                                                </h1>
                                                <div style="line-height:1.8;padding:20px 15px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                                        <h1>Hi [name] ,</h1>
                                                        <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                            Welcome to [school_name]. Congratulations ! You have registered successfully.Thank You, [school_name]
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div style="color:#262b30;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#262b30;">
                                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;">
                                                            <span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">
                                                                [email_footer_content]
                                                            </span>
                                                            <br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>','module' => 'ParentRegistration','variable' => '[name], [school_name],[email_footer_content]','status' => '1','school_id' => '1','created_at' => '2023-08-10 10:06:12','updated_at' => '2023-08-10 10:06:12'],
  ['id' => '60','type' => 'email','purpose' => 'student_registration_for_parents','subject' => 'Student Registration','body' => '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
                <tbody>
                    <tr style="vertical-align:top;" valign="top">
                        <td style="vertical-align:top;" valign="top">
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">
                                                    <a href="#">
                                                        <img border="0" class="center fixedwidth" src="" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                                    <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <h1 style="line-height:120%;text-align:center;margin-bottom:0px;">
                                                    <font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif">
                                                        <span style="font-size:36px;">Student Registration</span>
                                                    </font>
                                                </h1>
                                                <div style="line-height:1.8;padding:20px 15px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                                        <h1>Hi [father_name] ,</h1>
                                                        <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                            Welcome to [school_name]. Congratulations ! You have registered successfully. Please login using this username [username] and password [password]. Thank You, [school_name]
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div style="color:#262b30;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#262b30;">
                                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;">
                                                            <span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">
                                                                [email_footer_content]
                                                            </span>
                                                            <br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>','module' => 'ParentRegistration','variable' => '[father_name], [school_name], [username], [password],[email_footer_content]','status' => '1','school_id' => '1','created_at' => '2023-08-10 10:06:12','updated_at' => '2023-08-10 10:06:12'],
  ['id' => '61','type' => 'email','purpose' => 'lead_reminder','subject' => 'Lead Reminder ','body' => '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
                <tbody>
                    <tr style="vertical-align:top;" valign="top">
                        <td style="vertical-align:top;" valign="top">
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">
                                                    <a href="#">
                                                        <img border="0" class="center fixedwidth" src="" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                                    <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <h1 style="line-height:120%;text-align:center;margin-bottom:0px;">
                                                    <font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif">
                                                        <span style="font-size:36px;">Test Mail</span>
                                                    </font>
                                                </h1>
                                                <div style="line-height:1.8;padding:20px 15px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                                        <h1>Hi [assign_user] ,</h1>
                                                        <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">

                                                           title : [lead_name], <br>
                                                           Phone : [lead_phone],<br>
                                                           Email : [lead_email],<br>
                                                           Date Time : [lead_date] [lead_time],<br>
                                                           Details : [lead_description],</br>
                                                           Thank You, [school_name]
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div style="color:#262b30;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#262b30;">
                                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;">
                                                            <span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">
                                                                [email_footer_content]
                                                            </span>
                                                            <br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>','module' => 'Lead','variable' => '[assign_user], [lead_name], [lead_phone], [lead_email], [lead_date], [lead_time], [lead_description], [school_name],[email_footer_content]','status' => '1','school_id' => '1','created_at' => '2023-08-10 10:06:12','updated_at' => '2023-08-10 10:06:12'],
  ['id' => '62','type' => 'email','purpose' => 'student_course_purchase','subject' => 'Lms Course Purchase','body' => '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
                <tbody>
                    <tr style="vertical-align:top;" valign="top">
                        <td style="vertical-align:top;" valign="top">
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">
                                                    <a href="#">
                                                        <img border="0" class="center fixedwidth" src="" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">
                                                    <img border="0" class="center autowidth" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRGF00Oi-zJNU_EvYGueBVz_sqXmFjk8pxNtg&amp;usqp=CAU" style="text-decoration:none;height:auto;border:0;max-width:541px;" width="541" alt="images?q=tbn:ANd9GcRGF00Oi-zJNU_EvYGueBVz_sqXmFjk8pxNtg&amp;usqp=CAU">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                                    <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <h1 style="line-height:120%;text-align:center;margin-bottom:0px;">
                                                    <font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif">
                                                        <span style="font-size:36px;">Lms Course Purchase</span>
                                                    </font>
                                                </h1>
                                                <div style="line-height:1.8;padding:20px 15px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                                        <h1>Hi [name],</h1>
                                                        <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                            Your Course Purchase Sucessfully <br> Thanks You, [school_name]
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div style="color:#262b30;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#262b30;">
                                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;">
                                                            <span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">
                                                                [email_footer_content]
                                                            </span>
                                                            <br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>','module' => 'Lms','variable' => '[name],[school_name],[email_footer_content]','status' => '1','school_id' => '1','created_at' => '2023-08-10 10:06:12','updated_at' => '2023-08-10 10:06:12'],
  ['id' => '63','type' => 'email','purpose' => 'parent_course_purchase','subject' => 'Lms Course Purchase','body' => '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
                <tbody>
                    <tr style="vertical-align:top;" valign="top">
                        <td style="vertical-align:top;" valign="top">
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">
                                                    <a href="#">
                                                        <img border="0" class="center fixedwidth" src="" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                                    <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <h1 style="line-height:120%;text-align:center;margin-bottom:0px;">
                                                    <font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif">
                                                        <span style="font-size:36px;">Lms Course Purchase</span>
                                                    </font>
                                                </h1>
                                                <div style="line-height:1.8;padding:20px 15px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                                        <h1>Hi [name],</h1>
                                                        <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                            Your Course Purchase Sucessfully <br> Thanks You, [school_name]
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div style="color:#262b30;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#262b30;">
                                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;">
                                                            <span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">
                                                                [email_footer_content]
                                                            </span>
                                                            <br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>','module' => 'Lms','variable' => '[name], [school_name],[email_footer_content]','status' => '1','school_id' => '1','created_at' => '2023-08-10 10:06:12','updated_at' => '2023-08-10 10:06:12'],
  ['id' => '64','type' => 'email','purpose' => 'student_approve_payment','subject' => 'Approve Lms Course Payment','body' => '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
                <tbody>
                    <tr style="vertical-align:top;" valign="top">
                        <td style="vertical-align:top;" valign="top">
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">
                                                    <a href="#">
                                                        <img border="0" class="center fixedwidth" src="" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                                    <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <h1 style="line-height:120%;text-align:center;margin-bottom:0px;">
                                                    <font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif">
                                                        <span style="font-size:36px;">Approve Payment</span>
                                                    </font>
                                                </h1>
                                                <div style="line-height:1.8;padding:20px 15px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                                        <h1>Hi [name],</h1>
                                                        <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                            Approve Payment.Thanks You, [school_name]
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div style="color:#262b30;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#262b30;">
                                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;">
                                                            <span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">
                                                                [email_footer_content]
                                                            </span>
                                                            <br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>','module' => 'Lms','variable' => '[name],[school_name],[email_footer_content]','status' => '1','school_id' => '1','created_at' => '2023-08-10 10:06:12','updated_at' => '2023-08-10 10:06:12'],
  ['id' => '65','type' => 'email','purpose' => 'parent_approve_payment','subject' => 'Approve Lms Course Payment','body' => '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
                <tbody>
                    <tr style="vertical-align:top;" valign="top">
                        <td style="vertical-align:top;" valign="top">
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">
                                                    <a href="#">
                                                        <img border="0" class="center fixedwidth" src="" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                                    <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <h1 style="line-height:120%;text-align:center;margin-bottom:0px;">
                                                    <font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif">
                                                        <span style="font-size:36px;">Approve Payment</span>
                                                    </font>
                                                </h1>
                                                <div style="line-height:1.8;padding:20px 15px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                                        <h1>Hi [name],</h1>
                                                        <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                            Approve Payment.Thanks You, [school_name]
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div style="color:#262b30;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#262b30;">
                                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;">
                                                            <span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">
                                                                [email_footer_content]
                                                            </span>
                                                            <br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>','module' => 'Lms','variable' => '[name],[school_name],[email_footer_content]','status' => '1','school_id' => '1','created_at' => '2023-08-10 10:06:12','updated_at' => '2023-08-10 10:06:12'],
  ['id' => '66','type' => 'email','purpose' => 'student_reject_payment','subject' => 'Reject Lms Course Payment','body' => '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
                <tbody>
                    <tr style="vertical-align:top;" valign="top">
                        <td style="vertical-align:top;" valign="top">
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">
                                                    <a href="#">
                                                        <img border="0" class="center fixedwidth" src="" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                                    <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <h1 style="line-height:120%;text-align:center;margin-bottom:0px;">
                                                    <font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif">
                                                        <span style="font-size:36px;">Reject Payment</span>
                                                    </font>
                                                </h1>
                                                <div style="line-height:1.8;padding:20px 15px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                                        <h1>Hi [name],</h1>
                                                        <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                            Reject Payment.Thanks You, [school_name]
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div style="color:#262b30;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#262b30;">
                                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;">
                                                            <span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">
                                                                [email_footer_content]
                                                            </span>
                                                            <br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>','module' => 'Lms','variable' => '[name],[school_name],[email_footer_content]','status' => '1','school_id' => '1','created_at' => '2023-08-10 10:06:12','updated_at' => '2023-08-10 10:06:12'],
  ['id' => '67','type' => 'email','purpose' => 'parent_reject_payment','subject' => 'Reject Lms Course Payment','body' => '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
                <tbody>
                    <tr style="vertical-align:top;" valign="top">
                        <td style="vertical-align:top;" valign="top">
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">
                                                    <a href="#">
                                                        <img border="0" class="center fixedwidth" src="" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                                    <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <h1 style="line-height:120%;text-align:center;margin-bottom:0px;">
                                                    <font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif">
                                                        <span style="font-size:36px;">Reject Payment</span>
                                                    </font>
                                                </h1>
                                                <div style="line-height:1.8;padding:20px 15px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                                        <h1>Hi [name],</h1>
                                                        <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                            Reject Payment. Thanks You, [school_name]
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div style="color:#262b30;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#262b30;">
                                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;">
                                                            <span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">
                                                                [email_footer_content]
                                                            </span>
                                                            <br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>','module' => 'Lms','variable' => '[name],[school_name],[email_footer_content]','status' => '1','school_id' => '1','created_at' => '2023-08-10 10:06:12','updated_at' => '2023-08-10 10:06:12'],
  ['id' => '68','type' => 'email','purpose' => 'student_course_purchase','subject' => 'Lms Course Purchase','body' => '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
                <tbody>
                    <tr style="vertical-align:top;" valign="top">
                        <td style="vertical-align:top;" valign="top">
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">
                                                    <a href="#">
                                                        <img border="0" class="center fixedwidth" src="" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                                    <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <h1 style="line-height:120%;text-align:center;margin-bottom:0px;">
                                                    <font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif">
                                                        <span style="font-size:36px;">Lms Course Purchase</span>
                                                    </font>
                                                </h1>
                                                <div style="line-height:1.8;padding:20px 15px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                                        <h1>Hi [name],</h1>
                                                        <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                            Your Course Purchase Sucessfully <br> Thank You.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div style="color:#262b30;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#262b30;">
                                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;">
                                                            <span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">
                                                                [email_footer_content]
                                                            </span>
                                                            <br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>','module' => 'Lms','variable' => '[name],[school_name],[email_footer_content]','status' => '1','school_id' => '1','created_at' => '2023-08-10 10:06:12','updated_at' => '2023-08-10 10:06:12'],
  ['id' => '69','type' => 'email','purpose' => 'parent_course_purchase','subject' => 'Lms Course Purchase','body' => '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
                <tbody>
                    <tr style="vertical-align:top;" valign="top">
                        <td style="vertical-align:top;" valign="top">
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">
                                                    <a href="#">
                                                        <img border="0" class="center fixedwidth" src="" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                                    <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <h1 style="line-height:120%;text-align:center;margin-bottom:0px;">
                                                    <font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif">
                                                        <span style="font-size:36px;">Lms Course Purchase</span>
                                                    </font>
                                                </h1>
                                                <div style="line-height:1.8;padding:20px 15px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                                        <h1>Hi [name],</h1>
                                                        <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                            Your Course Purchase Sucessfully <br> Thank You.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div style="color:#262b30;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#262b30;">
                                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;">
                                                            <span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">
                                                                [email_footer_content]
                                                            </span>
                                                            <br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>','module' => 'Lms','variable' => '[name],[school_name],[email_footer_content]','status' => '1','school_id' => '1','created_at' => '2023-08-10 10:06:12','updated_at' => '2023-08-10 10:06:12'],
  ['id' => '70','type' => 'email','purpose' => 'student_approve_payment','subject' => 'Approve Lms Course Payment','body' => '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
                <tbody>
                    <tr style="vertical-align:top;" valign="top">
                        <td style="vertical-align:top;" valign="top">
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">
                                                    <a href="#">
                                                        <img border="0" class="center fixedwidth" src="" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                                    <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <h1 style="line-height:120%;text-align:center;margin-bottom:0px;">
                                                    <font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif">
                                                        <span style="font-size:36px;">Approve Payment</span>
                                                    </font>
                                                </h1>
                                                <div style="line-height:1.8;padding:20px 15px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                                        <h1>Hi [name],</h1>
                                                        <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                            Approve Payment.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div style="color:#262b30;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#262b30;">
                                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;">
                                                            <span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">
                                                                [email_footer_content]
                                                            </span>
                                                            <br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>','module' => 'Lms','variable' => '[name],[school_name],[email_footer_content]','status' => '1','school_id' => '1','created_at' => '2023-08-10 10:06:12','updated_at' => '2023-08-10 10:06:12'],
  ['id' => '71','type' => 'email','purpose' => 'parent_approve_payment','subject' => 'Approve Lms Course Payment','body' => '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
                <tbody>
                    <tr style="vertical-align:top;" valign="top">
                        <td style="vertical-align:top;" valign="top">
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">
                                                    <a href="#">
                                                        <img border="0" class="center fixedwidth" src="" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                                    <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <h1 style="line-height:120%;text-align:center;margin-bottom:0px;">
                                                    <font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif">
                                                        <span style="font-size:36px;">Approve Payment</span>
                                                    </font>
                                                </h1>
                                                <div style="line-height:1.8;padding:20px 15px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                                        <h1>Hi [name],</h1>
                                                        <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                            Approve Payment.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div style="color:#262b30;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#262b30;">
                                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;">
                                                            <span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">
                                                                [email_footer_content]
                                                            </span>
                                                            <br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>','module' => 'Lms','variable' => '[name],[school_name],[email_footer_content]','status' => '1','school_id' => '1','created_at' => '2023-08-10 10:06:12','updated_at' => '2023-08-10 10:06:12'],
  ['id' => '72','type' => 'email','purpose' => 'student_reject_payment','subject' => 'Reject Lms Course Payment','body' => '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
                <tbody>
                    <tr style="vertical-align:top;" valign="top">
                        <td style="vertical-align:top;" valign="top">
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">
                                                    <a href="#">
                                                        <img border="0" class="center fixedwidth" src="" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                                    <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <h1 style="line-height:120%;text-align:center;margin-bottom:0px;">
                                                    <font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif">
                                                        <span style="font-size:36px;">Reject Payment</span>
                                                    </font>
                                                </h1>
                                                <div style="line-height:1.8;padding:20px 15px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                                        <h1>Hi [name],</h1>
                                                        <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                            Reject Payment.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div style="color:#262b30;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#262b30;">
                                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;">
                                                            <span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">
                                                                [email_footer_content]
                                                            </span>
                                                            <br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>','module' => 'Lms','variable' => '[name],[school_name],[email_footer_content]','status' => '1','school_id' => '1','created_at' => '2023-08-10 10:06:12','updated_at' => '2023-08-10 10:06:12'],
  ['id' => '73','type' => 'email','purpose' => 'parent_reject_payment','subject' => 'Reject Lms Course Payment','body' => '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
                <tbody>
                    <tr style="vertical-align:top;" valign="top">
                        <td style="vertical-align:top;" valign="top">
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">
                                                    <a href="#">
                                                        <img border="0" class="center fixedwidth" src="" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                                    <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <h1 style="line-height:120%;text-align:center;margin-bottom:0px;">
                                                    <font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif">
                                                        <span style="font-size:36px;">Reject Payment</span>
                                                    </font>
                                                </h1>
                                                <div style="line-height:1.8;padding:20px 15px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                                        <h1>Hi [name],</h1>
                                                        <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                            Reject Payment.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div style="color:#262b30;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#262b30;">
                                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;">
                                                            <span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">
                                                                [email_footer_content]
                                                            </span>
                                                            <br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>','module' => 'Lms','variable' => '[name],[school_name],[email_footer_content]','status' => '1','school_id' => '1','created_at' => '2023-08-10 10:06:12','updated_at' => '2023-08-10 10:06:12'],
  ['id' => '74','type' => 'email','purpose' => 'university_fees_remainder','subject' => 'University Fees Due Remainder','body' => '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
                <tbody>
                    <tr style="vertical-align:top;" valign="top">
                        <td style="vertical-align:top;" valign="top">
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">
                                                    <a href="#">
                                                        <img border="0" class="center fixedwidth" src="" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                                    <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <h1 style="line-height:120%;text-align:center;margin-bottom:0px;">
                                                    <font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif">
                                                        <span style="font-size:36px;">Fees Payment Remainder</span>
                                                    </font>
                                                </h1>
                                                <div style="line-height:1.8;padding:20px 15px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                                        <h1>Hi [student_name],</h1>
                                                        <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                            Your Semester label: [semester_label], Academic Year: [academic]
                                                             Fees Type: [fees_type], Amount: [amount], Due Date: [due_date].Please Pay This Amount Before [due_date].
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div style="color:#262b30;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#262b30;">
                                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;">
                                                            <span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">
                                                                [email_footer_content]
                                                            </span>
                                                            <br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>','module' => 'University','variable' => '[fees_type], [fees_type], [amount], [semester_label], [academic], [due_date], [class],[section], [school_name],[email_footer_content]','status' => '1','school_id' => '1','created_at' => '2023-08-10 10:06:12','updated_at' => '2023-08-10 10:06:12'],
  ['id' => '75','type' => 'sms','purpose' => 'two_factor_code','subject' => 'Two Factor Authentication','body' => 'Dear [full_name], You are trying for login into [school_name] . Your login verification code is [code], expired_at [expired_time] . Do not share with anyone. Thank you .','module' => '','variable' => '[first_name], [last_name], [full_name], [school_name], [code], [expired_time]','status' => '1','school_id' => '1','created_at' => '2023-08-10 10:06:44','updated_at' => '2023-08-10 10:06:44'],
  ['id' => '76','type' => 'email','purpose' => 'two_factor_code','subject' => 'Two Factor Authentication','body' => '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
            <tbody>
                <tr style="vertical-align:top;" valign="top">
                    <td style="vertical-align:top;" valign="top">
                        <div style="background-color:#415094;">
                            <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">
                                    <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                        <div class="col_cont" style="width:100%;">
                                            <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">
                                                <a href="#">
                                                    <img border="0" class="center fixedwidth" src="" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="background-color:#415094;">
                            <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                                <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                    <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                        <div class="col_cont" style="width:100%;">
                                            <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="background-color:#7c32ff;">
                            <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                                <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">
                                    <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                        <div class="col_cont" style="width:100%;">
                                            <h1 style="line-height:120%;text-align:center;margin-bottom:0px;"><font face="Arial, Helvetica Neue, Helvetica, sans-serif"><span style="font-size: 36px;"><br></span></font></h1><h1 style="line-height:120%;text-align:center;margin-bottom:0px;"><font face="Arial, Helvetica Neue, Helvetica, sans-serif"><span style="font-size: 36px;"><u>Two Factor Authentication</u></span></font><br></h1>
                                            <div style="line-height:1.8;padding:20px 15px;">
                                                <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                                    <h1>Hi [full_name],</h1>
                                                    <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">You are trying for login in [school_name] . For successfully login please verify your authentication use below code .&nbsp;</p><p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">Your login verification code is <b>[code] </b>.</p>
                                                    <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                        This code&nbsp; will expire at <b>[expired_time]</b> .
                                                    </p>
                                                    <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                        If you did not request for these&nbsp; . Please ignore and dont share these code with anyone.</p>
                                                    <br>
                                                    Thank You, [school_name]
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="background-color:#7c32ff;">
                            <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                    <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                        <div class="col_cont" style="width:100%;">
                                            <div style="color:#262b30;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                                <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#262b30;">
                                                    <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;">
                                                        <span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">
                                                                [email_footer_content]
                                                            </span>
                                                        <br>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
    </table>','module' => '','variable' => '[full_name], [first_name], [last_name], [code], [expired_time], [school_name],[email_footer_content]','status' => '1','school_id' => '1','created_at' => '2023-08-10 10:06:44','updated_at' => '2023-08-10 10:06:44'],
  ['id' => '77','type' => 'email','purpose' => 'reject_bank_payment_student','subject' => 'Reject Bank Payment','body' => '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
                <tbody>
                    <tr style="vertical-align:top;" valign="top">
                        <td style="vertical-align:top;" valign="top">
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">
                                                    <a href="#">
                                                        <img border="0" class="center fixedwidth" src="logo.png" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                                    <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <h1 style="line-height:120%;text-align:center;margin-bottom:0px;">
                                                    <font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif">
                                                        <span style="font-size:36px;">Rejected Payment</span>
                                                    </font>
                                                </h1>
                                                <div style="line-height:1.8;padding:20px 15px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                                        <h1>Hi [student_name],</h1>
                                                        <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                            Your Bank Payment has been rejected on [date]. Reason is [note]
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div style="color:#262b30;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#262b30;">
                                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;">
                                                            <span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">
                                                                [email_footer_content]
                                                            </span>
                                                            <br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>','module' => '','variable' => '[student_name],[note], [date],[email_footer_content]','status' => '1','school_id' => '1','created_at' => NULL,'updated_at' => NULL],
  ['id' => '79','type' => 'email','purpose' => 'student_reject_bank_payment','subject' => 'Reject Bank Payment','body' => '<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout:fixed;vertical-align:top;min-width:320px;border-spacing:0;border-collapse:collapse;background-color:#FFFFFF;width:100%;" width="100%">
                <tbody>
                    <tr style="vertical-align:top;" valign="top">
                        <td style="vertical-align:top;" valign="top">
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;background-position:center top;background-repeat:no-repeat;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center fixedwidth" style="padding-right:30px;padding-left:30px;">
                                                    <a href="#">
                                                        <img border="0" class="center fixedwidth" src="" style="padding-top:30px;padding-bottom:30px;text-decoration:none;height:auto;border:0;max-width:150px;" width="150" alt="logo.png">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#415094;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;padding-top:25px;border-top-right-radius:30px;border-top-left-radius:30px;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div align="center" class="img-container center autowidth" style="padding-right:20px;padding-left:20px;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:#ffffff;border-bottom-right-radius:30px;border-bottom-left-radius:30px;overflow:hidden;">
                                    <div style="border-collapse:collapse;width:100%;background-color:#ffffff;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <h1 style="line-height:120%;text-align:center;margin-bottom:0px;">
                                                    <font color="#555555" face="Arial, Helvetica Neue, Helvetica, sans-serif">
                                                        <span style="font-size:36px;">Reject Bank Payment</span>
                                                    </font>
                                                </h1>
                                                <div style="line-height:1.8;padding:20px 15px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.8;">
                                                        <h1>Dear [student_name],</h1>
                                                        <p style="margin:10px 0px 30px;line-height:1.929;font-size:16px;color:rgb(113,128,150);">
                                                            Fees rejected . Reject Note [note] at [date] .Thank You, [school_name]
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#7c32ff;">
                                <div class="block-grid" style="min-width:320px;max-width:600px;margin:0 auto;background-color:transparent;">
                                    <div style="border-collapse:collapse;width:100%;background-color:transparent;">
                                        <div class="col num12" style="min-width:320px;max-width:600px;vertical-align:top;width:600px;">
                                            <div class="col_cont" style="width:100%;">
                                                <div style="color:#262b30;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:30px;padding-right:5px;padding-bottom:5px;padding-left:5px;">
                                                    <div class="txtTinyMce-wrapper" style="line-height:1.2;font-size:12px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;color:#262b30;">
                                                        <p style="margin:0;font-size:12px;line-height:1.2;text-align:center;margin-top:0;margin-bottom:0;">
                                                            <span style="font-size:14px;color:rgb(255,255,255);font-family:Arial;">
                                                                [email_footer_content]
                                                            </span>
                                                            <br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>','module' => '','variable' => '[student_name], [note], [date], [school_name],[email_footer_content]','status' => '1','school_id' => '1','created_at' => '2023-08-10 10:06:12','updated_at' => '2023-08-10 10:06:12']
];

DB::table('sms_templates')->insert($sms_templates);


    }
}
