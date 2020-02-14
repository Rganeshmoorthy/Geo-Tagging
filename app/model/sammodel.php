<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class sammodel extends Model
{
    protected $fillable=['id','name','email'];
    public $table='sam';
}
