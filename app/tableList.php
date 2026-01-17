<?php

namespace App;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class tableList extends Model
{
	public static function getTableList($colunm_name_id, $id)
	{
		
		try{
			// $db_name = env('DB_DATABASE', null);
			// $fullHost = $request->getHost();
			$fullUrl = url()->full();

	        // Extract the host from the full URL
	        $parsedUrl = parse_url($fullUrl);
	        $fullHost = $parsedUrl['host'] ?? '';
            // Get the root domain by removing the subdomain
            $rootDomain = config('app.domain');
            // Extract the subdomain from the full domain
            $subdomain = Str::replaceFirst($rootDomain, '', $fullHost);

            // Remove leading dot if present
            $db_name = trim($subdomain, '.');
            // return $db_name;
			$table_list = DB::select("SELECT TABLE_NAME 
			FROM INFORMATION_SCHEMA.COLUMNS
			WHERE COLUMN_NAME ='$colunm_name_id'
				AND TABLE_SCHEMA='$db_name'");
			$tables = '';

			foreach ($table_list as $row) {
				$data_test = DB::table($row->TABLE_NAME)->select('*')->where($colunm_name_id, $id)->when(Schema::hasColumn($row->TABLE_NAME, 'school_id'), function ($q){
                    $q->where('school_id', Auth::user()->school_id);
                })->first();
				if($data_test != ""){

					$name = str_replace('sm_', '', $row->TABLE_NAME);
					$name = str_replace('_', ' ', $name);
					$name = ucfirst($name);
					$tables .= $name . ', ';
				}
			}
			return $tables;
		}catch(\Exception $e){
            return null;
		}
	}


	public static function ONLY_TABLE_LIST($id)
	{
		try{
			// $db_name = env('DB_DATABASE', null);
			$fullUrl = url()->full();

	        // Extract the host from the full URL
	        $parsedUrl = parse_url($fullUrl);
	        $fullHost = $parsedUrl['host'] ?? '';
            // Get the root domain by removing the subdomain
            $rootDomain = config('app.domain');
            // Extract the subdomain from the full domain
            $subdomain = Str::replaceFirst($rootDomain, '', $fullHost);

            // Remove leading dot if present
            $db_name = trim($subdomain, '.');
			$table_list = DB::select("SELECT TABLE_NAME 
			FROM INFORMATION_SCHEMA.COLUMNS
			WHERE COLUMN_NAME ='$id'
				AND TABLE_SCHEMA='$db_name'");
			$tables = [];
			foreach ($table_list as $row) {
				$tables[] = $row->TABLE_NAME;
			}
			return $tables;

		}catch(\Exception $e){
            return [];
		}

	}
	
	public static function allTableList($column)
	{

		//this function not working 
		try {
			$fullUrl = url()->full();

	        // Extract the host from the full URL
	        $parsedUrl = parse_url($fullUrl);
	        $fullHost = $parsedUrl['host'] ?? '';
            // Get the root domain by removing the subdomain
            $rootDomain = config('app.domain');
            // Extract the subdomain from the full domain
            $subdomain = Str::replaceFirst($rootDomain, '', $fullHost);

            // Remove leading dot if present
            $db_name = trim($subdomain, '.');
            return $db_name;
            // return env('DB_DATABASE', null);
		} catch (\Exception $e) {
			return [];
		}

		$db_name = env('DB_DATABASE', null);
		$table_list = DB::select("SELECT TABLE_NAME 
		FROM INFORMATION_SCHEMA.COLUMNS
		WHERE COLUMN_NAME ='$column'
			AND TABLE_SCHEMA='$db_name'");
		$tables = [];
		foreach ($table_list as $row) {
			$tables[] = $row->TABLE_NAME;
		}
		return $tables;
	}
}