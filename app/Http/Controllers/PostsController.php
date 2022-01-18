<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('verifyCategoryCount')->only(['create','store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Post.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create')->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        //upload the image
        $image = $request->image->store('posts');

        //create the post
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $image,
            'published_at' => $request->published_at,
            'category_id' => $request->category,
            'user_id' => auth()->user()->id
        ]);

        if($request->tags)
        {
            $post->tags()->attach($request->tags);
        }
        //flash message
        session()->flash('success', 'Post created successfully' );
        //redirect
        return redirect(route('post.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('Post.create')->with('post', $post)->with('categories', Category::all())->with('tags', Tag::all());

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->only(['title', 'description', 'published_at','content']);
        //check if new image
        if($request->hasFile('image')){
            //upload it
            $image = $request->image->store('posts');

            //delete the old image
            // Storage::delete($post->image);
            $post->deleteImage();

            $data['image'] = $image;

        }

        if($request->tags)
        {
            $post->tags()->sync($request->tags);
        }

        //update attribute
        $post->update($data);

        //flash msg
        session()->flash('success', 'Post updated successfully');

        //redirect user
        return redirect(route('post.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        if($post->trashed())
        {
            //Storage::delete($post->image);
            $post->deleteImage();

            $post->forceDelete();

        }else{

            $post->delete();
        }

         //flash message
         session()->flash('success', 'Post deleted successfully' );

          //redirect
        return redirect(route('post.index'));
    }

    public function trashed()
    {
        $trashed = Post::onlyTrashed()->get();

        return view('Post.index')->with('posts', $trashed);
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id',$id)->firstOrFail();

        $post->restore();

         //flash message
         session()->flash('success', 'Post restored successfully' );

          //redirect
        return redirect()->back();
    }
}
