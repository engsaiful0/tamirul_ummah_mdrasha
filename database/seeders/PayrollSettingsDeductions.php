<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PayrollSettingsDeductions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payroll_settings_deductions = array(
		  array('id' => '1','name' => 'Income Tax (TDS)','group_id' => '3','type_name' => 'Default','percentage' => '0','school_id' => '1','active_status' => '1','created_by' => NULL,'updated_by' => NULL,'created_at' => NULL,'updated_at' => '2023-11-26 09:18:28'),
		  array('id' => '2','name' => 'ESI','group_id' => '5','type_name' => '% of CTC','percentage' => '0.75','school_id' => '1','active_status' => '1','created_by' => NULL,'updated_by' => NULL,'created_at' => NULL,'updated_at' => '2023-11-26 09:38:13'),
		  array('id' => '5','name' => 'Employer Contribution','group_id' => '4','type_name' => '% of CTC','percentage' => '12','school_id' => '1','active_status' => '1','created_by' => NULL,'updated_by' => NULL,'created_at' => NULL,'updated_at' => '2023-11-26 09:18:28'),
		  array('id' => '6','name' => 'Employee Contribution','group_id' => '4','type_name' => '% of CTC','percentage' => '3.67','school_id' => '1','active_status' => '1','created_by' => NULL,'updated_by' => NULL,'created_at' => NULL,'updated_at' => '2023-11-26 09:38:13')
		);
		DB::table('payroll_settings_deductions')->insert($payroll_settings_deductions);
    }
}
