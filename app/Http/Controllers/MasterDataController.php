<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\SalesRepresentative;
use App\Models\Brands;
use App\Models\Products;
use App\Models\Reeports;
use App\Models\SalesScoreboards;
use App\Models\SalesAchievements;
use Illuminate\Http\Request;

class MasterDataController extends Controller
{
    public function indexuser()
    {
        $brands = Brands::all(['brand_id', 'brand_name']);
        $products = Products::all(['product_id', 'product_name', 'product_status_lifecycles', 'brand_id']);
        $salesRepresentatives = SalesRepresentative::all(['saless_name', 'saless_category', 'distribution_center']);
        $customers = Customers::all(['customers_kd', 'customers_id', 'customers_name']);
        $salesAchievements = SalesAchievements::all(['achievement_id', 'target_brand', 'ach_brand', 'persen_brand', 'sales_id', 'brand_id']);
        $salesScoreboards = SalesScoreboards::all(['scoreboard_id', 'persen_absensis', 'target_coverages', 'actual_coverages', 'act_tar_coverages_persen', 'jumlahh_rao', 'persen_raao', 'plan_calls', 'actual_calls', 'act_plan_calls_persen', 'target_ecalls', 'actual_ecalls', 'act_plan_ecalls_persen', 'sales_id']);
        $reports = Reeports::all(['reports_id', 'bulan_report', 'delivered_nominal_bruto_incppns', 'product_id', 'sales_id', 'customers_kd', 'brand_id']);

        return view('masterdata', compact('brands', 'products', 'salesRepresentatives', 'customers', 'salesAchievements', 'salesScoreboards', 'reports'));
    }
}
