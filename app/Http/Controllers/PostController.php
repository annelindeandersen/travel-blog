<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Get all posts
     *
     */
    public function getposts(Request $request): \Illuminate\Http\JsonResponse
    {
        $posts = Post::all();

        return response()->json($posts);
    }

    /**
     * Get selected post
     *
     */
    public function getpost(Request $request): \Illuminate\Http\JsonResponse
    {
        $id = $request->id;
        $post = Post::where('id', $id)->get();

        return response()->json($post);
    }

    /**
     * Create new post
     *
     */
    public function createpost(Request $request): \Illuminate\Http\JsonResponse
    {
        $post = Post::create([
            'title' => $request->title,
            'text' => $request->text,
            'hero' => $request->hero,
            'image' => $request->image,
            'published' => false
        ]);
        $post->save();

        return response()->json([
            'message' => 'New post created',
            'post' => $post
        ]);
    }

    // delete post

    // update post
}
