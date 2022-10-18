<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJourneyProcessTopicReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journey_process_topic_reports', function (
            Blueprint $table
        ) {
            $table->id();
            $table->boolean('status')->default(0);
            $table
                ->bigInteger('journey_process_report_id')
                ->unsigned()
                ->nullable();
            $table
                ->foreign('journey_process_report_id')
                ->references('id')
                ->on('journey_process_reports')
                ->onDelete('set null');
            $table
                ->bigInteger('topic_id')
                ->unsigned()
                ->nullable();
            $table
                ->foreign('topic_id')
                ->references('id')
                ->on('topics')
                ->onDelete('set null');
            $table
                ->bigInteger('updated_by')
                ->unsigned()
                ->nullable();
            $table
                ->foreign('updated_by')
                ->references('id')
                ->on('members')
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
        Schema::dropIfExists('journey_process_topic_reports');
    }
}
