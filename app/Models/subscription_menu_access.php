<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class subscription_menu_access extends Model
{
    use HasFactory;
    public static function getplan($plan_id)
    {
        try {
            $plan = DB::table('subscription_plan')
            ->where('active_status',1)
            ->where('id', $plan_id)
            ->first();
            return $plan;
        } catch (\Exception $e) {
            $data=[];
            return $data;
        }
    }
}
