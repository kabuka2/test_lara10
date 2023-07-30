<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arr = [];

        for ($i = 0; $i < 1000; $i++) {
            $arr[] = [
                'user_id' => 1,
                'name' => Str::random(10),
                'href' => '#',
                'image' => '/images/posts/7f3de99d94ed6b6b2a1cdcc449bf4f52.jpg',
                'some_body' => $this->generateRandomBody(),
                'body' => $this->generateRandomBody(),
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }

        DB::table('posts')->insert($arr);
    }

    public function generateRandomBody(): string
    {
        $numberOfWords = 2000;
        $wordsLength = 10;
        $separator = ' ';
        $randomBody = '';

        for ($i = 0; $i < $numberOfWords; $i++) {
            $randomWord = Str::random($wordsLength);
            $randomBody .= ($i === 0) ? $randomWord : $separator . $randomWord;
        }

        return $randomBody;
    }
}
