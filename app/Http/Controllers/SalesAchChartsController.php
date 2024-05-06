<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesRepresentative;
use App\Models\SalesAchievements;
use App\Models\Brands;

class SalesAchChartsController extends Controller
{
    public function charts()
{
    // Fetch data from database
    $salesAchievements = SalesAchievements::all();
    $salesRepresentatives = SalesRepresentative::all();

    $dataSales = [];

    foreach ($salesAchievements as $achievement) {
        $salesRep = SalesRepresentative::find($achievement->sales_id);
        $brand = $achievement->brand; // Access the brand using the defined relationship

        if ($salesRep && $brand) {
            $dataSales[] = [
                'sales_name' => $salesRep->saless_name,
                'sales_category' => $salesRep->saless_category,
                'distribution_center' => $salesRep->distribution_center,
                'target_brand' => $achievement->target_brand,
                'ach_brand' => $achievement->ach_brand,
                'persen_brand' => $achievement->persen_brand,
                'brand_id' => $achievement->brand_id,
                'created_at' => $achievement->created_at,
                'updated_at' => $achievement->updated_at,
                'brand_name' => $brand->brand_name
            ];
        }
    }
    // Mengirimkan data sales ke view
    return view('admin.salesachadmin')->with('dataSales', $dataSales);
}
public function chartsuser()
{
    // Fetch data from database
    $salesAchievements = SalesAchievements::all();
    $salesRepresentatives = SalesRepresentative::all();

    $dataSales = [];

    foreach ($salesAchievements as $achievement) {
        $salesRep = SalesRepresentative::find($achievement->sales_id);
        $brand = $achievement->brand; // Access the brand using the defined relationship

        if ($salesRep && $brand) {
            $dataSales[] = [
                'sales_name' => $salesRep->saless_name,
                'sales_category' => $salesRep->saless_category,
                'distribution_center' => $salesRep->distribution_center,
                'target_brand' => $achievement->target_brand,
                'ach_brand' => $achievement->ach_brand,
                'persen_brand' => $achievement->persen_brand,
                'brand_id' => $achievement->brand_id,
                'created_at' => $achievement->created_at,
                'updated_at' => $achievement->updated_at,
                'brand_name' => $brand->brand_name
            ];
        }
    }
    // Mengirimkan data sales ke view
    return view('salesach')->with('dataSales', $dataSales);
}
}
