<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'category_id','title','source','link','type_id','text','signature','show','date',
    ];
    public $timestamps = true;


    public function category()
    {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }

    public function type()
    {
        return $this->hasOne('App\Type', 'id', 'type_id');
    }

    public function materials()
    {
        return $this->hasMany('App\Materials', 'post_id', 'id')->orderBy('ordernumber', 'asc');
    }
}
