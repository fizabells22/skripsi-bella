<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\SalesAchs;
use App\Models\SalesReports;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function tampilkanChart()
    {
        // Mengambil data dari model Report
        $reports = Report::select('product', 'delivered_nominal_bruto_incppn')->get();

        // Menyiapkan array untuk menyimpan data nama produk dan nominal
        $namaProduk = [];
        $nominal = [];

        // Mengisi array dengan data yang diperoleh dari query
        foreach ($reports as $report) {
            $namaProduk[] = $report->product;
            $nominal[] = $report->delivered_nominal_bruto_incppn;
        }

        // Mengirim data ke view 'chart'
        return view('admin.reportadmin', compact('namaProduk', 'nominal'));
    }

    public function tampilkanChartAch()
    {
        // Mengambil data dari model Report
        $salesach = SalesAchs::select('sales_name', 'ach_all_brand')->get();

        // Menyiapkan array untuk menyimpan data nama produk dan nominal
        $namaSales = [];
        $ach = [];

        // Mengisi array dengan data yang diperoleh dari query
        foreach ($salesachs as $salesach) {
            $namaSales[] = $salesach->sales_name;
            $ach[] = $salesach->ach_all_brand;
        }

        // Mengirim data ke view 'chart'
        return view('admin.salesachadmin', compact('namaSales', 'ach'));
    }

    public function tampilkanChartScore()
    {
        // Mengambil data dari model Report
        $salesreports =  SalesReports::select('sales_name', 'actual_ecall')->get();

        // Menyiapkan array untuk menyimpan data nama produk dan nominal
        $namaSales = [];
        $act = [];

        // Mengisi array dengan data yang diperoleh dari query
        foreach ($salesreports as $salesreport) {
            $namaSales[] = $salesreport->sales_name;
            $act[] = $salesreport-> actual_ecall;
        }

        // Mengirim data ke view 'chart'
        return view('admin.salesscoreadmin', compact('namaSales', 'act'));
    }
}

   