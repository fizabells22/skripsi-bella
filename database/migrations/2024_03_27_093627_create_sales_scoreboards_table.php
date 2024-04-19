<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_scoreboards', function (Blueprint $table) {
            $table->id('scoreboard_id');
            $table->double('persen_absensis');
            $table->double('target_coverages');
            $table->double('actual_coverages');
            $table->double('act_tar_coverages_persen');
            $table->double('jumlahh_rao');
            $table->double('persen_raao');
            $table->double('plan_calls');
            $table->double('actual_calls');
            $table->double('act_plan_calls_persen');
            $table->double('target_ecalls');
            $table->double('actual_ecalls');
            $table->double('act_plan_ecalls_persen');
            $table->unsignedBigInteger('sales_id');
            $table->foreign('sales_id')->references('sales_id')->on('sales_representatives')->onDelete('cascade');
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
        Schema::dropIfExists('sales_scoreboards');
    }
};
