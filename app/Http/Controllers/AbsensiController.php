<?php

namespace App\Http\Controllers;

use App\Exports\AbsensiExport;
use Carbon\Carbon;
use App\Models\Absensi;
use App\Models\Karyawan;
use Illuminate\Http\Request;
// package maat website
use Maatwebsite\Excel\Facades\Excel;

class AbsensiController extends Controller
{
    public function index(Request $request) 
    {
        $tanggalHariIni = Carbon::now()->toDateString();
        $absensi = Absensi::where('tanggal', $tanggalHariIni)->get();

        return view('content.data', compact('absensi'));

        

}
    // fungsi pencarian berdasarkan tanngal
    public function search(Request $request)
    {
        $tanggal = $request->tanggalAbsen;
        $absensi = Absensi::where('tanggal', $tanggal)->get();

        return view('content.data', compact('absensi'));
    }

    // fungsi yg menampilkan data  untuk absensi bulanan dari db
    public function dataBulanan(Request $request)
    {
        // variabel yg isinya inputan dgn name bulan yang terdapat value year-month,atau nilai defaultnya year-month saat program dijalankan
        $bulan = $request->input('bulan', Carbon::now()->format('Y-m'));
        
        $absensi = Absensi::whereMonth('tanggal', Carbon::parse($bulan)->month)->whereYear('tanggal', Carbon::parse($bulan)->year)->get();

        return view('content.data-bulanan', compact('absensi', 'bulan'));
    }

    // fungsi untuk export ke excel pakai package maatwebsite
    public function absensiExport(Request $request){
        // variabel yg isinya inputan dgn name bulan yang terdapat value year-month,atau nilai defaultnya year-month saat program dijalankan
        $bulan = $request->input('bulan', Carbon::now()->format('Y-m'));

        return Excel::download(new AbsensiExport($bulan), 'Absensi-' . $bulan . '.xlsx');
    }

    public function create()
    {
        return view('index');
    }
    
    // fungsi yang melakukan oenambahan data absen ke db
    public function store(Request $request)
    {
        // validasi inputan absen
        $request->validate([
            'nik' => 'required|exists:karyawan,nik',
        ],[
            'nik.exists' => 'NIK tidak terdaftar sebagai karyawan',
        ]);
    
        // ambil data karyawan berdasarakan nik inputan
        $karyawan = Karyawan::where('nik', $request->nik)->first();
    
        // kondisi jika karyawan tidak terdaftar/ada di db
        if (!$karyawan) {
            return redirect()->route('absensi.create')->with('error', 'NIK tidak terdaftar sebagai karyawan');
        }
    
        // validasi jika sudah melakukan absensi
        $sudahHadir = Absensi::where('nik', $request->nik)
            ->whereDate('tanggal', now()->toDateString())
            ->first();
    
            // pengkondisian jika karyawan yg sudah absensi/melakukan lebih dari 1 kali per hari
        if ($sudahHadir) {
            return redirect()->route('absensi.create')->with('error', 'Absensi sudah tercatat untuk hari ini');
        }
    
        // insert data ke db , data sesuai dgn inputan dari karyawan,dan waktu/tgl sesuai kode di eksekusi 
        Absensi::create([
            'nik' => $karyawan->nik,
            'nama' => $karyawan->nama,
            'jabatan' => $karyawan->jabatan,
            'pukul'=> now()->format('H:i:s'),
            'tanggal' => now()->toDateString(),
        ]);
    
        return redirect()->route('absensi.create')->with('success', 'Absensi berhasil disimpan');
    }
}
