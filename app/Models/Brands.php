<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    use HasFactory;
    protected $table = 'brands';

    public function products() {
        return $this->hasMany(Products::class);
    }

    public function salesAchievements()
    {
        return $this->hasMany(SalesAchievements::class, 'brand_id');
    }
}
