<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Modules\RolePermission\Entities\InfixPermissionAssign;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use DB;

class SmStaffEarnings extends Model
{
    //
    use HasFactory;
    protected $guarded = ['id'];

    public static function getEarnings($staff_id, $payroll_month, $payroll_year)
    {
        try {
            $month = date('m', strtotime($payroll_month));
            $earnings_amount = SmStaffEarnings::where('staff_id', $staff_id)->where('updated_at', 'like', $payroll_year . '-' . $month . '%')->where('school_id', Auth::user()->school_id)->where('active_status',1)->first();
            //->select('amount')
            return $earnings_amount;
        } catch (\Exception $e) {
            $data=[];
            return $data;
        }
    }
}
