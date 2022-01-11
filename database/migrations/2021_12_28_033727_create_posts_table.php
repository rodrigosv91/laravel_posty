<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->text('body');
            //$table->integer('user_id')->unsigned()->index();

            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // foreignId can be specified or not: constrained('users')
            
            $table->timestamps(); //by defaul will make an: created_at and updated_at timestamp
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
