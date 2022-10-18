<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOutreachIdToNetworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('networks', function (Blueprint $table) {
            $table
                ->bigInteger('outreach_id')
                ->unsigned()
                ->nullable()
                ->after('member_id');
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
        // Schema::table('networks', function (Blueprint $table) {
        //     $table->dropColumn('outreach_id');
        // });
    }
}
