<?php

namespace App\Http\Controllers;
use App\Models\SalesAchs;
use Illuminate\Http\Request;

class SalesAchievementReportController extends Controller
{
        public function salesach(Request $request){
            return view('admin.salesachadmin');
        }
        public function importsalesach(Request $request)
        {
            $request->validate([
                'csvfile' => 'required|mimes:csv,txt',
            ]);
    
            $file = $request->file('csvfile');
    
            $filePath = $file->storeAs('csvfiles', $file->getClientOriginalName());
    
            $data = array_map('str_getcsv', file(storage_path('app/' . $filePath)));
            
            foreach ($data as $row) {
                SalesAchs::create([
                    'dc' => $row[0],
                'sales_name' => $row[1],
                'sales_category' => $row[2],
                'target_all_brand' => (double)$row[3],
                'ach_all_brand' => (double)$row[4],
                'all_brand_%' => (double)$row[5],
                'target_wardah' => (double)$row[6],
                'ach_wardah' => (double)$row[7],
                'wardah_%' => (double)$row[8],
                'target_mo' => (double)$row[9],
                'ach_mo' => (double)$row[10],
                'mo_%' => (double)$row[11],
                'target_emina' => (double)$row[12],
                'ach_emina' => (double)$row[13],
                'emina_%' => (double)$row[14],
                'target_putri' => (double)$row[15],
                'ach_putri' => (double)$row[16],
                'putri_%' => (double)$row[17],
                'target_kahf' => (double)$row[18],
                'ach_kahf' => (double)$row[19],
                'kahf_%' => (double)$row[20],
                'target_ip' => (double)$row[21],
                'ach_ip' => (double)$row[22],
                'ip_%' => (double)$row[23],
                'target_cl' => (double)$row[24],
                'ach_cl' => (double)$row[25],
                'cl_%' => (double)$row[26],
                'target_biodef' => (double)$row[27],
                'ach_biodef' => (double)$row[28],
                'biodef_%' => (double)$row[29],
                'target_omg' => (double)$row[30],
                'ach_omg' => (double)$row[31],
                'omg_%' => (double)$row[32],
                'target_wonderly' => (double)$row[33],
                'ach_wonderly' => (double)$row[34],
                'wonderly_%' => (double)$row[35],
                'target_labore' => (double)$row[36],
                'ach_labore' => (double)$row[37],
                'labore_%' => (double)$row[38],
                'target_tavi' => (double)$row[39],
                'ach_tavi' => (double)$row[40],
                'tavi_%' => (double)$row[41],
            ]);
            }
                return redirect()->route('salesachadmin');
        }   
    }
