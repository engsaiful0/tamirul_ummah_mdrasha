<?php

namespace App;

use App\Models\StudentExtraCurricularRecord;
use App\Scopes\GlobalAcademicScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\StatusAcademicSchoolScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SmExtraCurricularClass extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new StatusAcademicSchoolScope);
        static::addGlobalScope(new GlobalAcademicScope);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function records()
    {
        return $this->hasMany(StudentExtraCurricularRecord::class, 'extra_class_id', 'id')->where('is_promote', 0)->whereHas('student');
    }

    // public function students()
    // {
    //     return $this->hasMany('App\SmStudent', 'user_id', 'id');
    // }

    public function academic()
    {
        return $this->belongsTo('App\SmAcademicYear', 'academic_id', 'id')->withDefault();
    }
}