<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function downloadTemplate()
    {
        $filePath = public_path('download/templatereport.csv');
        $headers = [
            'Content-Type' => 'text/csv',
        ];
        return Response::download($filePath, 'templatereport.csv', $headers);
    }

    public function downloadTemplate2()
    {
        $filePath = public_path('download/templatesalesach.csv');
        $headers = [
            'Content-Type' => 'text/csv',
        ];
        return Response::download($filePath, 'templatesalesach.csv', $headers);
    }

    public function downloadTemplate3()
    {
        $filePath = public_path('download/templatesalesscore.csv');
        $headers = [
            'Content-Type' => 'text/csv',
        ];
        return Response::download($filePath, 'templatesalesscore.csv', $headers);
    }
}