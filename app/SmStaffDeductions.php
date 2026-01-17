<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Modules\RolePermission\Entities\InfixPermissionAssign;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class SmStaffDeductions extends Model
{
    //
    use HasFactory;
    protected $guarded = ['id'];

    public static function getDeductions($staff_id, $payroll_month, $payroll_year)
    {
        try {
            $month = date('m', strtotime($payroll_month));
           
            $earnings_amount = SmStaffDeductions::where('staff_id', $staff_id)->where('updated_at', 'like', $payroll_year . '-' . $month . '%')->where('school_id', Auth::user()->school_id)->where('active_status',1)->first();

            return $earnings_amount;
        } catch (\Exception $e) {
            $data=[];
            return $data;
        }
    }
}
