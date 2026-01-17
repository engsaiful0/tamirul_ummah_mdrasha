<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\SmSchool;
use Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

class CreateSchoolDatabaseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $primary_school_id = $this->school->id;
            $dbname = $this->dbname;
    
            // Skip if DB already exists
            $hasDb = DB::connection('mysql')->select("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ?", [$dbname]);
            if (!$hasDb) {
                DB::connection('mysql')->statement("CREATE DATABASE `$dbname`");
            }
    
            // Update school's DB name
            DB::table('sm_schools')->where('id', $primary_school_id)->update([
                'database_name' => $dbname
            ]);
    
            // Set connection
            Config::set("database.connections.second_db.database", $dbname);
            DB::purge('second_db');
            DB::reconnect('second_db');
    
            // Run migration and seeders
            Artisan::call('migrate', ['--database' => 'second_db', '--force' => true]);
    
            $seeders = [
                'SMSTemplatesSeeder',
                'PayrollSettingsDeductions',
                'PayrollSettingsGroup',
                'SidebarPermission',
                'PayrollSettingsEarnings',
                'SmBaseSetupsSeeder',
                'SidebarMenuPermissionSeeder',
                'EpfWagesSeeder',
            ];
    
            foreach ($seeders as $seeder) {
                Artisan::call('db:seed', [
                    '--database' => 'second_db',
                    '--class' => $seeder,
                    '--force' => true,
                ]);
            }
    
            // Setup default records
            DB::connection('second_db')->table('sm_schools')->where('id', 1)->update([
                'school_name' => $this->school->school_name,
                'domain' => $this->school->school_name,
                'primary_school_id' => $primary_school_id,
                'email' => $this->school->email,
            ]);
    
            DB::connection('second_db')->table('users')->where('id', 1)->update([
                'full_name' => $this->school->contact_person,
                'username' => $this->school->email,
                'email' => $this->school->email,
                'password' => $this->school->password,
                'is_administrator' => 'no',
            ]);
    
            DB::connection('second_db')->table('sm_staffs')->where('id', 1)->update([
                'first_name' => $this->school->contact_person,
                'last_name' => "",
                'full_name' => $this->school->contact_person,
            ]);
        } catch (\Exception $e) {
            Log::error("School Setup Failed for {$this->school->id}: " . $e->getMessage());
        }
    }
    
}
