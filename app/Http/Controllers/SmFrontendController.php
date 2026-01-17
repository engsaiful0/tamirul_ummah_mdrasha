<?php

namespace App\Http\Controllers;

use App\User;
use App\SmExam;
use App\SmNews;
use App\SmPage;
use App\SmClass;
use App\SmEvent;
use App\SmStaff;
use App\SmCourse;
use App\SmSchool;
use App\SmSection;
use App\SmStudent;
use App\SmSubject;
use App\SmExamType;
use App\SmNewsPage;
use App\SmAboutPage;
use App\SmCoursePage;
use App\ApiBaseMethod;
use App\SmContactPage;
use App\SmNoticeBoard;
use App\SmTestimonial;
use App\SmNewsCategory;
use App\SmContactMessage;
use App\SmCourseCategory;
use App\SmGeneralSettings;
use App\SmHomePageSetting;
use App\SmSocialMediaIcon;
use App\SmBackgroundSetting;
use App\SmHeaderMenuManager;
use App\SmEmailSetting;
use Illuminate\Http\Request;
use App\SmFrontendPersmission;
use App\Models\subscription_menu_access;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Modules\Saas\Entities\SmPackagePlan;
use Modules\RolePermission\Entities\InfixPermissionAssign;
use Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use App\Mail\SendEmailContact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class SmFrontendController extends Controller
{

    public function __construct()
    {
        $this->middleware('PM');
        // User::checkAuth();
    }

    public function index()
    {
        $host = request()->getHost(); // e.g., sub.example.com or example.com


        $parts = explode('.', $host);

        // Logic: If there are more than 2 parts and it's not an IP, it's likely a subdomain.
        if (count($parts) > 2 && filter_var($host, FILTER_VALIDATE_IP) === false) {
            $result = "Subdomain: " . $host;
        } else {
            $result = "Main domain: " . $host;
        }

        // dd($result);

        try {
            
             if(auth()->check()){
                $user = Auth::user();
                $role_id = $user->role_id;
                if ($role_id == 2) {
                    return redirect('student-dashboard');
                } elseif ($role_id == 3) {
                    return redirect('parent-dashboard');
                } elseif ($role_id == "") {
                    return redirect('login');
                } elseif (Auth::user()->is_saas == 1) {
                    return redirect('saasStaffDashboard');
                } elseif($role_id == 1 && $user->email == 'admin@gmail.com') {
                    return redirect('school_list');
                }else {
                    return redirect('admin-dashboard');
                }
            }
            $setting = SmGeneralSettings::where('school_id', app('school')->id)->first();
            $permisions = SmFrontendPersmission::where('parent_id', 1)->where('is_published', 1)->get();
            $per = [];
            foreach ($permisions as $permision) {
                $per[$permision->name] = 1;
            }

            $data = [
                'setting' => $setting,
                'per' => $per,
            ];

            $home_data = [
                'exams' => SmExam::where('school_id', app('school')->id)->get(),
                'news' => SmNews::where('school_id', app('school')->id)->orderBy('order', 'asc')->limit(3)->get(),
                'testimonial' => SmTestimonial::where('school_id', app('school')->id)->get(),
                'academics' => SmCourse::where('school_id', app('school')->id)->orderBy('id', 'asc')->limit(3)->get(),
                'exam_types' => SmExamType::where('school_id', app('school')->id)->get(),
                'events' => SmEvent::where('school_id', app('school')->id)->get(),
                'notice_board' => SmNoticeBoard::where('school_id', app('school')->id)->where('is_published', 1)->orderBy('created_at', 'DESC')->take(3)->get(),
                'classes' => SmClass::where('school_id', app('school')->id)->where('active_status', 1)->get(),
                'subjects' => SmSubject::where('school_id', app('school')->id)->where('active_status', 1)->get(),
                'section' => SmSection::where('school_id', app('school')->id)->where('active_status', 1)->get(),
                'homePage' => SmHomePageSetting::where('school_id', app('school')->id)->first(),
                'about' => SmAboutPage::where('school_id', app('school')->id)->first()
            ];
  
           
            $url = explode('/', $setting->website_url);
           

           
         

            if ($setting->website_btn == 0) {
                if(auth()->check()){
               $user = Auth::user();
                $role_id = $user->role_id;
                if ($role_id == 2) {
                    return redirect('student-dashboard');
                } elseif ($role_id == 3) {
                    return redirect('parent-dashboard');
                } elseif ($role_id == "") {
                    return redirect('login');
                } elseif (Auth::user()->is_saas == 1) {
                    return redirect('saasStaffDashboard');
                } elseif($role_id == 1 && $user->email == 'admin@gmail.com') {
                    return redirect('school_list');
                }else {
                    return redirect('admin-dashboard');
                }
            }
                return redirect('login');
            } else {

                if ($setting->website_url == '') {
                    return view('frontEnd.home.light_home')->with(array_merge($data, $home_data));
                 
                } elseif ($url[max(array_keys($url))] == 'home') {
                
                   
                    return view('frontEnd.home.light_home')->with(array_merge($data, $home_data));
                    
                } else if(rtrim($setting->website_url, '/') == url()->current()) {
                    return view('frontEnd.home.light_home')->with(array_merge($data, $home_data));
                 } else {
                    $url = $setting->website_url;
                    return Redirect::to($url);
                }
            }
            

        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function about()
    {
        try {

            if(auth()->check()){
                $user = Auth::user();
                $role_id = $user->role_id;
                if ($role_id == 2) {
                    return redirect('student-dashboard');
                } elseif ($role_id == 3) {
                    return redirect('parent-dashboard');
                } elseif ($role_id == "") {
                    return redirect('login');
                } elseif (Auth::user()->is_saas == 1) {
                    return redirect('saasStaffDashboard');
                } elseif($role_id == 1 && $user->email == 'admin@gmail.com') {
                    return redirect('school_list');
                }else {
                    return redirect('admin-dashboard');
                }
            }

            $exams = SmExam::where('school_id', app('school')->id)->get();
            $exams_types = SmExamType::where('school_id', app('school')->id)->get();
            $classes = SmClass::where('active_status', 1)->where('school_id', app('school')->id)->get();
            $subjects = SmSubject::where('active_status', 1)->where('school_id', app('school')->id)->get();
            $sections = SmSection::where('active_status', 1)->where('school_id', app('school')->id)->get();
            $about = SmAboutPage::where('school_id', app('school')->id)->first();
            $testimonial = SmTestimonial::where('school_id', app('school')->id)->get();
            $totalStudents = SmStudent::where('active_status', 1)->where('school_id', app('school')->id)->get();
            $totalTeachers = SmStaff::where('active_status', 1)
                ->where(function($q)  {
                    $q->where('role_id', 4)->orWhere('previous_role_id', 4);                   
                })->where('school_id', app('school')->id)->get();
            $history = SmNews::with('category')->histories()->limit(3)->where('school_id', app('school')->id)->get();
            $mission = SmNews::with('category')->missions()->limit(3)->where('school_id', app('school')->id)->get();
        
            return view('frontEnd.home.light_about', compact('exams', 'classes', 'subjects', 'exams_types', 'sections', 'about', 'testimonial', 'totalStudents', 'totalTeachers', 'history', 'mission'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function news()
    {

        try {
            $exams = SmExam::where('school_id', app('school')->id)->get();
            $exams_types = SmExamType::where('school_id', app('school')->id)->get();
            $classes = SmClass::where('school_id', app('school')->id)->where('active_status', 1)->get();
            $subjects = SmSubject::where('school_id', app('school')->id)->where('active_status', 1)->get();
            $sections = SmSection::where('school_id', app('school')->id)->where('active_status', 1)->get();
            return view('frontEnd.home.light_news', compact('exams', 'classes', 'subjects', 'exams_types', 'sections'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function contact()
    {
        try {

             if(auth()->check()){
                $user = Auth::user();
                $role_id = $user->role_id;
                if ($role_id == 2) {
                    return redirect('student-dashboard');
                } elseif ($role_id == 3) {
                    return redirect('parent-dashboard');
                } elseif ($role_id == "") {
                    return redirect('login');
                } elseif (Auth::user()->is_saas == 1) {
                    return redirect('saasStaffDashboard');
                } elseif($role_id == 1 && $user->email == 'admin@gmail.com') {
                    return redirect('school_list');
                }else {
                    return redirect('admin-dashboard');
                }
            }

            $exams = SmExam::where('school_id', app('school')->id)->get();
            $exams_types = SmExamType::where('school_id', app('school')->id)->get();
            $classes = SmClass::where('school_id', app('school')->id)->where('active_status', 1)->get();
            $subjects = SmSubject::where('school_id', app('school')->id)->where('active_status', 1)->get();
            $sections = SmSection::where('school_id', app('school')->id)->where('active_status', 1)->get();

            $contact_info = SmContactPage::where('school_id', app('school')->id)->first();
            return view('frontEnd.home.light_contact', compact('exams', 'classes', 'subjects', 'exams_types', 'sections', 'contact_info'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function institutionPrivacyPolicy()
    {

        try {
            $exams = SmExam::where('school_id', app('school')->id)->get();
            $exams_types = SmExamType::where('school_id', app('school')->id)->get();
            $classes = SmClass::where('school_id', app('school')->id)->where('active_status', 1)->get();
            $subjects = SmSubject::where('school_id', app('school')->id)->where('active_status', 1)->get();
            $sections = SmSection::where('school_id', app('school')->id)->where('active_status', 1)->get();

            $contact_info = SmContactPage::where('school_id', app('school')->id)->first();
            return view('frontEnd.home.institutionPrivacyPolicy', compact('exams', 'classes', 'subjects', 'exams_types', 'sections', 'contact_info'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function developerTool($purpose)
    {

        if ($purpose == 'debug_true') {
            envu([
                'APP_ENV' => 'local',
                'APP_DEBUG' => 'true',
            ]);

        } elseif ($purpose == 'debug_false') {
            envu([
                'APP_ENV' => 'production',
                'APP_DEBUG' => 'false',
            ]);

        } elseif ($purpose == "sync_true") {
            envu([
                'APP_SYNC' => 'true',
            ]);

        } elseif ($purpose == "sync_false") {
            envu([
                'APP_SYNC' => 'false',
            ]);

        }
    }

    public function institutionTermServices()
    {

        try {
            $exams = SmExam::where('school_id', app('school')->id)->get();
            $exams_types = SmExamType::where('school_id', app('school')->id)->get();
            $classes = SmClass::where('school_id', app('school')->id)->where('active_status', 1)->get();
            $subjects = SmSubject::where('school_id', app('school')->id)->where('active_status', 1)->get();
            $sections = SmSection::where('school_id', app('school')->id)->where('active_status', 1)->get();

            $contact_info = SmContactPage::where('school_id', app('school')->id)->first();
            return view('frontEnd.home.institutionTermServices', compact('exams', 'classes', 'subjects', 'exams_types', 'sections', 'contact_info'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function newsDetails($id)
    {
        $news = SmNews::where('school_id', app('school')->id)->findOrFail($id);
        $otherNews = SmNews::where('school_id', app('school')->id)->orderBy('id', 'asc')->whereNotIn('id', [$id])->limit(3)->get();
        $notice_board = SmNoticeBoard::where('school_id', app('school')->id)->where('is_published', 1)->orderBy('created_at', 'DESC')->take(3)->get();
      
        return view('frontEnd.home.light_news_details', compact('news', 'notice_board', 'otherNews'));
       
    }

    public function newsPage()
    {

        try {
            $news = SmNews::where('school_id', app('school')->id)->paginate(8);
            $newsPage = SmNewsPage::where('school_id', app('school')->id)->first();
            return view('frontEnd.home.light_news', compact('news', 'newsPage'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function loadMorenews(Request $request)
    {
        try {
            $count = SmNews::count();
            $skip = $request->skip;
            $limit = $count - $skip;
            $due_news = SmNews::skip($skip)->where('school_id', app('school')->id)->take(4)->get();
            return view('frontEnd.home.loadMoreNews', compact('due_news', 'skip', 'count'));
        } catch (\Exception $e) {
            return response('error');
        }
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);
        try {
            $contact_message = new SmContactMessage();
            $contact_message->name = $request->name;
            $contact_message->email = $request->email;
            $contact_message->subject = $request->subject;
            $contact_message->message = $request->message;
            $contact_message->school_id = app('school')->id;
            $contact_message->save();

            $receiver_name= "System Admin";
            $compact['contact_name'] = $request->name;
            $compact['contact_email'] = $request->email;
            $compact['subject'] = $request->subject;
            $compact['contact_message'] = $request->message;
            $contact_page_email = SmContactPage::where('school_id',app('school')->id)->first();
            $setting = SmGeneralSettings::where('school_id', app('school')->id)->first();
            if($contact_page_email->email){
                $email = $contact_page_email->email;
            } else {
                $email = $setting->email;
            }
            @send_mail($email, $receiver_name, "frontend_contact", $compact);
            return response()->json(['success'=>'success']);
        } catch (\Exception $e) {
            return response()->json('error');
        }
    }



    public function contactMessage(Request $request)
    {
        try {
            $contact_messages = SmContactMessage::where('school_id', app('school')->id)->orderBy('id', 'desc')->get();
            $module_links = InfixPermissionAssign::where('role_id', Auth::user()->role_id)->where('school_id', Auth::user()->school_id)->pluck('module_id')->toArray();
            return view('frontEnd.contact_message', compact('contact_messages', 'module_links'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    //user register method start
    public function register()
    {

        try {
            $login_background = SmBackgroundSetting::where([['is_default', 1], ['title', 'Login Background']])->first();

            if (empty($login_background)) {
                $css = "";
            } else {
                if (!empty($login_background->image)) {
                    $css = "background: url('" . url($login_background->image) . "')  no-repeat center;  background-size: cover;";

                } else {
                    $css = "background:" . $login_background->color;
                }
            }
            $schools = SmSchool::where('active_status', 1)->get();
            return view('auth.registerCodeCanyon', compact('schools', 'css'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function customer_register(Request $request)
    {

        $request->validate([
            'fullname' => 'required|min:3|max:100',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6',
        ]);

        try {
            //insert data into user table
            $s = new User();
            $s->role_id = 4;
            $s->full_name = $request->fullname;
            $s->username = $request->email;
            $s->email = $request->email;
            $s->active_status = 0;
            $s->access_status = 0;
            $s->password = Hash::make($request->password);
            $s->save();
            $result = $s->toArray();
            $last_id = $s->id; //last id of user table

            //insert data into staff table
            $st = new SmStaff();
            $st->school_id = 1;
            $st->user_id = $last_id;
            $st->role_id = 4;
            $st->first_name = $request->fullname;
            $st->full_name = $request->fullname;
            $st->last_name = '';
            $st->staff_no = 10;
            $st->email = $request->email;
            $st->active_status = 0;
            $st->save();

            $result = $st->toArray();
            if (!empty($result)) {
                Toastr::success('Operation successful', 'Success');
                return redirect('login');
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            Toastr::error('Operation Failed,' . $e->getMessage(), 'Failed');
            return redirect()->back();
        }
    }

    public function course()
    {

        try {
            $exams = SmExam::where('school_id', app('school')->id)->get();
            $course = SmCourse::where('school_id', app('school')->id)->paginate(3);
            $news = SmNews::where('school_id', app('school')->id)->orderBy('order', 'asc')->limit(4)->get();
            $exams_types = SmExamType::where('school_id', app('school')->id)->get();
            $coursePage = SmCoursePage::where('school_id', app('school')->id)->first();
            $classes = SmClass::where('school_id', app('school')->id)->where('active_status', 1)->get();
            $subjects = SmSubject::where('school_id', app('school')->id)->where('active_status', 1)->get();
            $sections = SmSection::where('school_id', app('school')->id)->where('active_status', 1)->get();
            return view('frontEnd.home.light_course', compact('exams', 'classes', 'coursePage', 'subjects', 'exams_types', 'sections', 'course', 'news'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function courseDetails($id)
    {
        try {
            $course = SmCourse::where('school_id', app('school')->id)->find($id);
            $course_details = SmCoursePage::where('school_id', app('school')->id)->where('is_parent', 0)->first();
            $courses = SmCourse::where('school_id', app('school')->id)->orderBy('id', 'asc')->whereNotIn('id', [$id])->limit(3)->get();
            return view('frontEnd.home.light_course_details', compact('course', 'courses', 'course_details'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function loadMoreCourse(Request $request)
    {
        try {
            $count = SmCourse::count();
            $skip = $request->skip;
            $limit = $count - $skip;
            $due_courses = SmCourse::skip($skip)->where('school_id', app('school')->id)->take(3)->get();
            return view('frontEnd.home.loadMorePage', compact('due_courses', 'skip', 'count'));
        } catch (\Exception $e) {
            return response('error');
        }
    }

    public function socialMedia()
    {
        $visitors = SmSocialMediaIcon::where('school_id', app('school')->id)->get();
        return view('frontEnd.socialMedia', compact('visitors'));
    }

    


 

    public function viewPage($slug)
    {
        try {
            $page = SmPage::where('slug', $slug)->where('school_id', app('school')->id)->first();
            return view('frontEnd.pages.pages', compact('page'));
        } catch (\Exception $e) {

            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function deletePage(Request $request)
    {
        try {
            $data = SmPage::find($request->id);

            if ($data->header_image != "") {
                unlink($data->header_image);
            }

            $result = SmPage::find($request->id)->delete();
            if ($result) {
                Toastr::success('Operation Successfull', 'Success');
            } else {
                Toastr::error('Operation Failed', 'Failed');
            }
            return redirect('page-list');
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function deleteMessage($id)
    {
        try {
            SmContactMessage::find($id)->delete();
            Toastr::success('Operation successful', 'Success');
            return redirect('contact-message');
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    //School Register
    public function signup()
    {
        try
        {
            // if(auth()->check()){
            //     return redirect('dashboard');
            // }
            
            if(auth()->check()){
                $user = Auth::user();
                $role_id = $user->role_id;
                if ($role_id == 2) {
                    return redirect('student-dashboard');
                } elseif ($role_id == 3) {
                    return redirect('parent-dashboard');
                } elseif ($role_id == "") {
                    return redirect('login');
                } elseif (Auth::user()->is_saas == 1) {
                    return redirect('saasStaffDashboard');
                } elseif($role_id == 1 && $user->email == 'admin@gmail.com') {
                    return redirect('school_list');
                }else {
                    return redirect('admin-dashboard');
                }
            }

            $dbname='adminschool';
            Config::set('database.connections.second_db.database', $dbname);
            DB::connection('second_db')->reconnect();
            //$users = DB::connection('second_db')->table('users')->get();
            $plan1_menu_list = DB::connection('second_db')->table('subscription_menu_accesses')->where('active_status', 1)->where('plan_id',1)->get();

            $plan2_menu_list = DB::connection('second_db')->table('subscription_menu_accesses')->where('active_status', 1)->where('plan_id',2)->get();
            $plan3_menu_list = DB::connection('second_db')->table('subscription_menu_accesses')->where('active_status', 1)->where('plan_id',3)->get();

            return view('frontEnd.home.signup',compact('plan1_menu_list','plan2_menu_list','plan3_menu_list'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    
    public function school_register(Request $request)
    {
        // dd(DB::connection()->getDatabaseName());

        // dd($request->all());

        $menuIds = $request->hidmenu2_id . ',' . $request->hidmenu3_id; // Concatenate menu IDs with commas
        $formattedMenuIds = trim($menuIds, ',');
        $request->validate([
           'school_name' => 'required|min:3|max:100',
            'workspace' => [
                'required',
                'min:3',
                'max:100',
                function ($attribute, $value, $fail) {
                    if (in_array(strtolower($value), ['edsere', 'adminschool'])) {
                        $fail("Workspace Name Already Exist.");
                    }
                },
            ],
            'school_id' => 'required|min:3|max:100',
            'contact_person' => 'required|min:3|max:100',
            'contact_number' => 'required|min:3|max:100',
            'no_of_students' => 'required|min:3|max:100',
            'major_module' => 'required|min:3|max:100',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6',
        ]);


        try {

            $dbname=DB::connection()->getDatabaseName();
            
            $workspace_check = SmSchool::where('domain', $request->workspace)->count();
            $school_check = SmSchool::where('school_name', $request->school_name)->count();
            if($workspace_check>0){
                return redirect()->back()->with('error', 'Workspace Name Already Exist.');
            }

            if($school_check>0){
                return redirect()->back()->with('error', 'School Name Already Exist.');
            }

            //insert data into user table
            $db_name=$request->workspace;
            $dbname = str_replace(' ', '_', $db_name);

            $s = new SmSchool();
            $s->school_name = $request->school_name;
            $s->domain = $dbname;
            $s->database_name = '';
            $s->school_code = $request->school_id;
            $s->email = $request->email;
            $s->contact_person = $request->contact_person;
            $s->phone = $request->contact_number;
            $s->no_of_students = $request->no_of_students;
            $s->major_mudule = $request->major_module;
            $s->present_system = $request->present_system;
            $s->pro_desc = $request->pro_desc;
            $s->cons_desc = $request->cons_desc;
            $s->management_type = $request->management_type;
            $s->management_category = $request->management_category;
            $s->school_category = $request->school_category;
            $s->type_of_school = $request->type_of_school;
            $s->address = $request->address;
            $s->year_of_establishment = $request->year_of_establishment;
            $s->plan_id = $request->plan_selected;
            $s->password = Hash::make($request->password);
            // $s->referred_by = $request->referred_by;
            $s->active_status = 1;
            // $s->subscription_menu_id = $formattedMenuIds;
            $s->save();
            $result = $s->toArray();
            $primary_school_id = $s->id; 
            if (!empty($result)) {

                return redirect()->back()->with('success', 'Thank you for registering with us');
            } else {
               return redirect()->back()->with('error', 'Something went wrong. Please try again later or contact support if the issue persists.');
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    public function sendContactMail(Request $request)
    {
        try
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:2|max:100',
                'email' => 'required|email',
                'subject' => 'required|min:4|max:100',
                'message' => 'required|min:4|max:300',
            ], [
                'name.required' => 'The name field is required.',
                'name.min' => 'The name must be at least 2 characters.',
                'name.max' => 'The name may not be greater than 100 characters.',
                'email.required' => 'The email field is required.',
                'email.email' => 'Please enter a valid email address.',
                'subject.required' => 'The subject field is required.',
                'subject.min' => 'The subject must be at least 4 characters.',
                'subject.max' => 'The subject may not be greater than 100 characters.',
                'message.required' => 'The message field is required.',
                'message.min' => 'The message must be at least 4 characters.',
                'message.max' => 'The message may not be greater than 300 characters.',
            ]);

            if ($validator->fails()) {
               return redirect()->back()->with('error', $validator->errors()->first());
            }
            $name = $request->name;
            $email = $request->email;
            $subject = $request->subject;
            $message = $request->message;
            
            $school_config = schoolConfig();
            if(isset($school_config->email) && $school_config->email!='') {
                $email1 = $school_config->email;
            } else {
                $email1 = 'edsereltd@gmail.com';
            }
            $email2 = 'edsereltd@yopmail.com';

            Mail::to([$email1, $email2])->send(new SendEmailContact($name, $email, $subject, $message));
            return redirect()->back()->with('message', 'Email sent successfully.');
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
        
    }
}
