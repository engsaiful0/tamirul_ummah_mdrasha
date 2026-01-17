<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\SmSchool;

class DynamicDatabaseConnectionMiddleware
{
    public function handle($request, Closure $next)
    {
        try {
            $fullHost = $request->getHost();
            // Get the root domain
            $rootDomain = config('app.domain');
            // Extract the subdomain from the full domain
            // Example: schooldemo.edsere.com.ng -> schooldemo
            // Extract subdomain more reliably
            // Handle both config('app.domain') and hardcoded 'edsere.com.ng'
            $possibleRootDomains = ['edsere.com.ng', $rootDomain];
            $db_name = $fullHost;
            
            foreach ($possibleRootDomains as $domain) {
                if ($fullHost !== $domain && strpos($fullHost, $domain) !== false) {
                    // Remove the root domain to get subdomain
                    // schooldemo.edsere.com.ng -> schooldemo
                    $db_name = str_replace('.' . $domain, '', $fullHost);
                    if ($db_name !== $fullHost && !empty($db_name)) {
                        break; // Successfully extracted
                    }
                }
            }
            $db_name = trim($db_name, '.');
            
            // Check if we're accessing the root domain directly (not a subdomain)
            $isRootDomain = false;
            foreach ($possibleRootDomains as $domain) {
                if ($fullHost === $domain) {
                    $isRootDomain = true;
                    break;
                }
            }
            
            // Safety check: if extraction failed and we still have the full domain, 
            // try to extract by splitting on dots (only if not root domain)
            if (!$isRootDomain && $db_name === $fullHost && strpos($fullHost, '.') !== false) {
                $parts = explode('.', $fullHost);
                // If it looks like subdomain.domain.tld, take the first part
                // schooldemo.edsere.com.ng -> [schooldemo, edsere, com, ng]
                if (count($parts) >= 3) {
                    $db_name = $parts[0];
                }
            }

            // Bypass domain check for local development environments and root domain
            // Note: 'schooldemo' removed from local domains as it's a production subdomain
            $localDomains = ['localhost', '127.0.0.1', 'donbosco'];
            $isLocalDomain = in_array($db_name, $localDomains) || in_array($fullHost, $localDomains);
            
            // Skip dynamic database connection for admin, root domain, and local development domains
            // Note: 'schooldemo' removed from skip list as it's a production subdomain that needs its own database
            $skipDbDomains = ['adminschool', 'localhost', '127.0.0.1', 'donbosco'];
            $hasDots = strpos($db_name, '.') !== false;
            
            // Check if we have a subdomain and it's not in the bypass list
            $hasSubdomain = !$isRootDomain && ($fullHost !== $rootDomain && $db_name !== $fullHost && !empty($db_name));
            $isSchoolActive = null;
            
            if($hasSubdomain && $db_name!='donbosco' && !$isLocalDomain){
                $currentDb = DB::connection('mysql')->getDatabaseName();
                Config::set('database.connections.mysql.database',$currentDb);
                $isSchoolActive = SmSchool::on('mysql')->where('domain', $db_name)->where('active_status', 1)->first();
                if(!$isSchoolActive){
                    // Check if school exists but is inactive
                    $schoolExists = SmSchool::on('mysql')->where('domain', $db_name)->first();
                    if($schoolExists){
                        $errorMessage = "This domain (".$db_name.") is currently deactivated. The school exists but active_status is ".$schoolExists->active_status.". Please activate it in the database or contact support for assistance.";
                    } else {
                        $errorMessage = "This domain (".$db_name.") is not registered. No school found with domain '".$db_name."'. Please create a school record or contact support for assistance.";
                    }
                    die($errorMessage);
                }
            }
            
            // Set up dynamic database connection for subdomains that have active schools
            // This includes 'schooldemo' and other production subdomains
            if($isSchoolActive || (!in_array($db_name, $skipDbDomains) && $db_name!='' && !$hasDots && !$isLocalDomain && !$isRootDomain)){
                // Set the dynamic database connection
                Config::set('database.connections.second_db.database', $db_name);
                $dynamicConnectionName = 'second_db';
                DB::setDefaultConnection($dynamicConnectionName);
                DB::connection()->getPdo();
            }
            return $next($request);
            
            
        } catch (\Exception $e) {
            die("Could not connect to the database. Error: " . $e->getMessage());
        }                
    }
}

