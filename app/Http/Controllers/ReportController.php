<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function report(Request $request)
    {
        return view('admin.reportadmin');
    }

    public function import(Request $request)
    {
        $request->validate([
            'csvfile' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('csvfile');

        $filePath = $file->storeAs('csvfiles', $file->getClientOriginalName());

        $data = array_map('str_getcsv', file(storage_path('app/' . $filePath)));
            try{
            foreach ($data as $row) {
                Report::create([
                    'bulan' => $row[0],
                    'customer_id' => $row[1],
                    'customer' => $row[2],
                    'sales_representative' => $row[3],
                    'brand' => $row[4],
                    'product_status_lifecycle' => $row[5],
                    'product' => $row[6],
                    'delivered_nominal_bruto_incppn' => (int)$row[7],
                ]);
            }
            Session::flash('success', 'Your data have been saved successfully');
            return redirect()->route('reportadmin');
        }   catch (\Exception $e) {
            Session::flash('error', 'Failed to upload file. Please check the file format and try again.');
            return redirect()->back();
            }
        }
    }
    

