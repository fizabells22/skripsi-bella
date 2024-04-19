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
        Schema::create('sales_achs', function (Blueprint $table) {
            $table->id('achievement_id');
            $table->string('dc');
            $table->string('sales_name');
            $table->string('sales_category');
            $table->double('target_all_brand');
            $table->double('ach_all_brand');
            $table->double('all_brand_persen');
            $table->double('target_wardah');
            $table->double('ach_wardah');
            $table->double('wardah_persen');
            $table->double('target_mo');
            $table->double('ach_mo');
            $table->double('mo_persen');
            $table->double('target_emina');
            $table->double('ach_emina');
            $table->double('emina_persen');
            $table->double('target_putri');
            $table->double('ach_putri');
            $table->double('putri_persen');
            $table->double('target_kahf');
            $table->double('ach_kahf');
            $table->double('kahf_persen');
            $table->double('target_ip');
            $table->double('ach_ip');
            $table->double('ip_persen');
            $table->double('target_cl');
            $table->double('ach_cl');
            $table->double('cl_persen');
            $table->double('target_biodef');
            $table->double('ach_biodef');
            $table->double('biodef_persen');
            $table->double('target_omg');
            $table->double('ach_omg');
            $table->double('omg_persen');
            $table->double('target_wonderly');
            $table->double('ach_wonderly');
            $table->double('wonderly_persen');
            $table->double('target_labore');
            $table->double('ach_labore');
            $table->double('labore_persen');
            $table->double('target_tavi');
            $table->double('ach_tavi');
            $table->double('tavi_persen');
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
        Schema::dropIfExists('sales_achs');
    }
};
