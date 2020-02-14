<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class geologin extends Model
{
    protected $fillable=['mobile_no','password'];
    protected $hidden=['password','remember_Token'];
}
