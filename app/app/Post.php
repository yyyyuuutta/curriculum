<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['status', 'amount', 'image', 'title', 'memo', 'date', 'del_flg', 'user_id', 'spam_id'];
    
    protected $table = 'posts';

    protected $attributes = [
        'spam_id' => 0, // デフォルト値
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function jobask()
    {
        return $this->belongsTo('App\Jobask');
    }
    
    public function spam()
    {
        return $this->hasMany('App\Spam');
    }

    public function likes(){
        return $this->hasMany('App\Like');
    }
}
