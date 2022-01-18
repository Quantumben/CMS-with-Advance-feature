<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(Post $post)
    {

       return view('blog.show')->with('post', $post);

    }

    public function category(Category $category)
    {
        $search = request()->query('search');

        if($search){
            $posts = $category->posts()->where('title', 'LIKE', '%{$search}%')->simplePaginate(3);
          }else{
              $posts = $category->posts()->simplePaginate(3);
          }


        return view('blog.category')
        ->with('category', $category)
        ->with('posts', $posts)
        ->with('categories', Category::all())
        ->with('tags', Tag::all());
        // ->with('tag', Tag::all()));
    }

    public function tag(Tag $tag)
    {
        return view('blog.tag')
        ->with('tag', $tag)
        ->with('categories', Category::all())
        ->with('tags', Tag::all())
        ->with('posts', $tag->posts()->simplePaginate(3));  
    }
}
