<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    protected $fillable = [
        'image','image_title','image_link','text','link','link_type','link_text','link_title','show'
    ];
    public $timestamps = true;
}
