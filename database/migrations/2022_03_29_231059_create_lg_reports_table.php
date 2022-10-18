<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLgReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lg_reports', function (Blueprint $table) {
            $table->id();
            $table->string('month');
            $table->string('year');
            $table->boolean('week1')->default(0);
            $table->boolean('week2')->default(0);
            $table->boolean('week3')->default(0);
            $table->boolean('week4')->default(0);
            $table->boolean('week5')->default(0);
            $table
                ->bigInteger('member_id')
                ->unsigned()
                ->nullable();
            $table
                ->bigInteger('outreach_id')
                ->unsigned()
                ->nullable();
            $table->timestamps();
        });
        Schema::table('lg_reports', function ($table) {
            $table
                ->foreign('member_id')
                ->references('id')
                ->on('members')
                ->onDelete('set null');
            $table
                ->foreign('outreach_id')
                ->references('id')
                ->on('outreaches')
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
        Schema::dropIfExists('lg_reports');
    }
}
