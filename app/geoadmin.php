<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class geoadmin extends Model
{
    protected $fillable=['username','password'];
    protected $hidden=['password','remember_Token'];
   protected $table= 'geoadmin';
}
