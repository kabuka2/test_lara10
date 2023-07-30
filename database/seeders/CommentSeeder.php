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
        for ($i = 0; $i < 1000; $i++) {
            $parentId = ($i % 2 === 0) ? null : rand(1, $i);
            $postId = $i + 1;
            $content = Str::random(100);
            $status = rand(0, 1);

            $data[] = [
                'parent_id' => $parentId,
                'user_id' => 1,
                'post_id' => $postId,
                'content' => $content,
                'status' => $status,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }

        DB::table('comments')->insert($data);
    }
}
