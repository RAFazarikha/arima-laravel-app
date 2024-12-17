<?php

namespace App\Http\Controllers;

use App\Models\Arima;
use App\Models\VisitorData;
use Illuminate\Http\Request;

class ForecastController extends Controller
{
    public function forecast(Request $request)
    {
        // Ambil data visit
        $visit = VisitorData::all();

        // Ambil data jumlah pengunjung untuk forecasting
        $data = VisitorData::pluck('jumlah_pengunjung')->toArray();
        $p = 1; // Orde autoregressif
        $d = 1; // Orde differencing
        $q = 1; // Orde moving average

        // Lakukan perhitungan ARIMA
        $arima = new Arima();
        $hasil = $arima->calculate($data, $p, $d, $q);

        // Gabungkan $visit dan $hasil
        $combinedData = $visit->map(function ($item, $index) use ($hasil) {
            return [
                'visit' => $item,
                'forecast' => $hasil[$index] ?? null, // Pastikan indeks tidak melebihi hasil
            ];
        });

        // Kirimkan data gabungan ke view
        return view('forecasting', [
            'title' => 'Forecasting',
            'combinedData' => $combinedData,
        ]);
    }

    public function forecastHome(Request $request)
    {
        // Ambil data visit
        $visit = VisitorData::selectRaw("CONCAT(tahun, '-', bulan) as tahun_bulan")->get();;
        $label = $visit->pluck('tahun_bulan')->toArray();



        // Ambil data jumlah pengunjung untuk forecasting
        $data = VisitorData::pluck('jumlah_pengunjung')->toArray();
        $p = 1; // Orde autoregressif
        $d = 1; // Orde differencing
        $q = 1; // Orde moving average

        // Lakukan perhitungan ARIMA
        $arima = new Arima();
        $hasil = $arima->calculate($data, $p, $d, $q);

        // Gabungkan $visit dan $hasil
        // $combinedData = $visit->map(function ($item, $index) use ($hasil) {
        //     return [
        //         'visit' => $item,
        //         'forecast' => $hasil[$index] ?? null, // Pastikan indeks tidak melebihi hasil
        //     ];
        // });

        // Kirimkan data gabungan ke view
        return view('home', [
            'title' => 'Forecasting Jumlah Pengunjung Objek Wisata Di Kabupaten Temanggung',
            'label' => $label,
            'data' => $data,
            'hasil' => $hasil
        ]);
    }

    public function forecastNext(Request $request)
    {
        // Ambil data visit
        $visit = VisitorData::all();

        // Ambil data jumlah pengunjung untuk forecasting
        $data = VisitorData::pluck('jumlah_pengunjung')->toArray();
        $p = 1; // Orde autoregressif
        $d = 1; // Orde differencing
        $q = 1; // Orde moving average

        // Lakukan perhitungan ARIMA
        $arima = new Arima();
        $hasil = $arima->calculate($data, $p, $d, $q);

        $dump = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        // // Gabungkan $visit dan $hasil
        // $combinedData = $visit->map(function ($item, $index) use ($hasil) {
        //     return [
        //         'visit' => $item,
        //         'forecast' => $hasil[$index] ?? null, // Pastikan indeks tidak melebihi hasil
        //     ];
        // });

        // Kirimkan data gabungan ke view
        return view('about', [
            'title' => 'Forecasting 12 Bulan Selanjutnya',
            'visit' => $visit,
            'forecast' => $hasil,
            'dump' => $dump,
        ]);
    }
}
