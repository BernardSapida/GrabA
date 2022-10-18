<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkplacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workplaces', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table
                ->bigInteger('area_id')
                ->unsigned()
                ->nullable();
            $table
                ->bigInteger('outreach_id')
                ->unsigned()
                ->nullable();
            $table->timestamps();
        });
        Schema::table('workplaces', function ($table) {
            $table
                ->foreign('outreach_id')
                ->references('id')
                ->on('outreaches')
                ->onDelete('set null');
            $table
                ->foreign('area_id')
                ->references('id')
                ->on('areas')
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
        Schema::dropIfExists('workplaces');
    }
}
