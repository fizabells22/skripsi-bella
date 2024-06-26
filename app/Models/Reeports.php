<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reeports extends Model
{
    use HasFactory;
    protected $table = 'reeports';
    protected $primaryKey = 'reports_id';

    protected $fillable = [
        'reports_id', 'bulan_report', 'delivered_nominal_bruto_incppns', 
        'product_id', 'sales_id', 'customers_kd', 'brand_id'
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id', 'product_id');
    }

    public function salesRepresentative() {
        return $this->belongsTo(SalesRepresentative::class, 'sales_id');
    }

    public function customer() {
        return $this->belongsTo(Customers::class, 'customers_kd');
    }

    public function brand() {
        return $this->belongsTo(Brands::class, 'brand_id');
    }
}
