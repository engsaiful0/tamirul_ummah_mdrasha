<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PayrollSettingsGroup extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payroll_settings_group = array(
		  array('id' => '1','group_name' => 'Basic Earnings'),
		  array('id' => '2','group_name' => 'All Earnings'),
		  array('id' => '3','group_name' => 'Tax Deducted at Source (T.D.S.)'),
		  array('id' => '4','group_name' => 'Provident Fund (PF)'),
		  array('id' => '5','group_name' => 'All Deductions')
		);
		DB::table('payroll_settings_group')->insert($payroll_settings_group);
    }
}
