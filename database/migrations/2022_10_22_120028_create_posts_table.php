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
            $table->json('materials');
            $table->string('purpose');
            $table->string('fullname');
            $table->string('address');
            $table->string('contact');
            $table
                ->bigInteger('project_id')
                ->unsigned()
                ->nullable();
            $table->timestamps();
        });
        Schema::table('posts', function ($table) {
            $table
                ->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->onDelete('set null');
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
