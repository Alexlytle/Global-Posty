<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlockUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'block_user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'block_user_id');
    }

    public function userinfo($user_id)
    {
        return User::find($user_id);
    }

  
}
