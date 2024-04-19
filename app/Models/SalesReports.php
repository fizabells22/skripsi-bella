<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesReports extends Model
{
    use HasFactory;
    protected $fillable = ['scoreboard_id','dc','sales_name','sales_category','persen_absensi','target_coverage','actual_coverage','act_tar_coverage_persen','jumlah_rao','persen_rao','plan_call','actual_call', 'act_plan_call_persen','target_ecall','actual_ecall','act_plan_ecall_persen'];
}
