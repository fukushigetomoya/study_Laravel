<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Symfony\Contracts\Service\Attribute\Required;

class NewPostController extends Controller
{
    public function create(){

        return view('post.create');
    }

    public function store(Request $request){

        $validated = $request->validate([
            'title' => 'required|max:20',
            'body' => 'required|max:400',
            ]);
        
        $validated['user_id'] = $request->user()->id;

        Post::create($validated);
        return back()->with('message', '保存しました');
    }

    public function index(){
        // $posts = Post::with('user')->orderBy('created_at', 'desc')->get();
        $posts = Post::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('post.index', compact('posts'));
    }

    public function mypost(){
        $posts = Post::with('user')->where('user_id', request()->user()->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('post.mypost', compact('posts'));
    }

    public function show(Post $post){
        return view('post.show', compact('post'));
    }

    public function edit(Post $post){
        return view('post.edit', compact('post'));
    }

    public function update(Request $request, Post $post){
        $validated = $request->validate([
            'title' => 'required|max:20',
            'body' => 'required|max:400',
            ]);

        $validated['user_id'] = $request->user()->id;

        $post->update($validated);
        
        return redirect()->route('post.show', $post)->with('message', '更新しました');
    }

    public function destroy(Request $request, Post $post){
        $post->delete();
        return redirect()->route("post.mypost")->with('message','削除しました');
    }

}
