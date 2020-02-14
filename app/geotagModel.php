<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class geotagModel extends Model
{
    protected $fillable = [
        'title', 'description','upload_image','upload_video','tag_keyword'];
    protected $table='geotag';
}
