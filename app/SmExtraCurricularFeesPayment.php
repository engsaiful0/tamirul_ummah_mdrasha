<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\DirectFeesInstallmentAssign;
use App\Models\DireFeesInstallmentChildPayment;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SmExtraCurricularFeesPayment extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    public function studentInfo()
    {
        return $this->belongsTo('App\SmStudent', 'student_id', 'id');
    }

    public function recordDetail()
    {
        return $this->belongsTo('App\Models\StudentExtraCurricularRecord', 'extra_curricular_record_id', 'id');
    }

    public function feesInstallment()
    {
            if(moduleStatusCheck('University')){
                return $this->belongsTo('Modules\University\Entities\UnFeesInstallmentAssign', 'un_fees_installment_id', 'id');
            }
            else{
                return $this->belongsTo(DirectFeesInstallmentAssign::class, 'direct_fees_installment_assign_id', 'id');
            }
    }
    
    public function installmentPayment()
    {
            if(moduleStatusCheck('University')){
                return $this->belongsTo('Modules\University\Entities\UnFeesInstallAssignChildPayment', 'installment_payment_id', 'id');
            }
            else{
                return $this->belongsTo(DireFeesInstallmentChildPayment::class, 'installment_payment_id', 'id');
            }
    }
        
}
