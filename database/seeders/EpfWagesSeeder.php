<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EpfWagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $payroll_settings_epfwages = array(
          array('id' => '1','epfwages' => '75','epf' => '12','eps' => '8.33','esi_salary_limit' => '21000','da_allawance' => '15000','school_id' => '1','active_status' => '1','created_by' => NULL,'updated_by' => NULL,'created_at' => NULL,'updated_at' => '2023-12-31 13:56:30')
        );
        DB::table('payroll_settings_epfwages')->insert($payroll_settings_epfwages);
    }
}
