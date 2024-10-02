<?php

namespace Database\Seeders;


use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
        public function run(): void
    {
        $tags = [
            [
                'name' => 'Laravel'
            ],
            [
                'name' => 'php'
            ],
            [
                'name' => 'relation'
            ],
        ];
        foreach ($tags as $tag)
        {
            Tag::create($tag);
        }
    }

}
