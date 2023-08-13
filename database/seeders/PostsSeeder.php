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

        $links_to_image = [
            'https://dev.ua/storage/images/15/57/50/71/derived/8a53af08d4184ea599fff98509d7f9b6.jpg',
            'https://preview.redd.it/49i3uht820k81.jpg?auto=webp&s=2c1d1b0d5ad51a6656daaca509f38881b18246f8',
            'https://codingbootcamps.io/wp-content/uploads/m2.png',
           // 'https://global.discourse-cdn.com/business7/uploads/replitteams/optimized/2X/9/9c65d672a957a94df4b584e9ae1efe8164104432_2_690x466.jpeg'
        ];

        for ($i = 0; $i < 11; $i++) {
            $arr[] = [
                'user_id' => 1,
                'name' => Str::random(10),
                'image' => $links_to_image[rand(0,count($links_to_image) -1)],
                'some_body' => $this->generateRandomBody(),
                'body' => $this->generateRandomBody(),
                'date_publish'=> date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }

        DB::table('posts')->insert($arr);
    }

    public function generateRandomBody(): string
    {
        $numberOfWords = 10;
        $wordsLength = 5;
        $separator = ' ';
        $randomBody = '';

        for ($i = 0; $i < $numberOfWords; $i++) {
            $randomWord = Str::random($wordsLength);
            $randomBody .= ($i === 0) ? $randomWord : sprintf('%s%s',$separator,$randomWord);
        }

        return $randomBody;
    }
}
