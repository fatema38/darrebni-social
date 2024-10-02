<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostsWithRatingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'user_id' => 1,
                'title' => 'عنوان البوست الاول',
                'content' => 'محتوى البوست الاول',
            ],
            [
                'user_id' => 2,
                'title' => 'عنوان البوست الثاني',
                'content' => 'محتوى البوست الثاني',
            ],
        ] ;


        foreach ($posts as $post)
        {

            $newPost = Post::create($post);

            $newPost->usersRatings()->attach([
                1 => ['type' => 'upVote'],
                2 => ['type' => 'upVote'],
                3 => ['type' => 'upVote'],
                4 => ['type' => 'upVote'],
            ]);
        }
    }
}
