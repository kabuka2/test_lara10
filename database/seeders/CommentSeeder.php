<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $data = [
            [ // 1
                'parent_id' => null,
                'user_id' => 1,
                'post_id' => 1,
                'content' => Str::random(20),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [ // 2
                'parent_id' => 1,
                'user_id' => 1,
                'post_id' => 1,
                'content' => Str::random(20),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [ //3
                'parent_id' => 2,
                'user_id' => 1,
                'post_id' => 1,
                'content' => Str::random(20),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [ // 4
                'parent_id' => null,
                'user_id' => 1,
                'post_id' => 1,
                'content' => Str::random(20),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [ //5
                'parent_id' => null,
                'user_id' => 1,
                'post_id' => 2,
                'content' => Str::random(20),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [ // 6
                'parent_id' => 5,
                'user_id' => 1,
                'post_id' => 2,
                'content' => Str::random(20),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [ // 7
                'parent_id' => null,
                'user_id' => 1,
                'post_id' => 2,
                'content' => Str::random(20),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];


        DB::table('comments')->insert($data);
    }
}
