<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SalesReportController;
use App\Http\Controllers\SalesAchievementReportController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\ChartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Normal Users Routes List
Route::middleware(['auth', 'user-access:user'])->group(function () {
   
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
   
//Admin Routes List
Route::middleware(['auth', 'user-access:admin'])->group(function () {
   
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
    
});

Route::get('/dashboardracing', [PagesController::class, 'dashboardracing'])->name('dashboardracing');
Route::get('/dashboardsales', [PagesController::class, 'dashboardsales'])->name('dashboardsales');

Route::get('/dashboardracingadmin', [PagesController::class, 'dashboardracingadmin'])->name('dashboardracingadmin');
Route::get('/dashboardsalesadmin', [PagesController::class, 'dashboardsalesadmin'])->name('dashboardsalesadmin');

Route::get('/report', [PagesController::class, 'report'])->name('report');
Route::get('/salesach', [PagesController::class, 'salesach'])->name('salesach');
Route::get('/salesscore', [PagesController::class, 'salesscore'])->name('salesscore');

Route::get('/reportadmin', function () {
    return view('admin.reportadmin');
});

Route::get('/salesachadmin', function () {
    return view('admin.salesachadmin');
});

Route::get('/salesscoreadmin', function () {
    return view('admin.salesscoreadmin');
});

Route::get('/report', function () {
    return view('report');
});

Route::get('/salesach', function () {
    return view('salesach');
});

Route::get('/salesscore', function () {
    return view('salesscore');
});


Route::post('/reportadmin', [ReportController::class, 'reportadmin'])->name('reportadmin');
Route::get('/salesachadmin', [SalesAchievementReportController::class, 'salesachadmin'])->name('salesachadmin');
Route::get('/salesscoreadmin', [SalesReportController::class, 'salesscoreadmin'])->name('salesscoreadmin');

Route::post('/import', [ReportController::class, 'import'])->name('import');
Route::get('/import', function (){
return view ('admin.importreport');
});
Route::post('/importsalesach', [SalesAchievementReportController::class, 'importsalesach'])->name('importsalesach');
Route::get('/importsalesach', function (){
    return view ('admin.importsalesach');
    });
Route::post('/importsales', [SalesReportController::class, 'importsales'])->name('importsales');
Route::get('/importsales', function (){
    return view ('admin.importsalesscore');
    });

Route::get('download/template', [DownloadController::class, 'downloadTemplate'])->name('download.template');
Route::get('download/template2', [DownloadController::class, 'downloadTemplate2'])->name('download.template2');
Route::get('download/template3', [DownloadController::class, 'downloadTemplate3'])->name('download.template3');

Route::get('/coba', function () {
    return view('admin.adminHome');
});

Route::get('/reportchartadmin', [ChartController::class, 'tampilkanChart']);
Route::get('/report', [ChartController::class, 'tampilkanReportUser']);
Route::get('/salesach', [ChartController::class, 'tampilkanAchUser']);
Route::get('/salesscore', [ChartController::class, 'tampilkanScoreUser']);