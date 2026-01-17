<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\RolePermission\Entities\Permission;
use Illuminate\Support\Facades\Cache;

class SyncStudentPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:student-permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync student permissions from student_permissions.php to database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Starting permission sync...');
        
        try {
            // Load student permissions
            $studentPermissionList = include('./resources/var/permission/student_permissions.php');
            
            $synced = 0;
            $bar = $this->output->createProgressBar(count($studentPermissionList));
            $bar->start();
            
            foreach($studentPermissionList as $item) {
                storePermissionData($item);
                $synced++;
                $bar->advance();
            }
            
            $bar->finish();
            $this->newLine();
            
            // Clear cache
            try {
                $domain = function_exists('SaasDomain') ? SaasDomain() : 'default';
                Cache::forget('PermissionList_' . $domain);
                Cache::forget('RoleList_' . $domain);
                Cache::forget('oldPermissionSync' . $domain);
            } catch (\Exception $e) {
                Cache::flush();
            }
            
            $this->info("✅ Successfully synced {$synced} permission groups!");
            $this->info('✅ Permissions have been updated in the database.');
            $this->info('✅ You can now see "Exam Report" permission at: /rolepermission/assign-permission/2');
            
            return Command::SUCCESS;
            
        } catch (\Exception $e) {
            $this->error('❌ Error: ' . $e->getMessage());
            $this->error('Stack trace: ' . $e->getTraceAsString());
            return Command::FAILURE;
        }
    }
}

