<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEventTypeIdToJourneyProcessReports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('journey_process_reports', function (Blueprint $table) {
            $table
                ->bigInteger('event_type_id')
                ->unsigned()
                ->nullable()
                ->after('event_id');
            $table
                ->foreign('event_type_id')
                ->references('id')
                ->on('event_types')
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
        Schema::table('journey_process_reports', function (Blueprint $table) {
            //
        });
    }
}
