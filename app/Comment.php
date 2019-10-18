<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'comment',
        'reply_to_comment_id',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function replies(){
        return $this->hasMany('App\Comment','reply_to_comment_id');
    }
}
