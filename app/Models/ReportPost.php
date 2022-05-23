<?php

namespace App\Models;

use App\Models\Post;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReportPost extends Model
{

    use HasFactory;

    protected $fillable = [
        'post_id',
        'email',
        'message',
        'reason',
        'user_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id','id');
    }
    public function post()
    {
        return $this->hasOne(Post::class,'id','user_id');
    }

    public function userinfo($user_id)
    {
        return User::find($user_id);
    }
}
