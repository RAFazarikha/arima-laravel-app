<?php

namespace App\Http\Controllers;

use App\Models\VisitorData;
use Illuminate\Http\Request;

class VisitorsController extends Controller
{
    // Menampilkan data dan form
    public function tampilDataDanForm()
    {
        $visit = VisitorData::all(); // Ambil data dari database
        return view('data', [
            'title' => 'Data Forecasting',
            'visit' => $visit
        ]);
    }

    
    // Menyimpan data dari form
    public function simpanData(Request $request)
    {
        // Validasi input
        $request->validate([
            'tahun' => 'required|string',
            'bulan' => 'required|string',
            'jumlah_pengunjung' => 'required|integer'
        ]);

        // Simpan data ke database
        VisitorData::create([
            'tahun' => $request->tahun,
            'bulan' => $request->bulan,
            'jumlah_pengunjung' => $request->jumlah_pengunjung,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('data')->with('success', 'Data berhasil ditambahkan!');
    }
}
