<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Follow;
use App\Models\Post;

class User extends Model
{
    use HasFactory;

    /**
     * ユーザーの投稿を取得する
     */
    public function posts()
    {
        return Post::where('user', $this->id)
            ->where('is_deleted',false)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * ユーザーがフォローしているユーザーのリストを取得する
     */
    public function followUsers()
    {
        $followUsers = Follow::where('user', $this->id)->get();
        $result = [];
        foreach ($followUsers as $followUser) {
            array_push($result, $followUser->followUser());
        }
        return $result;
    }

      /**
     * ユーザーがブロックしているユーザーのリストを所得する
     */
    public function blockUser()
    {
        return User::find($this->block_user);
    }  

     
    /**
     * ユーザーをフォローしているユーザーのリストを取得する
     */
    public function followerUsers()
    {
        $followerUsers = Follow::where('follow_user', $this->id)->get();
        $result = [];
        foreach ($followerUsers as $followUser) {
            array_push($result, $followUser->followerUser());
        }
        return $result;
    }

    /**
     * ユーザーをブロックしているユーザーのリストを取得する
     */
    public function blockUsers()
    {
        $blockUsers = Block::where('block', $this->id)->get();
        $result = [];
        foreach ($blockUsers as $blockUser) {
            array_push($result, $blockUser->blockUsers());
        }
        return $result;
    }


    /**
     * $idのユーザーがこのユーザーをフォローしているか判定する
     */
    public function isFollowed($id)
    {
        foreach ($this->followUsers() as $followUser) {
            if ($followUser->id == $id) {
                return true;
            }
        }

        return false;
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
     * $idのユーザーをフォローする
     */
    public function follow($id)
    {
        $follow = new Follow;
        $follow->user = $this->id;
        $follow->follow_user = $id;
        $follow->save();
    }

    /**
     * $idのユーザーをフォロー解除する
     */
    public function unfollow($id)
    {
        Follow::where('user', $this->id)
            ->where('follow_user', $id)
            ->first()
            ->delete();
    }

       /**
     * $idのユーザーをブロックする
     */
    public function block($id)
    {
        $block = new Block;
        $block->user = $this->id;
        $block->block_user = $id;
        $block->save();
    }

        /**
     * $idのユーザーをブロック解除する
     */
    public function unblock($id)
    {
        Block::where('user', $this->id)
            ->where('block_user', $id)
            ->first()
            ->delete();
    }


 }
