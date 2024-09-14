<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class TestController extends Controller
{
    public function test(){
        // usersテーブルに入っているレコードをすべて取得
        $users = User::all();
        // resoursesのviewsにあるtest.blade.phpを表示
        return view('test',compact('users'));
    }
}
