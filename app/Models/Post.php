<?php

namespace App\Models;

use App\Models\User;
use App\Models\BlockUser;
use App\Models\ReportPost;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'user_id'
    ];
    public function likedBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }
    public function user()
    //forign key in the post table, local key in the user table
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function reported()
    {
        return $this->hasMany(ReportPost::class);
    }


 
}
