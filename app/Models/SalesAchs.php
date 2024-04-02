<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesAchs extends Model
{
    use HasFactory;
    protected $fillable = ['achievement_id','dc','sales_name','sales_category','target_all_brand','ach_all_brand','all_brand_%','target_wardah','ach_wardah','wardah_%','target_mo','ach_mo','mo_%','target_emina','ach_emina','emina_%','target_putri','ach_putri','putri_%','target_kahf','ach_kahf','kahf_%','target_ip','ach_ip','ip_%','target_cl','ach_cl','cl_%','target_biodef','ach_biodef','biodef_%','target_omg','ach_omg','omg_%','target_wonderly','ach_wonderly','wonderly_%','target_labore','ach_labore','labore_%','target_tavi','ach_tavi','tavi_%'];
}
