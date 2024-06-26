<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesAchievements extends Model
{
    use HasFactory;
    protected $table = 'sales_achievements';
    protected $primaryKey = 'achievement_id';
    
    protected $fillable = ['achievement_id', 'target_brand', 'ach_brand', 'persen_brand', 'sales_id', 'brand_id'];

    public function salesRepresentative()
    {
        return $this->belongsTo(SalesRepresentative::class, 'sales_id', 'sales_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brands::class, 'brand_id', 'brand_id');
    }
}
