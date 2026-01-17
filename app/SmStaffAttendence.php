<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SmStaffAttendence extends Model
{
    use HasFactory;
    protected $table = "sm_staff_attendences";

    public function StaffInfo()
    {
        return $this->belongsTo('App\SmStaff', 'staff_id', 'id');
    }

    public static function getAttendence($staff_id, $payroll_month, $payroll_year)
    {
        try {
            $month = date('m', strtotime($payroll_month));
           
            $attendances = SmStaffAttendence::where('staff_id', $staff_id)->where('attendence_date', 'like', $payroll_year . '-' . $month . '%')->where('school_id', Auth::user()->school_id)->count();

            return $attendances;
        } catch (\Exception $e) {
            $data=[];
            return $data;
        }
    }
}
