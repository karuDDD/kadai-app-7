<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Block extends Model
{
    use HasFactory;

       /**
     * ブロックしている側のユーザーを取得する
     */
    public function blockUsers()
    {
        return User::find($this->block_user);
    }   


     /**
     * ユーザーがブロックしているユーザーのリストを取得する
     */
    public function blocked()
    {
        $blockUsers = Follow::where('block', $this->id)->get();
        $result = [];
        foreach ($blockUsers as $blockUser) {
            array_push($result, $blockUser->blockUser());
        }
        return $result;
    }




   
}     