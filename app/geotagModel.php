<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class geotagModel extends Model
{
    protected $fillable = [
        'user_id','title', 'description','upload_image','upload_video','tag_keyword','hours'];
    protected $table='geotag';
}
