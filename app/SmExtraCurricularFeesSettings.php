<?php
namespace App;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\StatusAcademicSchoolScope;
use DB;

class SmExtraCurricularFeesSettings extends Model
{
    protected $guarded = ['id'];    
}
