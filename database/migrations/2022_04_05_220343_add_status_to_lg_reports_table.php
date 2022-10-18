<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToLgReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lg_reports', function (Blueprint $table) {
            $table
                ->string('status')
                ->nullable()
                ->after('outreach_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lg_reports', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
