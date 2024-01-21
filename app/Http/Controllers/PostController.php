<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use App\Http\Resources\PostDetailResource;
use Illuminate\Http\Client\ResponseSequence;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::with('writer:id,username')->get();

        return PostDetailResource::collection($post);
    }

    public function show($id)
    {
        $post = Post::with('writer:id,username')->findOrFail($id);

        // return response()->json(['data' => $post]);

        return new PostDetailResource($post);
    }

    public function show2($id)
    {
        $post = Post::findOrFail($id);

        return new PostDetailResource($post);
    }


    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title'         => 'required|max:130',
            'news_content'  => 'required',
        ]);

        $validateData['author']  = Auth::user()->id;

        $post = Post::create($validateData);

        return new PostDetailResource($post->loadMissing('writer:id,username'));
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'title'         => 'required|max:130',
            'news_content'  => 'required',
        ]);

        $post = Post::findOrFail($id);
        $post->update($validateData);

        return new PostDetailResource($post->loadMissing('writer:id,username'));
    }

    public function destroy($id)
    {
        $post = Post::with('writer:id,username')->findOrFail($id);
        $post->delete();

        return new PostDetailResource($post);
    }
}
