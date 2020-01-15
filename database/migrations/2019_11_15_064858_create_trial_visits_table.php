<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrialVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trial_visits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('patient_id')->nullable();
            $table->integer('clinical_id')->nullable();
            $table->integer('research_site_id')->nullable();
            $table->string('visit_name')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->integer('status')->nullable();
            $table->text('case_note')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('charge_status')->nullable();
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
        Schema::dropIfExists('trial_visits');
    }
}
