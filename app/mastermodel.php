<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mastermodel extends Model
{
    
  protected $fillable=['id','value','status'];
  protected $table= 'master';
}
