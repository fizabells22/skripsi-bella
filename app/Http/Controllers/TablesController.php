<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesRepresentative;

class TablesController extends Controller
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

        return view('salesach')->with('salesRepresentatives', $salesRepresentatives);
    }
}
