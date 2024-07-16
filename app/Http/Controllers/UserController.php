<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller,
    Session;
use App\Models\User;

class UserController extends Controller
{
    /**
     * ユーザー画面遷移
     */
    public function show($id)
    {
        // セッションにログイン情報があるか確認
        if (!Session::exists('user')) {
            // ログインしていなければログインページへ
            return redirect('/login');
        }

        // 指定したIDのユーザー情報を取得する
        $user = User::find($id);

        // ユーザーが存在するか判定
        if ($user == null) {
            return dd('存在しないユーザーです');
        }

        // ユーザーの投稿を取得
        $posts = $user->posts();
        // フォロー/フォロワー数の取得
        $followCount = count($user->followUsers());
        $followerCount = count($user->followerUsers());

        // ログイン中のユーザーの情報を取得する
        $loginUser = Session::get('user');
        // 自分自身のユーザーページか判定
        $isOwnPage = $loginUser->id == $user->id;

        // フォロー済みかどうか判定
        $isFollowed = false;
        $isBlocked = false;
        if (!$isOwnPage) {
            $isFollowed = $loginUser->isFollowed($user->id);
            $isBlocked = $loginUser->isBlocked($user->id);
        }

        // 画面表示
        return view('user.index', compact('user', 'posts', 'followCount', 'followerCount', 'isOwnPage', 'isFollowed', 'isBlocked'));
    }

    /**
     * プロフィール編集画面遷移
     */
    public function edit($id)
    {
        $user = User::find($id);
        // ユーザーが存在するか判定
        if ($user == null) {
            return dd('存在しないユーザーです');
        }
        // セッションにログイン情報があるか確認
        if (!Session::exists('user')) {
            return redirect('/');
        }

        // ログイン中のユーザーの情報を取得する
        $loginUser = Session::get('user');
        // 自分自身のユーザーページか判定
        if ($loginUser->id != $user->id) {
            return redirect('/');
        }

        // 画面表示
        return view('user.edit', compact('user'));
    }

    /**
     * プロフィール編集処理
     */
    public function update(Request $request, $id)
    {
        // idからユーザーを取得
        $user = User::find($id);

        // 投稿が存在するか判定
        if ($user == null) {
            return dd('存在しないユーザーです');
        }
        // セッションにログイン情報があるか確認
        if (!Session::exists('user')) {
            return redirect('/');
        }

        // ログイン中のユーザーの情報を取得する
        $loginUser = Session::get('user');
        // 自分自身の投稿ページか判定
        if ($loginUser->id != $user->id) {
            return redirect('/');
        }

        // データ登録
        $user->name = $request->username;
        $user->biography = $request->biography;
        $user->save();

        // 画面表示
        return redirect('/user/' . $user->id);
    }





    /**
     * 新規登録画面遷移
     */
    public function create()
    {
        return view('user.signup');
    }

    /**
     * 新規登録処理
     */
    public function store(Request $request)
    {
        //TODO 登録処理
        $rules = [
            'name' => 'required',
            'email' => 'required|email:filter|unique:users',
            'password' => 'required|alpha_dash|min:8',
        ];
        $messages = ['required' => '入力内容が未入力です。', 'email' => '入力可能文字は半角英数、記号のみです。', 'alpha_dash' => '入力可能文字は半角英数、記号のみです。', 'min' => '8文字以上入力してください。,', 'unique' => 'このメールアドレスは既に使われています。,'];

        Validator::make($request->all(), $rules, $messages)->validate();

        $user = new User;

        $user->name = $request->input('name');

        $user->email = $request->input('email');

        $user->password = $request->input('password');

        $user->save();

        Session::put('user', $user);

        return redirect('/');
    }
}
