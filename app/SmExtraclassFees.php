<?php
namespace App;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\StatusAcademicSchoolScope;
use DB;

class SmExtraclassFees extends Model
{
    protected $guarded = ['id'];    

    public static function feespaidSum($student_id, $perpose, $record_id)
    {
        try {
            $sum = SmExtraCurricularFeesPayment::where('active_status',1)
                ->where('student_id', $student_id)
                ->where('extra_curricular_record_id', $record_id)
                ->sum($perpose);

            return $sum;
        } catch (\Exception $e) {
            $data=[];
            return $data;
        }
    }

    public static function extraFeesPayable($class_id,$extra_class_id)
    {
        try {
            $sum = SmExtraCurricularFeesSettings::where('active_status',1)
                ->where('class_id', $class_id)
                ->where('extra_class_id', $extra_class_id)
                ->sum('fees_amount');
            return $sum;
        } catch (\Exception $e) {
            $data=[];
            return $data;
        }
    }

    public function feesExtraClass(){
        return $this->belongsTo('App\SmExtraCurricularClass', 'extra_class_id', 'id');
    }

    public static function feesPayment($student_id, $record_id){
        try {
            $payments = SmExtraCurricularFeesPayment::where('active_status',1)
                        ->where('student_id', $student_id)
                        ->where('extra_curricular_record_id', $record_id)
                        ->get();
            return $payments;
        } catch (\Exception $e) {
            $data=[];
            return $data;
        }
    }

    public static function studentClass($student_id)
    {
        $studentClass = SmClass::where('sm_classes.active_status',1)
                    ->leftjoin('student_records','student_records.class_id','sm_classes.id')
                        ->where('student_records.student_id', $student_id)
                        ->where('sm_classes.active_status',1)
                        ->where('student_records.active_status',1)
                        ->first();
        return $studentClass;
    }
}
