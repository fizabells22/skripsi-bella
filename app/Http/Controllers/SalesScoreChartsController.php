<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesRepresentative;
use App\Models\SalesScoreboards;

class SalesScoreChartsController extends Controller
{
    public function chartscore()
    {
        // Fetch data from database
        $salesScoreboards = SalesScoreboards::all();
        $dataScore = [];
    
        foreach ($salesScoreboards as $scoreboard) {
            $salesRep = SalesRepresentative::find($scoreboard->sales_id);
    
            // Initialize total call for each sales representative
            $totalActualCall = 0;
            $totalPlanCall = 0;
            $totalECall = 0;
    
            // Calculate total call for each sales representative
            $totalActualCall += $scoreboard->actual_calls;
            $totalPlanCall += $scoreboard->plan_calls;
            $totalECall += $scoreboard->actual_ecalls;

            $dataScore[] = [
                'sales_name' => $salesRep->saless_name,
                'jumlah_rao' => $scoreboard->jumlahh_rao,
                'persen_absensi' => $scoreboard->persen_absensis,
                'plan_call' => $scoreboard->plan_calls,
                'actual_call' => $scoreboard->actual_calls,
                'target_ecall' => $scoreboard->target_ecalls,
                'actual_ecall' => $scoreboard->actual_ecalls,
                'created_at' => $scoreboard->created_at,
                'updated_at' => $scoreboard->updated_at,
                'totalActualCall' => $totalActualCall,
                'totalPlanCall' => $totalPlanCall,
                'totalECall' => $totalECall,
            ];
        }
        return view('admin.salesscoreadmin')->with('dataScore', $dataScore);
    }

    public function chartscoreuser()
    {
        // Fetch data from database
        $salesScoreboards = SalesScoreboards::all();
        $dataScore = [];
    
        foreach ($salesScoreboards as $scoreboard) {
            $salesRep = SalesRepresentative::find($scoreboard->sales_id);
    
            // Initialize total call for each sales representative
            $totalActualCall = 0;
            $totalPlanCall = 0;
            $totalECall = 0;
    
            // Calculate total call for each sales representative
            $totalActualCall += $scoreboard->actual_calls;
            $totalPlanCall += $scoreboard->plan_calls;
            $totalECall += $scoreboard->actual_ecalls;

            $dataScore[] = [
                'sales_name' => $salesRep->saless_name,
                'jumlah_rao' => $scoreboard->jumlahh_rao,
                'persen_absensi' => $scoreboard->persen_absensis,
                'plan_call' => $scoreboard->plan_calls,
                'actual_call' => $scoreboard->actual_calls,
                'target_ecall' => $scoreboard->target_ecalls,
                'actual_ecall' => $scoreboard->actual_ecalls,
                'created_at' => $scoreboard->created_at,
                'updated_at' => $scoreboard->updated_at,
                'totalActualCall' => $totalActualCall,
                'totalPlanCall' => $totalPlanCall,
                'totalECall' => $totalECall,
            ];
        }
        return view('salesscore')->with('dataScore', $dataScore);
    }
}
