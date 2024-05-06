<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SalesRepresentative;
use App\Models\Products;
use App\Models\Brands;
use App\Models\Customers;
use App\Models\Reeports;

use Carbon\Carbon;

class ReportChartsController extends Controller
{
    public function reportcharts()
    {
        // Fetch data for top 5 products by delivered_bruto_incppns
        $topProductsByDelivered = Reeports::with('product')
            ->select('product_id', DB::raw('SUM(delivered_nominal_bruto_incppns) as totalDeliveredBrutoIncPpn'))
            ->groupBy('product_id')
            ->orderByDesc('totalDeliveredBrutoIncPpn')
            ->limit(5)
            ->get();

        // Format data for top 5 products by delivered value
        $formattedTopProductsByDelivered = $topProductsByDelivered->map(function ($product) {
            return [
                'product_name' => $product->product->product_name,
                'total_delivered' => $product->totalDeliveredBrutoIncPpn,
            ];
        })->toArray();

        // Fetch data for top 5 products by customer purchases
        $topProductsByCustomerPurchases = Reeports::with('product')
            ->select('product_id', DB::raw('COUNT(*) as totalCustomerPurchases'))
            ->groupBy('product_id')
            ->orderByDesc('totalCustomerPurchases')
            ->limit(5)
            ->get();

        // Format data for top 5 products by customer purchases
        $formattedTopProductsByCustomerPurchases = $topProductsByCustomerPurchases->map(function ($product) {
            return [
                'product_name' => $product->product->product_name,
                'total_purchases' => $product->totalCustomerPurchases,
            ];
        })->toArray();

        // Fetch sales distribution by month
        $salesDistributionByMonth = Reeports::select(
                DB::raw('bulan_report as month'),
                DB::raw('SUM(delivered_nominal_bruto_incppns) as totalSales')
            )
            ->groupBy('month')
            ->get();

        // Format sales distribution data
        $formattedSalesDistributionByMonth = [];
        foreach ($salesDistributionByMonth as $sales) {
            $monthName = Carbon::create()->month($sales->month)->format('F');
            $formattedSalesDistributionByMonth[$monthName] = $sales->totalSales;
        }

        // Send all formatted data to the view
        return view('admin.reportadmin', [
            'formattedTopProductsByDelivered' => $formattedTopProductsByDelivered,
            'formattedTopProductsByCustomerPurchases' => $formattedTopProductsByCustomerPurchases,
            'formattedSalesDistributionByMonth' => $formattedSalesDistributionByMonth,
        ]);
    }
};