<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesScoreboards extends Model
{
    use HasFactory;
    protected $table = 'sales_scoreboards';
     protected $primaryKey = 'scoreboard_id';
    
    protected $fillable = [
        'scoreboard_id', 'persen_absensis', 'target_coverages', 'actual_coverages', 'act_tar_coverages_persen',
        'jumlahh_rao', 'persen_raao', 'plan_calls', 'actual_calls', 'act_plan_calls_persen',
        'target_ecalls', 'actual_ecalls', 'act_plan_ecalls_persen', 'sales_id'
    ];

    public function salesRepresentative()
    {
        return $this->belongsTo(SalesRepresentative::class, 'sales_id', 'sales_id');
    }
}
