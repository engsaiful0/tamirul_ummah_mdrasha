<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Modules\RolePermission\Entities\InfixPermissionAssign;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PayrollSettingsDeduction extends Model
{
    //
    use HasFactory;
    protected $guarded = ['id'];
}
