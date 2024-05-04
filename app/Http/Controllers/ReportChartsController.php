<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesRepresentative;
use App\Models\Products;
use App\Models\Brands;
use App\Models\Customers;


class ReportChartsController extends Controller
{
    public function reportcharts()
    {
        // Fetch data from database
        $reeports = Reeport::all();
        $products = Products::all();
        $salesRepresentatives = SalesRepresentative::all();
        $customers = Customers::all();
    
        $dataReeport = [];
    
        foreach ($reeports as $reeport) {
            $salesRep = SalesRepresentative::find($reeport->sales_id);
            $prod = Products::find($reeport->product_id);
            $customer = Customers::find($reeport->customers_kd);
            $brand = Brands::find($reeport->brand_id);
    
            if ($prod && $salesRep && $customer && $brand) {
                $dataReeport[] = [
                    'bulan_report' => $reeport->bulan_report,
                    'delivered_nominal_bruto_incppns' => $reeport->delivered_nominal_bruto_incppns,
                    'product_name' => $prod->product_name,
                    'sales_name' => $salesRep->saless_name,
                    'customer_name' => $customer->customers_name,
                    'customer_id' => $customer->customers_id,
                    'brand_name' => $brand->brand_name
                ];
            }
        }
        // Send the data to the view
        return view('admin.reportadmin')->with('dataReeport', $dataReeport);
    }
}
