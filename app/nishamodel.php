<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nishamodel extends Model
{
    protected $fillable=['name','email','phno'];
    protected $table='nisha';
}
