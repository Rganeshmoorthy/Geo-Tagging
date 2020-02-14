<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class geooo extends Model
{
  protected $fillable=['hoursid','hoursstatus','status'];
  protected $table= 'hours';
}
