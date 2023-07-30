<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id('id')->unique();
            $table->unsignedBigInteger('user_id');
            $table->string('name', 100);
            $table->string('href', 250);
            $table->string('image', 250);
            $table->text('some_body');
            $table->text('body');
            $table->tinyInteger('status')->unsigned()->default(1);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
