<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'image','title','text','post_link', 'show'
    ];
    public $timestamps = true;
}
