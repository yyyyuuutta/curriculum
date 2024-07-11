<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Joboffer extends Model
{
    // use HasFactory;

    protected $fillable = [
        'user_id', 'post_id', 'tel', 'email', 'title', 'deadline', 'amount','memo'
    ];

    protected $table = 'joboffer'; // テーブル名を指定する

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
