<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Category;
use App\Post;
use App\Tag;

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

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
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

        // Get the selected tags
        if (isset($form_data['tags'])) {
            $new_post->tags()->sync($form_data['tags']);
        }

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
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
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
        // Check the validations for the form
        $request->validate($this->getValidations());

        // Get all the infos from the form
        $form_data = $request->all();
        $edited_post = Post::findOrFail($id);

        // Calc the new slug
        if ($form_data['title'] !== $edited_post->title) {
            $form_data['slug'] = $this->getSlug($edited_post->title);
        } else {
            $form_data['slug'] = $edited_post->slug;
        }

        // Get the selected tags
        if (isset($form_data['tags'])) {
            $edited_post->tags()->sync($form_data['tags']);
        } else {
            $edited_post->tags()->sync([]);
        }
        
        // Save the changes in the edited post
        $edited_post->update($form_data);
         
        return redirect()->route('admin.posts.show', ['post' => $edited_post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted_post = Post::findOrFail($id);
        $deleted_post->delete();

        return redirect()->route('admin.posts.index');
    }

    public function getValidations() {
        return [
            'title' => 'required | max: 500',
            'content' => 'required | max: 20000',
            'category_id' => 'nullable | exists:categories,id',
            'tags' => 'nullable | exists:tags,id' 
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
