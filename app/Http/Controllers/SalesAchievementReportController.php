<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\SalesAchs;
use App\Models\SalesRepresentative;
use Illuminate\Http\Request;

class SalesAchievementReportController extends Controller
{
        public function importsalesach(Request $request)
        {
            $request->validate([
                'csvfile' => 'required|mimes:csv,txt',
            ]);
    
            $file = $request->file('csvfile');
    
            $filePath = $file->storeAs('csvfiles', $file->getClientOriginalName());
    
            $data = array_map('str_getcsv', file(storage_path('app/' . $filePath)));
            
            try{
            foreach ($data as $row) {
                SalesAchs::create([
                    'dc' => $row[0],
                'sales_name' => $row[1],
                'sales_category' => $row[2],
                'target_all_brand' => (double)$row[3],
                'ach_all_brand' => (double)$row[4],
                'all_brand_persen' => (double)$row[5],
                'target_wardah' => (double)$row[6],
                'ach_wardah' => (double)$row[7],
                'wardah_persen' => (double)$row[8],
                'target_mo' => (double)$row[9],
                'ach_mo' => (double)$row[10],
                'mo_persen' => (double)$row[11],
                'target_emina' => (double)$row[12],
                'ach_emina' => (double)$row[13],
                'emina_persen' => (double)$row[14],
                'target_putri' => (double)$row[15],
                'ach_putri' => (double)$row[16],
                'putri_persen' => (double)$row[17],
                'target_kahf' => (double)$row[18],
                'ach_kahf' => (double)$row[19],
                'kahf_persen' => (double)$row[20],
                'target_ip' => (double)$row[21],
                'ach_ip' => (double)$row[22],
                'ip_persen' => (double)$row[23],
                'target_cl' => (double)$row[24],
                'ach_cl' => (double)$row[25],
                'cl_persen' => (double)$row[26],
                'target_biodef' => (double)$row[27],
                'ach_biodef' => (double)$row[28],
                'biodef_persen' => (double)$row[29],
                'target_omg' => (double)$row[30],
                'ach_omg' => (double)$row[31],
                'omg_persen' => (double)$row[32],
                'target_wonderly' => (double)$row[33],
                'ach_wonderly' => (double)$row[34],
                'wonderly_persen' => (double)$row[35],
                'target_labore' => (double)$row[36],
                'ach_labore' => (double)$row[37],
                'labore_persen' => (double)$row[38],
                'target_tavi' => (double)$row[39],
                'ach_tavi' => (double)$row[40],
                'tavi_persen' => (double)$row[41],
            ]);
            }
            Session::flash('success', 'Your data have been saved successfully');
            return redirect()->route('salesachadmin');
        }   catch (\Exception $e) {
            Session::flash('error', 'Failed to upload file. Please check the file format and try again.');
            return redirect()->back();
        }
    }

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
    }
