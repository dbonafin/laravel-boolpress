<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Http\Controllers\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Check the validations for the form
        $request->validate($this->getValidations());
        // Get all the infos from the form
        $form_data = $request->all();
        // Create a new post
        $new_post = new Post();
        // Fill it with the form-infos
        $new_post->fill($form_data);
        $new_post->slug = $this->getSlug($new_post->title);
        // Save the new post
        $new_post->save();

        return redirect()->route('admin.posts.show', ['post' => $new_post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getValidations() {
        return [
            'title' => 'required | max: 500',
            'content' => 'required | max: 20000',
        ];
    }

    public function getSlug($title) {
        // Calc the slug from the title
        $slug_verified = Str::slug($title, '-'); 
        $skeleton_slug = $slug_verified;

        // Check if the slug is already taken
        $taken_slug = Post::where('slug', '=', $slug_verified)->first();

        $counter = 1;
        while($taken_slug) {
            // Create the new slug
            $slug_verified = $skeleton_slug . '-' . $counter;

            // Another check if the slug is already taken
            $taken_slug = Post::where('slug', '=', $slug_verified)->first();
            $counter++;
        }
        return $slug_verified;
    }
}
