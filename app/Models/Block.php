<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Block extends Model
{
    use HasFactory;

    
       /**
     * ユーザーがブロックしている側のユーザーのリストを取得する
     */
    public function blockUser()
    {
      $blockUser =Block::where('user',$this->id)->get();
      $result = [];
      foreach($blockUsers as $blockUser){
        array_push($result,$blockUers->blockUser());
      }
      return $result;
    }   


     /**
     * ユーザーをブロックしているユーザーのリストを取得する
     */
    public function blockUsers()
    {
        $blockUsers = Block::where('block_user', $this->id)->get();
        $result = [];
        foreach ($blockUsers as $blockUser) {
            array_push($result, $blockUser->blockUsers());
        }
        return $result;
    }






   
}     