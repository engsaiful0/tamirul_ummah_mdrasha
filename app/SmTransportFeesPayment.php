<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SmTransportFeesPayment extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    public function studentInfo()
    {
        return $this->belongsTo('App\SmStudent', 'student_id', 'id');
    }

    // public function recordDetail()
    // {
    //     return $this->belongsTo('App\Models\StudentExtraCurricularRecord', 'extra_curricular_record_id', 'id');
    // }
    public function recordDetail()
    {
        return $this->belongsTo('App\Models\StudentRecord', 'record_id', 'id');
    }
}
