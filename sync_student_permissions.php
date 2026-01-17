<?php

/**
 * Script to sync student permissions from student_permissions.php to database
 * Run this script from command line: php sync_student_permissions.php
 * Or access via browser: http://localhost/Edsere/sync_student_permissions.php
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Modules\RolePermission\Entities\Permission;
use Illuminate\Support\Facades\Cache;

try {
    echo "Starting permission sync...\n";
    
    // Load student permissions
    $studentPermissionList = include('./resources/var/permission/student_permissions.php');
    
    $synced = 0;
    foreach($studentPermissionList as $item) {
        storePermissionData($item);
        $synced++;
    }
    
    // Clear cache - handle SaasDomain safely
    try {
        $domain = function_exists('SaasDomain') ? SaasDomain() : 'default';
        Cache::forget('PermissionList_' . $domain);
        Cache::forget('RoleList_' . $domain);
        Cache::forget('oldPermissionSync' . $domain);
    } catch (\Exception $e) {
        // If SaasDomain fails, clear all cache patterns
        Cache::flush();
    }
    
    echo "Successfully synced {$synced} permission groups!\n";
    echo "Permissions have been updated in the database.\n";
    echo "Please refresh the permission assignment page at: http://localhost/Edsere/rolepermission/assign-permission/2\n";
    
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
}

