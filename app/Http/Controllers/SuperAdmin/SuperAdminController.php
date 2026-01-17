<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\SmFrontendPersmission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Modules\Saas\Entities\SmPackagePlan;
use App\SmBackgroundSetting;
use App\SmSchool;
use Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

//use Modules\RolePermission\Entities\InfixPermissionAssign;

class SuperAdminController extends Controller
{

    public function __construct()
    {
        
        $this->middleware('PM');
        // User::checkAuth();
    }


    //user register method start
    public function schoolRegister()
    {
        // dd(DB::connection()->getDatabSSaseName());

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
            $schools=[];
            $registered_schools = SmSchool::where('database_name', "")->where('payment_status',0)->where('active_status',1)->get();

            return view('superAdmin.schoolRegister', compact('schools', 'css','registered_schools'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function customer_register(Request $request)
    {
        // dd(DB::connection()->getDatabaseName());
        // dd($request->all());    

        $request->validate([
            'schoolname' => 'required',
            // 'workspace' => 'required|min:3|max:100',
            // 'first_name' => 'required|min:3|max:100',
            // 'last_name' => 'required|min:3|max:100',
            // 'email' => 'required|email',
            // 'password' => 'required|min:6',
            // 'password_confirmation' => 'required_with:password|same:password|min:6',
        ]);

        try {
            $workspace_check = SmSchool::where('id', $request->schoolname)->get();
            // print_r($workspace_check[0]->domain);exit();

            //insert data into user table
            $db_name=$workspace_check[0]->domain;
            $dbname = str_replace(' ', '_', $db_name);

            // $s = new SmSchool();
            // $s->school_name = $request->school_name;
            // $s->domain = $dbname;
            // $s->database_name = $dbname;
            // $s->active_status = 1;
            // $s->save();
            // $result = $s->toArray();
            $primary_school_id = $workspace_check[0]->id; 
            if (!empty($primary_school_id)) {
                
                //Generate New Dateabase
                $hasDb = DB::connection('mysql')->select("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = "."'".$dbname."'"); 
           
                DB::connection('mysql')->beginTransaction();
                $create = DB::select("CREATE DATABASE {$dbname}");

                DB::table('sm_schools')->where('id', $primary_school_id)->update([
                    'database_name' => $dbname
                ]);
 
                //Connect the New Database
                Config::set('database.connections.second_db.database', $dbname);
                DB::connection('second_db')->reconnect();
                // dd(DB::connection('second_db')->getDatabaseName());

                // Run migrations
                Schema::connection('second_db')->getConnection()->reconnect();
                Artisan::call('migrate', ['--database' => 'second_db']);

                //Run Seeders
                Artisan::call('db:seed', [
                    '--database' => 'second_db',
                    '--class' => 'SMSTemplatesSeeder',
                ]);

                Artisan::call('db:seed', [
                    '--database' => 'second_db',
                    '--class' => 'PayrollSettingsDeductions',
                ]);

                Artisan::call('db:seed', [
                    '--database' => 'second_db',
                    '--class' => 'PayrollSettingsGroup',
                ]);

                Artisan::call('db:seed', [
                    '--database' => 'second_db',
                    '--class' => 'SidebarPermission',
                ]);

                Artisan::call('db:seed', [
                    '--database' => 'second_db',
                    '--class' => 'PayrollSettingsEarnings',
                ]);

                Artisan::call('db:seed', [
                    '--database' => 'second_db',
                    '--class' => 'SmBaseSetupsSeeder',
                ]);
                Artisan::call('db:seed', [
                    '--database' => 'second_db',
                    '--class' => 'SidebarMenuPermissionSeeder',
                ]);
                Artisan::call('db:seed', [
                    '--database' => 'second_db',
                    '--class' => 'EpfWagesSeeder',
                ]);
                
                // Run seeders
                // Artisan::call('db:seed');
                // $users = DB::connection('second_db')->table('users')->get();
                // $connection = 'second_db';
                DB::connection('second_db')->table('sm_schools')->where('id', 1)->update([
                    'school_name' => $workspace_check[0]->school_name,
                    'domain' => $workspace_check[0]->school_name,
                    'primary_school_id' => $primary_school_id,
                    'email' => $workspace_check[0]->email,
                    // 'password' => $workspace_check[0]->password,

                    // ... other columns
                ]);
                
                // $full_name = $request->first_name.' '.$request->last_name;
                
                DB::connection('second_db')->table('users')->where('id', 1)->update([
                    'full_name' => $workspace_check[0]->contact_person,
                    'username' => $workspace_check[0]->email,
                    'email' => $workspace_check[0]->email,
                    'password' => $workspace_check[0]->password,
                    'is_administrator' => 'no'
                    // ... other columns
                ]);

                DB::connection('second_db')->table('sm_staffs')->where('id', 1)->update([
                    'first_name' => $workspace_check[0]->contact_person,
                    'last_name' => "",
                    'full_name' => $workspace_check[0]->contact_person,
                    // ... other columns
                ]);
                return back()->with('success','Successfully registered new school');
                // Toastr::success('Operation successful', 'Success');
               // return redirect()->route('school_list');
            } else {
                // Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return back()->with('error',$e->getMessage());
            // Toastr::error('Operation Failed,' . $e->getMessage(), 'Failed');
            //return redirect()->back($e->getMessage());
        }
    }

    public function school_list(Request $request){
        try {
            $school_list = SmSchool::where('domain', '!=', 'school')->get();
            $dbname='adminschool';
            Config::set('database.connections.second_db.database', $dbname);
            DB::connection('second_db')->reconnect();
            //$users = DB::connection('second_db')->table('users')->get();
            $plan1_menu_list = DB::connection('second_db')->table('subscription_menu_accesses')->where('active_status', 1)->where('plan_id',1)->get();

            $plan2_menu_list = DB::connection('second_db')->table('subscription_menu_accesses')->where('active_status', 1)->where('plan_id',2)->get();
            $plan3_menu_list = DB::connection('second_db')->table('subscription_menu_accesses')->where('active_status', 1)->where('plan_id',3)->get();

            return view('backEnd.school.school_list', compact('school_list','plan1_menu_list','plan2_menu_list','plan3_menu_list'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function schoolQuerySearch(Request $request)
    {
        try {
            $requestData = [];
            $school_date_from1 = date('Y-m-d', strtotime($request->school_date_from));
            $school_date_to1 = date('Y-m-d', strtotime($request->school_date_to));
            $school_date_from = $request->school_date_from;
            $school_date_to = $request->school_date_to;
            $searchtxt = $request->searchtxt;
            if($request->school_date_from!='' && $request->school_date_to!='' && $request->searchtxt=='') {
                $school_list = DB::table('sm_schools')
                ->whereBetween('created_at', [$school_date_from1, $school_date_to1])
                ->get();
                return view('backEnd.school.school_list', compact('school_list', 'school_date_from', 'school_date_to'));
            } elseif($request->school_date_from=='' && $request->school_date_to=='' && $request->searchtxt!='') {
                $school_list = DB::table('sm_schools')
                ->where('school_name', 'like', '%' . $searchtxt . '%')
                ->orwhere('domain', 'like', '%' . $searchtxt . '%')
                ->get();
                return view('backEnd.school.school_list', compact('school_list', 'school_date_from', 'school_date_to', 'searchtxt'));
            } else {
                $school_list = DB::table('sm_schools')
                ->whereBetween('created_at', [$school_date_from1, $school_date_to1])
                ->where('school_name', 'like', '%' . $searchtxt . '%')
                ->orwhere('domain', 'like', '%' . $searchtxt . '%')
                ->get();
            }
            return view('backEnd.school.school_list', compact('school_list', 'school_date_from', 'school_date_to', 'searchtxt'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function paidStatus(Request $request, $id)
    {
        try {
            DB::table('sm_schools')->where('id', $id)->update([
                    'payment_status' => 1
                ]);
            Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function activeStatus(Request $request, $id)
    {
        try 
        {
            DB::table('sm_schools')->where('id', $id)->update([
            'active_status' => DB::raw('1 - active_status')
            ]);
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
            
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    
}
