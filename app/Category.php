<?php

namespace App;

use App\Post;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false; //set time to false
    protected $fillables = [
        'title', 'image', 'category_status'
    ];
    protected $primaryKey = 'id';
    protected $table = 'categories';

    public function posts(){
        return $this->hasMany('App\Post');
    }
}
