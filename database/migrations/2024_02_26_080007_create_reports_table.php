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
        Schema::create('reports', function (Blueprint $table) {
            $table->id('report_id');
            $table->string('bulan');
            $table->string('customer_id');
            $table->string('customer');
            $table->string('sales_representative');
            $table->string('brand');
            $table->string('product_status_lifecycle');
            $table->string('product');
            $table->double('delivered_nominal_bruto_incppn');	
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
        Schema::dropIfExists('reports');
    }
};
