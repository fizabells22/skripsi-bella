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
    public function reportcharts(Request $request)
    {
            $selectedDate = $request->input('selected_date', Carbon::now()->format('Y-m-d'));
    
            // Fetch data for top 5 products by delivered_bruto_incppns
            $topProductsByDelivered = Reeports::with('product')
                ->whereDate('updated_at', $selectedDate)
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
                ->whereDate('updated_at', $selectedDate)
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
            $salesDistributionByMonth = Reeports::whereDate('updated_at', $selectedDate)
                ->select(
                    DB::raw('MONTH(updated_at) as month'),
                    DB::raw('SUM(delivered_nominal_bruto_incppns) as totalSales')
                )
                ->groupBy(DB::raw('MONTH(updated_at)'))
                ->get();
    
            // Format sales distribution data
            $formattedSalesDistributionByMonth = [];
            foreach ($salesDistributionByMonth as $sales) {
                $monthName = Carbon::create()->month($sales->month)->format('F');
                $formattedSalesDistributionByMonth[] = [
                    'month' => $monthName,
                    'totalSales' => $sales->totalSales,
                ];
            }
    
            $data = [
                'barChartData' => $formattedTopProductsByDelivered,
                'doughnutChartData' => $formattedTopProductsByCustomerPurchases,
                'lineChartData' => $formattedSalesDistributionByMonth,
                'selectedDate' => $selectedDate, // Include the selected date to pass to the view
            ];
    
            // Send all formatted data to the view
            return view('admin.reportadmin')->with('data', $data);
        }
    
        public function reportchartsuser(Request $request)
        {
            $selectedDate = $request->input('selected_date', Carbon::now()->format('Y-m-d'));
    
            // Fetch data for top 5 products by delivered_bruto_incppns
            $topProductsByDelivered = Reeports::with('product')
                ->whereDate('updated_at', $selectedDate)
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
                ->whereDate('updated_at', $selectedDate)
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
            $salesDistributionByMonth = Reeports::whereDate('updated_at', $selectedDate)
                ->select(
                    DB::raw('MONTH(updated_at) as month'),
                    DB::raw('SUM(delivered_nominal_bruto_incppns) as totalSales')
                )
                ->groupBy(DB::raw('MONTH(updated_at)'))
                ->get();
    
            // Format sales distribution data
            $formattedSalesDistributionByMonth = [];
            foreach ($salesDistributionByMonth as $sales) {
                $monthName = Carbon::create()->month($sales->month)->format('F');
                $formattedSalesDistributionByMonth[] = [
                    'month' => $monthName,
                    'totalSales' => $sales->totalSales,
                ];
            }
    
            $data = [
                'barChartData' => $formattedTopProductsByDelivered,
                'doughnutChartData' => $formattedTopProductsByCustomerPurchases,
                'lineChartData' => $formattedSalesDistributionByMonth,
                'selectedDate' => $selectedDate, // Include the selected date to pass to the view
            ];
    
            // Send all formatted data to the view
            return view('report')->with('data', $data);
        }
    
    };