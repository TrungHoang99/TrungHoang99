<?php

namespace App;

use App\User;
use App\Comment;
use App\Category;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = false; //set time to false
    protected $fillables = [
        'title','user_id', 'content', 'image', 'summary', 'tag', 'category_id', 'post_status'
    ];
    protected $primaryKey = 'id';
    protected $table = 'posts';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approve', 1);
    }
}
