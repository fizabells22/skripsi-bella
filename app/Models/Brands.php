<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    use HasFactory;
    protected $table = 'brands';
    protected $primaryKey = 'brand_id';

    public function products() {
        return $this->hasMany(Products::class, 'brand_id', 'brand_id');
    }

    public function salesAchievements()
    {
        return $this->hasMany(SalesAchievements::class, 'brand_id', 'brand_id');
    }
}
