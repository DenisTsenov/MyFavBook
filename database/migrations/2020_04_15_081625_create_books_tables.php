<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('isbn');
            $table->text('description');
            $table->string('image');
            $table->timestamps();
        });

        Schema::create('book_user', function (Blueprint $table) {
            $table->foreignId('book_id')->constrained()->onDelete('cascade')->onUpdate('cascade');

            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');

            $table->unique(['book_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_user');
        Schema::dropIfExists('books');
    }
}
