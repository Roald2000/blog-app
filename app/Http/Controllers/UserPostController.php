<?php

namespace App\Http\Controllers;

use App\Models\UserPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPostController extends Controller
{
    //

    public function myPosts()
    {
        // $posts =  UserPost::orderBy('created_at', 'desc')->get();
        $posts = Userpost::where(['user_id' => auth()->user()->id])->orderBy('created_at', 'desc')->get();
        return view('posts.my-post', compact('posts'));
    }

    public function edit($id)
    {
        if (Auth::check()) {
            $data = UserPost::find($id);

            if (!$data) {
                // return view('posts.no-post-edit', ['message' => "The post does not exist"]);
                return redirect(route('welcome'));
            }

            if (auth()->user()->id !== $data->user_id) {
                // return view('posts.no-post-edit', ['message' => "You are not the owner of the post"]);
                return redirect(route('welcome'));
            }
            return view('posts.edit-post', ['item' => $data]);
        } else {
            return redirect(route('auth.logout-user'));
        }
    }

    public function saveEdit(Request $request, $id)
    {
        if (Auth::check()) {
            $user_id = auth()->user()->id;

            $request->validate([
                'content' => 'required'
            ]);

            $post = UserPost::find($id);

            if (!$post) {
                return view('posts.no-post-edit', ['message' => "The post does not exist"]);
            }

            $data = [
                'content' => strip_tags($request->content)
            ];

            if ($post->user->id = $user_id) {
                $post->update($data);
                return redirect(route('welcome'));
            }
        } else {
            return redirect(route('auth.logout-user'));
        }
    }

    public function createPost(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'content' => 'required'
            ]);

            $postData = [
                'content' => strip_tags($request->content),
                'user_id' => auth()->user()->id
            ];
            UserPost::create($postData);
            return redirect(route('welcome'));
        } else {
            return redirect(route('auth.logout-user'));
        }
    }

    public function deletePost($id)
    {
        if (Auth::check()) {
            $data = UserPost::findOrFail($id);
            if ($data->user_id == auth()->user()->id) {
                $data->delete();
                return redirect(route('welcome'));
            }
            return redirect(route('welcome'));
        } else {
            return redirect(route('auth.logout-user'));
        }
    }
}
