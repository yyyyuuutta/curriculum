<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    //ログイン後のメインページ
    public function AdminPage(Request $request)
    {
        //管理者
        $users = User::where('role', '!=', 0)->get();

        $posts = Post::withCount('spam')->orderBy('spam_count', 'desc')->take(10)->get();

        // dd($posts);
        // $user = Auth::User();

        // dd($users);
        //var_dump($user);
        return view('admin', [
            'users' => $users,
            'posts' => $posts,
        ]);
    }

}

