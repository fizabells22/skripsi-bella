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
        Schema::create('reeports', function (Blueprint $table) {
            $table->id('report_id');
            $table->date('bulan_report');
            $table->double('delivered_nominal_bruto_incppns');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('sales_id');
            $table->unsignedBigInteger('customers_kd');
            $table->unsignedBigInteger('brand_id');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('sales_id')->references('sales_id')->on('sales_representatives')->onDelete('cascade');
            $table->foreign('customers_kd')->references('customers_kd')->on('customers')->onDelete('cascade');
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
        Schema::dropIfExists('reeports');
    }
};
