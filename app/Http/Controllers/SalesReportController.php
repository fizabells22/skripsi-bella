<?php

namespace App\Http\Controllers;
use App\Models\SalesReports;
use Illuminate\Http\Request;

class SalesReportController extends Controller
{
    public function salesscore(Request $request){
        return view('admin.salesscoreadmin');
    }
    public function importsales(Request $request)
    {
        $request->validate([
            'csvfile' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('csvfile');

        $filePath = $file->storeAs('csvfiles', $file->getClientOriginalName());

        $data = array_map('str_getcsv', file(storage_path('app/' . $filePath)));

        foreach ($data as $row) {
            SalesReports::create([
                'dc' => $row[0],
                'sales_name' => $row[1],
                'sales_category' => $row[2],
                'persen_absensi' => (double)$row[3],
                'target_coverage' => (double)$row[4],
                'actual_coverage' => (double)$row[5],
                'act_tar_coverage_persen' => (double)$row[6],
                'jumlah_rao' => (double)$row[7],
                'persen_rao' => (double)$row[8],
                'plan_call' => (double)$row[9],
                'actual_call' => (double)$row[10],
                'act_plan_call_persen' => (double)$row[11],
                'target_ecall' => (double)$row[12],
                'actual_ecall' => (double)$row[13],
                'act_plan_ecall_persen' => (double)$row[14],
            ]);
        }
            return redirect()->route('salesscoreadmin');
    }   
}
