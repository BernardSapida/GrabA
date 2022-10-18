<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLeadershipStatusIdToSwsReports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sws_reports', function (Blueprint $table) {
            $table
            ->bigInteger('leadership_status_id')
            ->unsigned()
            ->default(1)
            ->after('status');
        $table
            ->foreign('leadership_status_id')
            ->references('id')
            ->on('leadership_statuses')
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
        Schema::table('sws_reports', function (Blueprint $table) {
            //
        });
    }
}
