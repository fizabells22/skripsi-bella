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

class MasterDataAdminController extends Controller
{
    public function tabelsalesrepre()
    {
        $salesRepresentatives = SalesRepresentative::select('saless_name', 'saless_category','distribution_center')->get();
        $namaSales = [];
        $categorySales = [];
        $distributionCenter = [];

        // Mengisi array dengan data yang diperoleh dari query
        foreach ($salesRepresentatives as $salesRepresentativess) {
            $namaSales[] = $salesRepresentativess->saless_name;
            $categorySales[] = $salesRepresentativess->saless_category;
            $distributionCenter[] = $salesRepresentativess->distribution_center;
        }
        return view('admin.salesachadmin')->with('salesRepresentatives', $salesRepresentatives);
    }

    public function salesach(Request $request){
        $salesRepresentatives = SalesRepresentative::select('saless_name', 'saless_category','distribution_center')->get();
        return view('admin.salesachadmin')->with('salesRepresentatives', $salesRepresentatives);
    }

    public function tabelcustomers()
    {
        $customers = Customers::select('customers_id', 'customers_name')->get();
        $customersId = [];
        $customersName = [];

        // Mengisi array dengan data yang diperoleh dari query
        foreach ($customers as $customerss) {
            $customersId[] = $customerss->customers_id;
            $customersName[] = $customerss->customers_name;
        }

        return view('masterdataadmin')->with('customers', $customers);
    }

    public function tabelbrands()
    {
        $brands = Brands::select('brand_id', 'brand_name')->get();
        $brandId = [];
        $brandName = [];

        // Mengisi array dengan data yang diperoleh dari query
        foreach ($brands as $brandss) {
            $brandId[] = $brandss->brand_id;
            $brandName[] = $brandss->brand_name;
        }

        return view('masterdataadmin')->with('brands', $brands);
    }

    public function tabelproducts()
    {
         // Mengambil produk beserta brand terkait
    $products = Products::with('brands')->get();

    // Membuat array untuk menyimpan data jika diperlukan
    // Namun, karena kita akan mengirim seluruh produk ke view, ini mungkin tidak diperlukan
    $productName = [];
    $productStatus = [];
    $brandId = [];
    $brandName = [];

    // Mengisi array dengan data yang diperoleh dari query
    foreach ($products as $productss) {
        $productName[] = $productss->product_name;
        $productStatus[] = $productss->product_status_lifecycles;
        $brandId[] = $productss->brand_id;
        $brandName[] = $productss->brands->brand_name; // Pastikan kolom untuk nama brand di tabel brands adalah 'name'
    }

    // Mengirim data produk ke view
    return view('masterdataadmin', compact('products'));
    }

    public function tabelreeports()
    {
    // Mengambil semua reeports beserta product, sales representative, customer, dan brand yang terkait
    $reeports = Reeports::with(['products', 'salesRepresentatives', 'customers', 'brands'])->get();

    return view('masterdataadmin', compact('reeports'));
    }

    public function index()
    {
        $brands = Brands::all(['brand_id', 'brand_name']);
        $products = Products::all(['product_id', 'product_name', 'product_status_lifecycles', 'brand_id']);
        $salesRepresentatives = SalesRepresentative::all(['saless_name', 'saless_category', 'distribution_center']);
        $customers = Customers::all(['customers_kd', 'customers_id', 'customers_name']);
        $salesAchievements = SalesAchievements::all(['achievement_id', 'target_brand', 'ach_brand', 'persen_brand', 'sales_id', 'brand_id']);
        $salesScoreboards = SalesScoreboards::all(['scoreboard_id', 'persen_absensis', 'target_coverages', 'actual_coverages', 'act_tar_coverages_persen', 'jumlahh_rao', 'persen_raao', 'plan_calls', 'actual_calls', 'act_plan_calls_persen', 'target_ecalls', 'actual_ecalls', 'act_plan_ecalls_persen', 'sales_id']);
        $reports = Reeports::all(['reports_id', 'bulan_report', 'delivered_nominal_bruto_incppns', 'product_id', 'sales_id', 'customers_kd', 'brand_id']);

        return view('admin.masterdataadmin', compact('brands', 'products', 'salesRepresentatives', 'customers', 'salesAchievements', 'salesScoreboards', 'reports'));
    }
}
