<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category1 = Category::create([
            'name' => 'News'
        ]);
        $category2 = Category::create([
            'name' => 'Marketing'
        ]);
        $category3 = Category::create([
            'name' => 'Partnership'
        ]);
        $category4 = Category::create([
            'name' => 'Partnership'
        ]);


        $author1 = User::create([
            'name' => 'Benedict Goodluck',
            'email' => 'cms.learn44@gmail.com',
            'password' => Hash::make('goodluck')
        ]);

        $author2 = User::create([
            'name' => 'Glorious Godwin',
            'email' => 'cms.learn1@gmail.com',
            'password' => Hash::make('goodluck')
        ]);

        $author3 = User::create([
            'name' => 'Theoplilus',
            'email' => 'cms.learn3@gmail.com',
            'password' => Hash::make('goodluck')
        ]);

        $author4 = User::create([
            'name' => 'Benedict',
            'email' => 'cms.learn4@gmail.com',
            'password' => Hash::make('goodluck')
        ]);

        // $post1 = Post::create([
        //     'title' => 'We relocated our office to a new designed garage',
        //     'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam reiciendis porro optio eos repudiandae vero velit voluptatibus atque reprehenderit doloremque eius nisi esse officiis, accusamus magnam, molestias alias dignissimos consequatur!',
        //     'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod ullam ducimus, commodi reprehenderit eos illo corrupti inventore natus vero beatae aliquam consequatur dolores consequuntur eaque porro harum sapiente, praesentium doloribus!',
        //     'category_id' => $category1->id,
        //     'image' => 'posts/1.jpg'
        // ]);

        $post1 = $author1->posts()->create([
            'title' => 'We relocated our office to a new designed garage',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam reiciendis porro optio eos repudiandae vero velit voluptatibus atque reprehenderit doloremque eius nisi esse officiis, accusamus magnam, molestias alias dignissimos consequatur!',
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod ullam ducimus, commodi reprehenderit eos illo corrupti inventore natus vero beatae aliquam consequatur dolores consequuntur eaque porro harum sapiente, praesentium doloribus!',
            'category_id' => $category1->id,
            'image' => 'posts/1.jpg'
        ]);

        $post2 = $author2->posts()->create([
            'title' => 'Top 5 brillant content marketing strategies',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam reiciendis porro optio eos repudiandae vero velit voluptatibus atque reprehenderit doloremque eius nisi esse officiis, accusamus magnam, molestias alias dignissimos consequatur!',
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod ullam ducimus, commodi reprehenderit eos illo corrupti inventore natus vero beatae aliquam consequatur dolores consequuntur eaque porro harum sapiente, praesentium doloribus!',
            'category_id' => $category2->id,
            'image' => 'posts/2.jpg'
        ]);

        $post3 = $author1->posts()->create([
            'title' => 'Best practises for minimalist design with example',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam reiciendis porro optio eos repudiandae vero velit voluptatibus atque reprehenderit doloremque eius nisi esse officiis, accusamus magnam, molestias alias dignissimos consequatur!',
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod ullam ducimus, commodi reprehenderit eos illo corrupti inventore natus vero beatae aliquam consequatur dolores consequuntur eaque porro harum sapiente, praesentium doloribus!',
            'category_id' => $category3->id,
            'image' => 'posts/3.jpg'
        ]);

        $post4 = $author2->posts()->create([
            'title' => 'Congratulate and thank to Maryam for joining our team',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam reiciendis porro optio eos repudiandae vero velit voluptatibus atque reprehenderit doloremque eius nisi esse officiis, accusamus magnam, molestias alias dignissimos consequatur!',
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod ullam ducimus, commodi reprehenderit eos illo corrupti inventore natus vero beatae aliquam consequatur dolores consequuntur eaque porro harum sapiente, praesentium doloribus!',
            'category_id' => $category4->id,
            'image' => 'posts/4.jpg'
        ]);

         //Tags

         $tag1 = Tag::create([
            'name' => 'job'
        ]);
        $tag2 = Tag::create([
            'name' => 'customers'
        ]);
        $tag3 = Tag::create([
            'name' => 'record'
        ]);

        $post1->tags()->attach([$tag1->id, $tag2->id]);
        $post2->tags()->attach([$tag2->id, $tag3->id]);
        $post3->tags()->attach([$tag1->id, $tag3->id]);
    }
}
