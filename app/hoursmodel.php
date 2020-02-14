<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hoursmodel extends Model
{
    
  protected $fillable=['hoursid','hoursstatus','status'];
  protected $table= 'hours';
}
