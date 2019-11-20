<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    // ==========ここから追加する==========
    //コンストラクタ （このクラスが呼ばれると最初にこの処理をする）
    public function __construct()
    {
        // ログインしていなかったらログインページに遷移する（この処理を消すとログインしなくてもページを表示する）
        $this->middleware('auth');
    }
    // ==========ここまで追加する==========
        
    public function index()
    {
        // テンプレート「post/index.blade.php」を表示します。
        return view('post/index');
    }
  .
  .
  .
}