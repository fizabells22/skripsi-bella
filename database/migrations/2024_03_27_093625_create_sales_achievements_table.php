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
        Schema::create('sales_achievements', function (Blueprint $table) {
            $table->id('achievement_id');
            $table->double('target_brand');
            $table->double('ach_brand');
            $table->double('persen_brand');
            $table->unsignedBigInteger('sales_id');
            $table->unsignedBigInteger('brand_id');
            $table->foreign('sales_id')->references('sales_id')->on('sales_representatives')->onDelete('cascade');
            $table->foreign('brand_id')->references('brand_id')->on('brands')->onDelete('cascade');
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
        Schema::dropIfExists('sales_achievements');
    }
};
