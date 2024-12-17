<?php

use App\Http\Controllers\ForecastController;
use App\Models\VisitorData;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitorsController;


// Route::get('/', function () {
//     return view('home', ['title' => 'Dashboard']);
// });

// Route::get('/data',  function () {
//     $visit = VisitorData::all();
//     return view('data', ['title' => 'Data Forecasting', 'visit' => $visit]);
// });

// Route::get('/forecasting', function () {
//     return view('forecasting', ['title' => 'Forecasting']);
// });

// Route::get('/about', function () {
//     return view('about', ['title' => 'About']);
// });

Route::get('/', [ForecastController::class, 'forecastHome']);
Route::get('/data',  [VisitorsController::class, 'tampilDataDanForm'])->name('data');
Route::get('/forecasting', [ForecastController::class, 'forecast']);
Route::post('/data/simpan', [VisitorsController::class, 'simpanData'])->name('simpan.data');
Route::get('/about', [ForecastController::class, 'forecastNext']);