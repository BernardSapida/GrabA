<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('address');
            $table->date('birthday');
            $table->text('mobile');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->boolean('is_mighty_warrior')->default(0);
            $table->longText('token')->nullable();
            $table->longText('forgot_password_token')->nullable();
            $table->string('otp_key')->nullable();
            $table
                ->bigInteger('pcg_id')
                ->unsigned()
                ->nullable();
            $table
                ->bigInteger('journey_status_id')
                ->unsigned()
                ->nullable();
            $table
                ->bigInteger('leadership_status_id')
                ->unsigned()
                ->nullable();
            $table
                ->bigInteger('outreach_id')
                ->unsigned()
                ->nullable();
            $table
                ->bigInteger('area_id')
                ->unsigned()
                ->nullable();
            $table
                ->bigInteger('campus_id')
                ->unsigned()
                ->nullable();
            $table
                ->bigInteger('workplace_id')
                ->unsigned()
                ->nullable();
            $table
                ->bigInteger('ministry_id')
                ->unsigned()
                ->nullable();
            $table
                ->bigInteger('status_id')
                ->unsigned()
                ->nullable();
            $table
                ->bigInteger('leader_id')
                ->unsigned()
                ->nullable();
            $table->timestamps();
        });

        Schema::table('members', function ($table) {
            $table
                ->foreign('pcg_id')
                ->references('id')
                ->on('pcgs')
                ->onDelete('set null');
            $table
                ->foreign('journey_status_id')
                ->references('id')
                ->on('journey_statuses')
                ->onDelete('set null');
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
            $table
                ->foreign('campus_id')
                ->references('id')
                ->on('campuses')
                ->onDelete('set null');
            $table
                ->foreign('workplace_id')
                ->references('id')
                ->on('workplaces')
                ->onDelete('set null');
            $table
                ->foreign('ministry_id')
                ->references('id')
                ->on('ministries')
                ->onDelete('set null');
            $table
                ->foreign('status_id')
                ->references('id')
                ->on('statuses')
                ->onDelete('set null');
            $table
                ->foreign('leader_id')
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
        Schema::dropIfExists('members');
    }
}
