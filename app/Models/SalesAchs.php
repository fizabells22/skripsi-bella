<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesAchs extends Model
{
    use HasFactory;
    protected $fillable = ['achievement_id','dc','sales_name','sales_category','target_all_brand','ach_all_brand','all_brand_persen','target_wardah','ach_wardah','wardah_persen','target_mo','ach_mo','mo_persen','target_emina','ach_emina','emina_persen','target_putri','ach_putri','putri_persen','target_kahf','ach_kahf','kahf_persen','target_ip','ach_ip','ip_persen','target_cl','ach_cl','cl_persen','target_biodef','ach_biodef','biodef_persen','target_omg','ach_omg','omg_persen','target_wonderly','ach_wonderly','wonderly_persen','target_labore','ach_labore','labore_persen','target_tavi','ach_tavi','tavi_persen'];
}
