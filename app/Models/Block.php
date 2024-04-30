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
    public function blockUser()
    {
        return User::find($this->block_user);
    }   

     /**
     * ユーザーがブロックしているユーザーのリストを取得する
     */
    public function blockUsers()
    {
        $blockUsers = Follow::where('block', $this->id)->get();
        $result = [];
        foreach ($blockUsers as $blockUser) {
            array_push($result, $blockUser->blockUser());
        }
        return $result;
    }

       /**
     * $idのユーザーがこのユーザーをブロックしているか判定する
     */
    public function isBlocked($id)
    {
        foreach ($this->blockUsers() as $blockUser) {
            if ($blockUser->id == $id) {
                return true;
            }
        }

        return false;
    }

     /**
     * $idのユーザーをブロックする
     */
    public function block($id)
    {
        $block = new Block;
        $block->user = $this->id;
        $block->follow_user = $id;
        $block->save();
    }

        /**
     * $idのユーザーをブロック解除する
     */
    public function unblock($id)
    {
        Block::where('blocks', $this->id)
            ->where('block_user', $id)
            ->first()
            ->delete();
    }
}     