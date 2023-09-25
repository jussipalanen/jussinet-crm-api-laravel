<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    private $validation = [
        'name' => ['required', 'max:255'],
        'featured_image' => ['nullable', 'max:2000', 'mimes:jpeg,jpg,png,gif'],
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $limit = isset($_GET['limit']) && is_numeric($_GET['limit']) ? intval( $_GET['limit'] ) : 10;
        $posts = Post::paginate($limit);
        if( isset($_GET['s']) && $_GET['s'] )
        {
            $search = trim($_GET['s']);
            $posts = Post::where('name', 'LIKE', '%' . $search . '%')->paginate($limit);
        }
        return view('pages.posts.list', [
            'posts' => $posts,
            'limit' => $limit,
            's' => isset($_GET['s']) ? trim(($_GET['s'])) : '',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.posts.form', [
            'form_title' => 'Create post',
            'mode' => 'create',
            'url' => url('/posts/create'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        # Check validation, or return the error messages
        $request->validate($this->validation);

        # Move the featured image to public resource directory
        $featured_image = null;
        if( $request->file('featured_image') )
        {
            $featured_image = $request->file('featured_image')->storePublicly('posts') ?: null;
        }

        Post::create([
            'name' => $request->name ?: 'null',
            'content' => $request->content ?: null,
            'featured_image' => $featured_image ?: null,
            'show' => (bool) $request->show !== false ? true : false,
        ]);

        return redirect('/posts/create')->with([
            'success' => 'Post has been created successfully into the database.',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $post = Post::whereId($id)->firstOrFail();
        return view('pages.posts.form', [
            'form_title' => 'Edit post',
            'post' => $post, 
            'mode' => 'edit',
            'url' => url('/posts/edit', ['id' => $post->id]),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        # Check validation, or return the error messages
        $request->validate($this->validation);

        # Move the featured image to public resource directory
        $featured_image = isset( $request->uploaded_featured_image ) ? $request->uploaded_featured_image : null;
        if( $request->file('featured_image') )
        {
            $featured_image = $request->file('featured_image')->storePublicly('posts') ?: null;
        }

        Post::whereId($id)->update([
            'name' => $request->name ?: 'null',
            'content' => $request->content ?: null,
            'featured_image' => $featured_image ?: null,
            'show' => (bool) $request->show !== false ? true : false,
        ]);

        $url = url('/posts/edit', ['id' => $request->id]);
        return redirect($url)->with([
            'success' => 'Post has been updated successfully into the database.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('/posts')->withSuccess(__('Post deleted successfully.'));
    }
}
