<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubInvestigatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_investigators', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('clinical_id')->nullable();
            $table->integer('status')->nullable();
            $table->string('study_title')->nullable();
            $table->string('site_name')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('mechanism')->nullable();
            $table->longText('list_benefits')->nullable();
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
        Schema::dropIfExists('sub_investigators');
    }
}
