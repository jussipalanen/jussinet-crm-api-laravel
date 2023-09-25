<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Storage;

class PostApiController extends Controller
{

    /**
     * List all of the posts
     * 
     * This queries all of the posts from the table.
     */
    public function index()
    {

        /**
         *  @response AnonymousResourceCollection<PostResource>
         */
        return Post::all()->map(function ($post) {
            // Get the full url of the feature image
            $post->featured_image = url('/') . Storage::url('app/' . $post->featured_image);
            return $post;
        })->transform(function ($post) {
            # Show only the specific fields
            return $post->only([
                'id',
                'name',
                'content',
                'featured_image',
                'show'
            ]);
        });
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Post $post)
    {
        return $post;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
