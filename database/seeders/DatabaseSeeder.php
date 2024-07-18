<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Rating;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Seeder;
use Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Article::truncate();
        Image::truncate();
        Video::truncate();
        User::truncate();
        Comment::truncate();
        Rating::truncate();
        for ($i=0; $i < 10; $i++) { 
            \DB::table('articles')->insert([
                'title' => fake()->sentence(),
                'content' => fake()->text()
            ]);
        }

        User::factory(10)->create();

        for ($i=0; $i < 10; $i++) { 
            \DB::table('videos')->insert([
                'title' => fake()->sentence(),
                'url' => fake()->image(null, 640, 480)
            ]);
        }
        for ($i=0; $i < 10; $i++) { 
            \DB::table('images')->insert([
                'title' => fake()->sentence(),
                'url' => fake()->image(null, 640, 480)
            ]);
        }


        for ($i=1; $i < 11; $i++) { 
            \DB::table('comments')->insert([
                'user_id' => rand(1, 10),
                'content' => fake()->sentence(),
                'commentable_type' => Article::class,
                'commentable_id' => $i
            ]);
            \DB::table('comments')->insert([
                'user_id' => rand(1, 10),
                'content' => fake()->sentence(),
                'commentable_type' => Image::class,
                'commentable_id' => $i
            ]);
            \DB::table('comments')->insert([
                'user_id' => rand(1, 10),
                'content' => fake()->sentence(),
                'commentable_type' => Video::class,
                'commentable_id' => $i
            ]);
            \DB::table('ratings')->insert([
                'user_id' => rand(1, 10),
                'rating' => rand(1, 5),
                'rateable_type' => Article::class,
                'rateable_id' => $i
            ]);
            \DB::table('ratings')->insert([
                'user_id' => rand(1, 10),
                'rating' => rand(1, 5),
                'rateable_type' => Image::class,
                'rateable_id' => $i
            ]);
            \DB::table('ratings')->insert([
                'user_id' => rand(1, 10),
                'rating' => rand(1, 5),
                'rateable_type' => Video::class,
                'rateable_id' => $i
            ]);
        }
    }
}
