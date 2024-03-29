<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use Validator;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        // ログインしていなかったらログインページに遷移する（この処理を消すとログインしなくてもページを表示する）
        $this->middleware('auth');
    }
    public function show($user_id)
    {
        $user = User::where('id', $user_id)
            ->firstOrFail();
            
         // テンプレート「user/show.blade.php」を表示します。
        return view('user/show', ['user' => $user]);
    }
    public function edit()
    {
        $user = Auth::user();
            
         // テンプレート「user/edit.blade.php」を表示します。
        return view('user/edit', ['user' => $user]);
    }
    public function update(Request $request)
    {
        //バリデーション（入力値チェック）
        $validator = Validator::make($request->all() , [
            'user_name' => 'required|string|max:255',
            'user_password' => 'required|string|min:6|confirmed',
            ]);

        //バリデーションの結果がエラーの場合
        if ($validator->fails())
        {
          return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        
        $user = User::find($request->id);
        $user->name = $request->user_name;
        if ($request->user_profile_photo !=null) {
            $request->user_profile_photo->storeAs('public/user_images', $user->id . '.jpg');
            $user->photo_filename = $user->id . '.jpg';
        }
        $user->password = bcrypt($request->user_password);
        $user->save();

        return redirect('/users/'.$request->id);
    }
}
