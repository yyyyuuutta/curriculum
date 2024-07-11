<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spam extends Model
{
    protected $fillable = ['report','user_id', 'post_id'];
    
    protected $table = 'spam';
}
