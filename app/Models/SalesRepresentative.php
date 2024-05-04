<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesRepresentative extends Model
{
    use HasFactory;
    protected $table = 'sales_representatives';
    protected $primaryKey = 'sales_id';

    public function salesAchievements()
    {
        return $this->hasMany(SalesAchievements::class, 'sales_id');
    }

    public function salesScoreboards()
    {
        return $this->hasMany(SalesScoreboards::class, 'sales_id');
    }
}
