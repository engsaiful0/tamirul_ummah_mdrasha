<?php

namespace App;

use App\Models\StudentRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SmExamAttendanceChild extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function studentInfo()
    {
        return $this->belongsTo('App\SmStudent', 'student_id', 'id')->with('class', 'section');
    }
    public function studentRecord()
    {
        return $this->belongsTo(StudentRecord::class, 'student_record_id', 'id');
    }

    public function studentClass()
    {
        return $this->belongsTo('App\SmClass', 'class_id', 'id')->withDefault()->withoutGlobalScope(StatusAcademicSchoolScope::class);
    }

    public function studentSection()
    {
        if(moduleStatusCheck('University')){
            return $this->belongsTo('App\SmSection', 'un_section_id', 'id')->withDefault()->withoutGlobalScope(StatusAcademicSchoolScope::class);
        }else{
            return $this->belongsTo('App\SmSection', 'section_id', 'id')->withDefault()->withoutGlobalScope(StatusAcademicSchoolScope::class);
        }

    }
}
