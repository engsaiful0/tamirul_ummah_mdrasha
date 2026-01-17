<?php

use App\SmSchool;
use App\SmsTemplate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_templates', function (Blueprint $table) {
            $table->id();
            $table->string('type')->comment('email, sms');
            $table->text('purpose');
            $table->text('subject');
            $table->longText('body');
            $table->string('module');
            $table->text('variable');
            $table->integer('status')->default(1)->comment('Enable & Disable');
            $table->integer('school_id')->nullable()->default(1)->unsigned();
            $table->foreign('school_id')->references('id')->on('sm_schools')->onDelete('cascade');
            $table->timestamps();
        });

        $allTempletes = [
            // SMS Start

            ['sms', 'student_admission', '', 'Dear [student_name], Your Admission Is Completed You Can Login To Your Account Using username:[user_name] Password:[password], Thank You [school_name]', '', '[student_name], [user_name], [password], [school_name]'],
            ['sms', 'student_admission_for_parent', '', 'Dear Parent [parent_name], Your Child [student_name] Admission Is Completed You Can Login To Your Account Using username:[user_name] Password:[password], Thank You [school_name]', '', '[parent_name], [student_name], [user_name], [password], [school_name]'],
            ['sms', 'exam_schedule_for_student', '', 'Dear [student_name], your next exam: [exam_type] on [exam_date], [exam_time],Please Attend In Exam, Thank You [school_name]', '', '[student_name], [exam_type], [exam_date], [exam_time], [school_name]'],
            ['sms', 'exam_schedule_for_parent', '', 'Dear [parent_name], your children [student_name] next exam: [exam_type] on [exam_date], [exam_time], Thank You [school_name]', '', '[parent_name], [student_name], [exam_type], [exam_date], [exam_time], [school_name]'],
            ['sms', 'user_login_permission', '', 'Dear [name], your login permission is disabled username:[user_name], Thank You [school_name]', '', '[name], [user_name], [school_name]'],
            ['sms', 'student_promote', '', 'Hi [student_name] , Welcome to [school_name]. Congratulations ! You have promoted in the next class. Thank You [school_name]', '', '[student_name], [school_name]'],
            ['sms', 'communicate_sms', '', 'In Communicate SMS description is: [description]. Thank You. Thank You [school_name]', '', '[description], [school_name]'],

            ['sms', 'student_attendance', '', 'Dear [student_name], your are came to the school at [attendance_date], Thank You [school_name]', '', '[student_name], [attendance_date], [school_name]'],
            ['sms', 'student_attendance_for_parent', '', 'Dear Parent [parent_name], your child [student_name] came to the school at [attendance_date], Thank You [school_name]', '', '[parent_name], [student_name], [attendance_date], [school_name]'],
            ['sms', 'student_absent', '', 'Dear [student_name], your are absent to the school on [attendance_date], Thank You [school_name]', '', '[student_name], [attendance_date], [school_name]'],
            ['sms', 'student_absent_for_parent', '', 'Dear parent [parent_name], your child [student_name] is absent to the school on [attendance_date], Thank You [school_name]', '', '[parent_name], [student_name], [attendance_date], [school_name]'],
            ['sms', 'student_late', '', 'Dear [student_name], your are late to the school on [attendance_date], Thank You [school_name]', '', '[student_late], [attendance_date], [school_name]'],
            ['sms', 'student_late_for_parent', '', 'Dear parent [parent_name], your child [student_name] is late to the school on [attendance_date], Thank You [school_name]', '', '[parent_name], [student_name], [attendance_date], [school_name]'],
            ['sms', 'student_leave_appllication', '', 'Dear [student_name], Thank you for your leave application. Please wait for approval, Thank You [school_name]', '', '[student_name], [school_name]'],
            ['sms', 'student_leave_approve', '', 'Dear [student_name], Thank you for your leave application. Your Leave approve. Thank You [school_name]', '', '[student_name], [school_name]'],
            ['sms', 'parent_leave_appllication_for_student', '', 'Dear [parent_name], Thank you for your leave [student_name] application. Please wait for approval, Thank You [school_name]. Thanks', '', '[parent_name], [student_name], [school_name]'],
            ['sms', 'parent_leave_approve_for_student', '', 'Dear [parent_name], Thank you for your leave [student_name] application. Your Leave approve. Thank You [school_name]', '', '[parent_name], [student_name], [school_name]'],
            ['sms', 'student_library_book_issue', '', 'Dear [student_name], Library book  is issued to you studying in class: [class_name] , section: [section_name] with roll no:[roll_no] On [issue_date] .Please find the details , Book Title: [book_title], Book No: [book_no], Due Date: [due_date], Thank You [school_name]', '', '[student_name], [class_name], [section_name],[roll_no],[issue_date], [book_title], [book_no], [due_date], [school_name]'],
            ['sms', 'parent_library_book_issue', '', 'Dear parent [parent_name], Library book  is issued On [issue_date] .Please find the details , Book Title: [book_title], Book No: [book_no], Due Date: [due_date], Thank You [school_name]', '', '[parent_name], [issue_date], [book_title], [book_no], [due_date], [school_name]'],
            ['sms', 'student_return_issue_book', '', 'Dear [student_name], Library book  is returned by you studying in class: [class_name] , section: [section_name] with roll no:[roll_no] On [return_date] .Please find the details , Book Title: [book_title], Book No: [book_no], Issue Date: [issue_date], Due Date: [due_date], Thank You [school_name]', '', '[student_name], [class_name], [section_name], [roll_no], [return_date], [issue_date], [book_title], [book_no], [due_date], [school_name]'],
            ['sms', 'parent_return_issue_book', '', 'Dear parent [parent_name], Library book  is returned On [return_date] .Please find the details , Book Title: [book_title], Book No: [book_no], Issue Date: [issue_date], Due Date: [due_date], Thank You [school_name]', '', '[parent_name], [return_date], [issue_date], [book_title], [book_no], [due_date], [school_name]'],
            ['sms', 'exam_mark_student', '', 'Hi [student_name] , You are in class [class_name] ([section_name]), Your exam type [exam_type], [subject_marks]. School Name- [school_name], Thank You [school_name]', '', '[student_name], [class_name], [section_name], [exam_type], [subject_names], [total_mark], [school_name], [subject_marks]'],
            ['sms', 'exam_mark_parent', '', 'Hello, [parent_name], your child [student_name] of class [class_name] ([section_name]) exam type [exam_type], [subject_marks]. School Name- [school_name], Thank You [school_name]', '', '[parent_name], [student_name], [class_name], [section_name], [exam_type], [subject_names], [total_mark], [school_name], [subject_marks]'],
            ['sms', 'student_fees_due', '', 'Hi [student_name], You fees due amount [dues_amount] for [fees_name] on [date]. Thank You [school_name]', '', '[student_name], [dues_amount], [fees_name], [date], [school_name]'],
            ['sms', 'student_fees_due_for_parent', '', 'Hi [parent_name], You fees due amount [dues_amount] for [fees_name] on [date]. Thank You [school_name]', '', '[parent_name], [dues_amount], [fees_name], [date], [school_name]'],

            ['sms', 'staff_credentials', '', 'Dear staff [staff_name] your login details: username:[user_name] Password:[password], Thank You [school_name]', '', '[staff_name], [user_name], [password], [school_name]'],
            ['sms', 'staff_attendance', '', 'Dear [staff_name], your are came to the school at [attendance_date], Thank You [school_name]', '', '[staff_name],[attendance_date], [school_name]'],
            ['sms', 'staff_absent', '', 'Dear [staff_name], your are absent to the school on [attendance_date], Thank You [school_name]', '', '[staff_name], [attendance_date], [school_name]'],
            ['sms', 'staff_late', '', 'Dear [staff_name], your are late to the school on [attendance_date], Thank You [school_name]', '', '[staff_name], |StudentName|, [attendance_date], [school_name]'],
            ['sms', 'staff_leave_appllication', '', 'Dear staff [staff_name], Thank you for your leave application. Please wait for approval. Thank You [school_name]', '', '[staff_name], [school_name]'],
            ['sms', 'staff_leave_approve', '', 'Dear staff [staff_name], Thank you for your leave application. Your Leave approve. Thank You [school_name]', '', '[staff_name], [school_name]'],

            ['sms', 'holiday', '', 'This is to update you that [holiday_date] is holiday, Thank You [school_name]', '', '[holiday_date], [school_name]'],
            ['sms', 'student_birthday', '', 'Dear [student_name], Warm wishes to your birthday. Happy Birthday, Thank You [school_name]', '', '[student_name], [school_name]'],
            ['sms', 'staff_birthday', '', 'Dear staff [staff_name], Warm wishes to your birthday. Happy Birthday, Thank You [school_name]. Thanks', '', '[staff_name], [school_name]'],

            
            //Module Base SMS Sending Start
            // Module Name : InfixBiometrics
                ['sms', 'student_early_checkout', '', 'Dear parent [parent_name], your child [student_name] is checkout  at [attendance_date] to the school on [attendance_date], Thank You [school_name]','InfixBiometrics', '[parent_name], [student_name], [attendance_date], [attendance_date], [school_name]'],
                ['sms', 'student_checkout', '', 'Dear Parent [parent_name], your child [student_name] left the school at [left_time], Thank You [school_name]','InfixBiometrics', '[parent_name], [student_name], [school_name]'],
            
            ['next_implement', 'cheque_bounce', 'DEMO', 'Dear parent |ParentName|, the Cheque with no :|ChequeNo| for Rs.|FeePaid| received towards fee payment for your child :|StudentName| with receipt number:|ReceiptNo| has been Bounced', '', ''],
            ['sms', 'student_admission_in_progress', '', 'Dear parent [parent_name], your child [student_name] admission is in process.','ParentRegistration','[parent_name], [student_name]'],
            ['sms', 'university_fees_remainder', '', 'Hi [student_name], Your Semester label: [semester_label], Academic Year: [academic] Fees Type: [fees_type], Amount: [amount], Due Date: [due_date].Please Pay This Amount Before [due_date].','University','[student_name], [fees_type], [amount], [semester_label], [academic], [due_date], [class], [section]'],
            // Module Name : Fees 2.0
                ['sms', 'student_dues_fees', '', 'Hi [student_name], You fees due amount [dues_amount] for [fees_name] on [date]. Thank You [school_name]','Fees', '[student_name], [dues_amount], [fees_name], [date], [school_name]'],
                ['sms', 'student_dues_fees_for_parent', '', 'Hi [parent_name], You fees due amount [dues_amount] for [fees_name] on [date]. Thank You [school_name]','Fees', '[parent_name], [dues_amount], [fees_name], [date], [school_name]'],

            // Module Name : ParentRegistration
                ['sms', 'student_admission_in_progress', '', 'Dear parent [parent_name], your child [student_name] admission is in process, Thank You [school_name]','ParentRegistration','[parent_name], [student_name], [school_name]'],
            // Module Base SMS Sending End

            ['sms', 'student_absent_notification', '', 'Hi [parent_name], Your child [student_name] absent for [number_of_subject] subjects. Those are [subject_list] on [date], Thank You [school_name]', '', '[parent_name], [student_name], [number_of_subject], [subject_list], [date], [school_name]'],
            // SMS End

            // Email Start
            
            // end lead reminder

            //Email End
        ];
        // $schools=SmSchool::get(['id','school_name']);
        // foreach($schools as $school){
            foreach($allTempletes as $allTemplete){
                $storeTemplete = new SmsTemplate();
                $storeTemplete->type = $allTemplete[0];
                $storeTemplete->purpose = $allTemplete[1];
                $storeTemplete->subject = $allTemplete[2];
                $storeTemplete->body = $allTemplete[3];
                $storeTemplete->module = $allTemplete[4];
                $storeTemplete->variable = $allTemplete[5];               
                // $storeTemplete->school_id = $school->id;
                $storeTemplete->save();
            }


            $allTempletes = [
                ['sms', 'exam_mark_student', '', 'Hi [student_name] , You are in class [class_name] ([section_name]), Your exam type [exam_type], [subject_marks]. School Name- [school_name]', '', '[student_name], [class_name], [section_name], [exam_type], [subject_names], [total_mark], [school_name], [subject_marks]'],
                ['sms', 'exam_mark_parent', '', 'Hello, [parent_name], your child [student_name] of class [class_name] ([section_name]) exam type [exam_type], [subject_marks]. School Name- [school_name], Thank You.', '', '[parent_name], [student_name], [class_name], [section_name], [exam_type], [subject_names], [total_mark], [school_name], [subject_marks]'],
            ];
    
            $schools = SmSchool::get(['id', 'school_name']);
            foreach ($schools as $school) {
                foreach ($allTempletes as $allTemplete) {
                    if (!SmsTemplate::where('purpose', $allTemplete[1])->first()) {
                        $storeTemplete = new SmsTemplate();
                        $storeTemplete->type = $allTemplete[0];
                        $storeTemplete->purpose = $allTemplete[1];
                        $storeTemplete->subject = $allTemplete[2];
                        $storeTemplete->body = $allTemplete[3];
                        $storeTemplete->module = $allTemplete[4];
                        $storeTemplete->variable = $allTemplete[5];
                        $storeTemplete->school_id = $school->id;
                        $storeTemplete->save();
                    }
                }
            }

            $allDatas = SmsTemplate::all();
            foreach($allDatas as $allData){
                $existsData = str_contains($allData->variable, "[school_name]");
                $allData->variable = ($existsData) ? $allData->variable : $allData->variable.", [school_name]";
                $allData->save();
            }
            
            $templete = SmsTemplate::where('purpose', 'student_dues_fees')->first();
            $templete1 = SmsTemplate::where('purpose', 'student_dues_fees_for_parent')->first();
    
            $studentUpdate = SmsTemplate::find($templete->id);
            $studentUpdate->module = 'Fees';
            $studentUpdate->variable = '[student_name], [dues_amount], [fees_name], [date], [school_name]';
            $studentUpdate->save();
    
            $parentUpdate = SmsTemplate::find($templete1->id);
            $parentUpdate->module = 'Fees';
            $parentUpdate->variable = '[parent_name], [dues_amount], [fees_name], [date], [school_name]';
            $parentUpdate->save();

            $schools = SmSchool::get();
            
            foreach($schools as $school){
                $studenAttandance = SmsTemplate::where('purpose', 'parent_leave_approve_for_student')->where('school_id', $school->id)->first();
                $studenAttandance->body= str_replace('[staff_name]','[parent_name]',$studenAttandance->body);
                $studenAttandance->variable= str_replace('[staff_name]','[parent_name]',$studenAttandance->variable);
                $studenAttandance->save();

                $holiday = SmsTemplate::where('purpose', 'holiday')->where('school_id', $school->id)->first();
                $holiday->body= str_replace('[holiday_name]',' ',$holiday->body);
                $holiday->variable= str_replace('[holiday_name]',' ',$holiday->variable);
                $holiday->save();

                $BioMat1 = SmsTemplate::where('purpose', 'student_checkout')->where('school_id', $school->id)->first();
                $BioMat1->module= "InfixBiometrics";
                $BioMat1->save();

                $BioMat2 = SmsTemplate::where('purpose', 'student_early_checkout')->where('school_id', $school->id)->first();
                $BioMat2->module= "InfixBiometrics";
                $BioMat2->save();

                $check1 = SmsTemplate::where('purpose', 'student_fees_due')->where('school_id', $school->id)->first();
                if(!$check1){
                    $storeFeesDueStudent = new SmsTemplate();
                    $storeFeesDueStudent->type = "sms";
                    $storeFeesDueStudent->purpose = "student_fees_due";
                    $storeFeesDueStudent->subject = "";
                    $storeFeesDueStudent->body = "Hi [student_name], You fees due amount [dues_amount] for [fees_name] on [date]. Thank You [school_name]";
                    $storeFeesDueStudent->module = "";
                    $storeFeesDueStudent->variable = "[student_name], [dues_amount], [fees_name], [date], [school_name]";
                    $storeFeesDueStudent->status = 1;
                    $storeFeesDueStudent->school_id = $school->id;
                    $storeFeesDueStudent->save();
                }

                $check2 = SmsTemplate::where('purpose', 'student_fees_due_for_parent')->where('school_id', $school->id)->first();
                if(!$check2){
                    $storeFeesDueStudent = new SmsTemplate();
                    $storeFeesDueStudent->type = "sms";
                    $storeFeesDueStudent->purpose = "student_fees_due_for_parent";
                    $storeFeesDueStudent->subject = "";
                    $storeFeesDueStudent->body = "Hi [parent_name], You fees due amount [dues_amount] for [fees_name] on [date]. Thank You [school_name]";
                    $storeFeesDueStudent->module = "";
                    $storeFeesDueStudent->variable = "[parent_name], [dues_amount], [fees_name], [date], [school_name]";
                    $storeFeesDueStudent->status = 1;
                    $storeFeesDueStudent->school_id = $school->id;
                    $storeFeesDueStudent->save();
                }

                
        }


        //  }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_templates');
    }
}
