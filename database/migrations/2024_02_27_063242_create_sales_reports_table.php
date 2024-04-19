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
        Schema::create('sales_reports', function (Blueprint $table) {
            $table->id('scoreboard_id');
            $table->string('dc');
            $table->string('sales_name');
            $table->string('sales_category');
            $table->double('persen_absensi');
            $table->double('target_coverage');
            $table->double('actual_coverage');
            $table->double('act_tar_coverage_persen');
            $table->double('jumlah_rao');
            $table->double('persen_rao');
            $table->double('plan_call');
            $table->double('actual_call');
            $table->double('act_plan_call_persen');
            $table->double('target_ecall');
            $table->double('actual_ecall');
            $table->double('act_plan_ecall_persen');
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
        Schema::dropIfExists('sales_reports');
    }
};
