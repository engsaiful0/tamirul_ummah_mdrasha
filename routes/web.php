<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

if (config('app.app_sync')) {
    Route::get('/', 'LandingController@index')->name('/');
}

if (moduleStatusCheck('Saas')) {
    Route::group(['middleware' => ['subdomain'], 'domain' => '{subdomain}.' . config('app.short_url')], function ($routes) {
        require('tenant.php');
    });

    Route::group(['middleware' => ['subdomain'], 'domain' => '{subdomain}'], function ($routes) {
        require('tenant.php');
    });
}

Route::group(['middleware' => ['subdomain']], function ($routes) {
    require('tenant.php');
});

Route::get('migrate', function () {
    if(Auth::check() && Auth::id() == 1){
        \Artisan::call('migrate', ['--force' => true]);
        \Brian2694\Toastr\Facades\Toastr::success('Migration run successfully');
        return redirect()->to(url('/admin-dashboard'));
    }
    abort(404);
});

Route::get('sync-student-permissions', function () {
    if(Auth::check() && Auth::id() == 1){
        try {
            $studentPermissionList = include('./resources/var/permission/student_permissions.php');
            $synced = 0;
            foreach($studentPermissionList as $item) {
                storePermissionData($item);
                $synced++;
            }
            
            // Clear cache
            try {
                $domain = function_exists('SaasDomain') ? SaasDomain() : 'default';
                \Illuminate\Support\Facades\Cache::forget('PermissionList_' . $domain);
                \Illuminate\Support\Facades\Cache::forget('RoleList_' . $domain);
                \Illuminate\Support\Facades\Cache::forget('oldPermissionSync' . $domain);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Cache::flush();
            }
            
            \Brian2694\Toastr\Facades\Toastr::success("Successfully synced {$synced} permission groups!");
            return redirect()->to(url('/rolepermission/assign-permission/2'));
        } catch (\Exception $e) {
            \Brian2694\Toastr\Facades\Toastr::error('Error: ' . $e->getMessage());
            return redirect()->back();
        }
    }
    abort(404);
});

