<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commercials extends Model
{
    protected $fillable = [
        'image','image_tag','title','link','text', 'show'
    ];
    public $timestamps = true;
}
