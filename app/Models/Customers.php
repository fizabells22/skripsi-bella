<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $primaryKey = 'customers_kd';

    public function reeports() {
        return $this->hasMany(Reeports::class, 'customers_kd');
    }
}
