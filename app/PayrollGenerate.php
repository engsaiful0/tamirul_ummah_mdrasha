<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PayrollGenerate extends Model
{
    use HasFactory;
    protected $table = "payroll_generate";
    protected $casts = [
    'created_at' => 'datetime',
        // other casts
    ];

}
