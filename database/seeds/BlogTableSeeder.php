<?php

use Illuminate\Database\Seeder;
use App\Blog;

class BlogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Blog::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 50; $i++) {
            $title = $faker->sentence;
            $slug = Str::slug($title);
            Blog::create([
                'user_id' =>  $faker->randomDigit,
                'title' => $title,
                'slug' => $slug,
                'category_id' => $faker->randomDigit,
                'published' => $faker->boolean($chanceOfGettingTrue = 50),
                'image' => null,
                'intro' => $faker->paragraph,
                'content' => $faker->paragraph,
            ]);
        }
    }
}
