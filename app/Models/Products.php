<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';
    
    public function brands() {
        return $this->belongsTo(Brands::class, 'brand_id');
    }

    public function reeports()
    {
        return $this->hasMany(Reeport::class, 'product_id');
    }
}
