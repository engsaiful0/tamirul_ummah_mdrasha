<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PayrollSettingsEarnings extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payroll_settings_earnings = array(
			  array('id' => '1','name' => 'Basic Pay','group_id' => '1','type_name' => '% of CTC','percentage' => '50','school_id' => '1','active_status' => '1','created_by' => NULL,'updated_by' => NULL,'created_at' => NULL,'updated_at' => '2023-11-27 16:34:16'),
			  array('id' => '2','name' => 'House Rent Allowance (H.R.A.)','group_id' => '1','type_name' => '% of Basic','percentage' => '40','school_id' => '1','active_status' => '1','created_by' => NULL,'updated_by' => NULL,'created_at' => NULL,'updated_at' => '2023-11-28 05:59:16'),
			  array('id' => '3','name' => 'Bonus','group_id' => '2','type_name' => '% of CTC','percentage' => '5','school_id' => '1','active_status' => '1','created_by' => NULL,'updated_by' => NULL,'created_at' => NULL,'updated_at' => '2023-11-28 05:59:16'),
			  array('id' => '4','name' => 'Conveyance','group_id' => '2','type_name' => '% of CTC','percentage' => '10','school_id' => '1','active_status' => '1','created_by' => NULL,'updated_by' => NULL,'created_at' => NULL,'updated_at' => '2023-11-27 11:14:24'),
			  array('id' => '5','name' => 'Medical','group_id' => '2','type_name' => '% of CTC','percentage' => '10','school_id' => '1','active_status' => '1','created_by' => NULL,'updated_by' => NULL,'created_at' => NULL,'updated_at' => '2023-11-25 08:25:27'),
			  array('id' => '22','name' => 'Other Allowance','group_id' => '2','type_name' => '% of CTC','percentage' => '3','school_id' => '1','active_status' => '1','created_by' => NULL,'updated_by' => NULL,'created_at' => NULL,'updated_at' => '2023-11-27 11:14:24'),
			  array('id' => '23','name' => 'Performance Allowance','group_id' => '2','type_name' => '% of CTC','percentage' => '2','school_id' => '1','active_status' => '1','created_by' => NULL,'updated_by' => NULL,'created_at' => NULL,'updated_at' => '2023-11-27 11:14:24')
			);
        DB::table('payroll_settings_earnings')->insert($payroll_settings_earnings);
    }
}
