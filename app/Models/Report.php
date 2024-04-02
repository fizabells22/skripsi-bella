<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = ['report_id','bulan','customer_id','customer','sales_representative','brand','product_status_lifecycle','product','delivered_nominal_bruto_incppn'];
}
