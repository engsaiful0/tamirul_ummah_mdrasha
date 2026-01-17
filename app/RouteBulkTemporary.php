<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RouteBulkTemporary extends Model
{
    protected $fillable  = ['route_name', 'fare'];
}