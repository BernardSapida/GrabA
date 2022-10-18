<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJourneyProcessReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journey_process_reports', function (Blueprint $table) {
            $table->id();
            $table->integer('no_of_topics');
            $table
                ->bigInteger('member_id')
                ->unsigned()
                ->nullable();
            $table
                ->foreign('member_id')
                ->references('id')
                ->on('members')
                ->onDelete('set null');
            $table
                ->bigInteger('event_id')
                ->unsigned()
                ->nullable();
            $table
                ->foreign('event_id')
                ->references('id')
                ->on('events')
                ->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('journey_process_reports');
    }
}
