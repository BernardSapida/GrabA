<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMinistryMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ministry_members', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_ministry_head')->default(0);
            $table
                ->bigInteger('ministry_id')
                ->unsigned()
                ->nullable();
            $table
                ->bigInteger('member_id')
                ->unsigned()
                ->nullable();
            $table->timestamps();
        });
        Schema::table('ministry_members', function ($table) {
            $table
                ->foreign('ministry_id')
                ->references('id')
                ->on('ministries')
                ->onDelete('set null');
            $table
                ->foreign('member_id')
                ->references('id')
                ->on('members')
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
        Schema::dropIfExists('ministry_members');
    }
}
