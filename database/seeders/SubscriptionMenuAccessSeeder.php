<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionMenuAccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $subscription_menu_accesses = array(
          array('id' => '1','menu_name' => 'Student Management','plan_id' => '1','permission_id' => NULL,'price' => '0','active_status' => '1','created_at' => NULL,'updated_at' => NULL),
          array('id' => '2','menu_name' => 'Staff Management','plan_id' => '1','permission_id' => NULL,'price' => '0','active_status' => '1','created_at' => NULL,'updated_at' => NULL),
          array('id' => '3','menu_name' => 'Class Management','plan_id' => '1','permission_id' => NULL,'price' => '0','active_status' => '1','created_at' => NULL,'updated_at' => NULL),
          array('id' => '4','menu_name' => 'Fees Management','plan_id' => '1','permission_id' => NULL,'price' => '0','active_status' => '1','created_at' => NULL,'updated_at' => NULL),
          array('id' => '5','menu_name' => 'Exam Management','plan_id' => '1','permission_id' => NULL,'price' => '0','active_status' => '1','created_at' => NULL,'updated_at' => NULL),
          array('id' => '6','menu_name' => 'Assessment /Home-work','plan_id' => '1','permission_id' => NULL,'price' => '0','active_status' => '1','created_at' => NULL,'updated_at' => NULL),
          array('id' => '7','menu_name' => 'Circular','plan_id' => '1','permission_id' => NULL,'price' => '0','active_status' => '1','created_at' => NULL,'updated_at' => NULL),
          array('id' => '8','menu_name' => 'Time Table','plan_id' => '1','permission_id' => NULL,'price' => '0','active_status' => '1','created_at' => NULL,'updated_at' => NULL),
          array('id' => '9','menu_name' => 'Event Management','plan_id' => '1','permission_id' => NULL,'price' => '0','active_status' => '1','created_at' => NULL,'updated_at' => NULL),
          array('id' => '10','menu_name' => 'Library Management','plan_id' => '1','permission_id' => NULL,'price' => '0','active_status' => '1','created_at' => NULL,'updated_at' => NULL),
          array('id' => '11','menu_name' => 'Payroll Management','plan_id' => '2','permission_id' => NULL,'price' => '100','active_status' => '1','created_at' => NULL,'updated_at' => NULL),
          array('id' => '12','menu_name' => 'Transport Management','plan_id' => '2','permission_id' => NULL,'price' => '100','active_status' => '1','created_at' => NULL,'updated_at' => NULL),
          array('id' => '13','menu_name' => 'Inventory Management','plan_id' => '2','permission_id' => NULL,'price' => '100','active_status' => '1','created_at' => NULL,'updated_at' => NULL),
          array('id' => '14','menu_name' => 'Chat - Communication','plan_id' => '2','permission_id' => NULL,'price' => '100','active_status' => '1','created_at' => NULL,'updated_at' => NULL),
          array('id' => '15','menu_name' => 'Expense Management','plan_id' => '2','permission_id' => NULL,'price' => '100','active_status' => '1','created_at' => NULL,'updated_at' => NULL),
          array('id' => '16','menu_name' => 'Report Management','plan_id' => '2','permission_id' => NULL,'price' => '100','active_status' => '1','created_at' => NULL,'updated_at' => NULL),
          array('id' => '17','menu_name' => 'School Domain','plan_id' => '3','permission_id' => NULL,'price' => '200','active_status' => '1','created_at' => NULL,'updated_at' => NULL),
          array('id' => '18','menu_name' => 'Individual Mobile App for School','plan_id' => '3','permission_id' => NULL,'price' => '200','active_status' => '1','created_at' => NULL,'updated_at' => NULL),
          array('id' => '19','menu_name' => 'Branches - Individual School','plan_id' => '3','permission_id' => NULL,'price' => '200','active_status' => '1','created_at' => NULL,'updated_at' => NULL)
        );
        DB::table('subscription_menu_accesses')->insert($subscription_menu_accesses);
    }
}
