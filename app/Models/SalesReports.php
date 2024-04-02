<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesReports extends Model
{
    use HasFactory;
    protected $fillable = ['scoreboard_id','dc','sales_name','sales_category','%_absensi','target_coverage','actual_coverage','act/tar_coverage_%','jumlah_rao','%_rao','plan_call','actual_call', 'act/plan_call_%','target_ecall','actual_ecall','act/plan_ecall_%'];
}
