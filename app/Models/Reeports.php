<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reeports extends Model
{
    use HasFactory;
    protected $table = 'reeports';

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id', 'product_id');
    }

    public function salesRepresentatives() {
        return $this->belongsTo(SalesRepresentative::class, 'sales_id');
    }

    public function customers() {
        return $this->belongsTo(Customers::class, 'customers_kd');
    }

    public function brands() {
        return $this->belongsTo(Brands::class, 'brand_id');
    }
}
