<?php

namespace App\Http\Middleware;

use App\SmCustomLink;
use App\SmFrontendPersmission;
use App\SmGeneralSettings;
use App\SmHeaderMenuManager;
use App\SmSocialMediaIcon;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Spatie\Valuestore\Valuestore;

class SubdomainMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if we're accessing the root domain
        $fullHost = $request->getHost();
        $rootDomain = config('app.domain');
        $possibleRootDomains = ['edsere.com.ng', $rootDomain];
        $isRootDomain = false;
        
        foreach ($possibleRootDomains as $domain) {
            if ($fullHost === $domain) {
                $isRootDomain = true;
                break;
            }
        }
        
        // For root domain, skip school lookup and use default school
        if ($isRootDomain) {
            try {
                $school = \App\SmSchool::find(1);
                if (!$school) {
                    // If school ID 1 doesn't exist, try to get any active school or skip
                    $school = \App\SmSchool::where('active_status', 1)->first();
                    if (!$school) {
                        // No school found, continue without school binding
                        return $next($request);
                    }
                }
            } catch (\Exception $e) {
                // If there's an error, just continue without school binding
                return $next($request);
            }
        } else {
            try {
                $school = SaasSchool();
            } catch (\Exception $e) {
                // If school lookup fails, continue without school binding
                return $next($request);
            }
        }

        if (!$school) {
            return $next($request);
        }

        Session::put('domain', $school->domain ?? 'default');
        app()->forgetInstance('school');
        app()->instance('school', $school);
        $settings_prefix = Str::lower(str_replace(' ', '_', $school->domain));
        $chat_settings = storage_path('app/chat/' . $settings_prefix . '_settings.json');
        $default_settings = storage_path('app/chat/default_settings.json');
        
        // Ensure default settings file exists
        if (!file_exists($default_settings)) {
            $chat_dir = storage_path('app/chat');
            if (!is_dir($chat_dir)) {
                mkdir($chat_dir, 0755, true);
            }
            $default_content = json_encode([
                'chatting_method' => 'log',
                'chat_can_upload_file' => 'yes',
                'chat_file_limit' => '200',
                'chat_can_make_group' => 'yes',
                'chat_teacher_staff_can_make_group' => 'yes',
                'chat_staff_or_teacher_can_ban_student' => 'yes',
                'chat_teacher_can_pin_top_message' => 'yes',
                'chat_can_teacher_chat_with_parents' => 'yes',
                'chat_can_student_chat_with_admin_account' => 'yes',
                'chat_everyone_to_everyone' => 'yes',
                'chat_teacher_can_chat_with_parents' => 'yes',
                'chat_admin_can_chat_without_invitation' => 'yes',
                'chat_open' => 'yes',
                'pusher_app_id' => '',
                'pusher_app_key' => '',
                'pusher_app_secret' => '',
                'pusher_app_cluster' => ''
            ], JSON_PRETTY_PRINT);
            file_put_contents($default_settings, $default_content);
        }
        
        if (!file_exists($chat_settings)) {
            copy($default_settings, $chat_settings);
        }

        app()->scoped('general_settings', function () use ($chat_settings) {
            return Valuestore::make($chat_settings);
        });

        view()->composer('frontEnd.home.front_master', function ($view) use ($school) {
            $schoolId = $school ? $school->id : (app()->bound('school') ? app('school')->id : 1);
            
            $data = [
                'social_permission' => SmFrontendPersmission::where('name', 'Social Icons')->where('parent_id', 1)->where('is_published', 1)->where('school_id', $schoolId)->first(),
                'menus' => SmHeaderMenuManager::whereNull('parent_id')->where('school_id', $schoolId)->orderBy('position')->get(),
                'custom_link' => SmCustomLink::where('school_id', $schoolId)->first(),
                'social_icons' => SmSocialMediaIcon::where('school_id', $schoolId)->where('status', 1)->get(),
                'school' => $school,
            ];

            $view->with($data);

        });

        return $next($request);
    }
}
