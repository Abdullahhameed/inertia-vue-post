<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Post::class);
        sleep(3);
        $posts = PostResource::collection(Post::all());
        return Inertia('Posts/Index', compact('posts'));
    }

    public function create()
    {
        $this->authorize('create', Post::class);
        return inertia('Posts/Create');
    }

    public function store(StorePostRequest $request)
    {
        $this->authorize('create', Post::class);
        // sleep(3);
        Post::create($request->validated());

        return redirect()->route('posts.index')->with('message', 'Data saved Successfully');
    }

    public function edit(Post $post)
    {
        $this->authorize('create', Post::class);
        // $post = new PostResource($post);

        return inertia('Posts/Edit', compact('post'));
    }

    public function update(StorePostRequest $request, Post $post)
    {
        $this->authorize('create', Post::class);
        $post->update($request->validated());

        return redirect()->route('posts.index')->with('message', 'Data updated Successfully');
    }

    public function destroy(Post $post)
    {
        $this->authorize('create', Post::class);
        $post->delete();

        return redirect()->route('posts.index')->with('message', 'Data deleted Successfully');
    }
}
