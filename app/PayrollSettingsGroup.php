<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PayrollSettingsGroup extends Model
{
    use HasFactory;
    protected $table = "payroll_settings_group";
    
}
