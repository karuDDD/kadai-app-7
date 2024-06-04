<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller,
    Session;
use App\Models\User;

class BlockController extends Controller
{
    /**
     * ブロック画面処理
     * 
     */
    public function update(Request $request, $id)
    {
        // idからユーザーを取得
        $user = User::find($id);

        // ユーザーが存在するか判定
          if ($user == null) {
            return dd('存在しないユーザーです');
        }

        // セッションにログイン情報があるか確認
        if (!Session::exists('user')) {
            return redirect('/user/');
        }
        // ログイン中のユーザーの情報を取得する
          $loginUser = Session::get('user');

          if ($request->isBlock) {
            // ブロック処理
            $loginUser->block($id);
        } else {
            // ブロック解除処理
            $loginUser->unblock($id);
        }

        // 画面表示
        return redirect('/user/' . $user->id);
    }

}