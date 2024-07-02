<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Follow extends Model
{
    use HasFactory;

    /**
     * フォローしている側のユーザーを取得する
     */
    public function followUsers()
    {
        
        return User::find($this->follow_user);
    }

    /**
     * フォローされている側のユーザーを取得する
     */
    public function followerUsers()
    {
        return User::find($this->user);
    }
}
