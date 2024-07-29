<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class AbsensiExport implements FromCollection, WithHeadings
{

    protected $bulan;

    // tangkap value bulan dari fungsi export
    public function __construct($bulan)
    {
        $this->bulan = $bulan;
    }

    public function collection()
    {
        
        return Absensi::whereMonth('tanggal', Carbon::parse($this->bulan)->month) // Memfilter berdasarkan bulan
        ->whereYear('tanggal', Carbon::parse($this->bulan)->year) // Memfilter berdasarkan tahun
        ->select('nik', 'nama', 'jabatan', 'pukul', 'tanggal') // Memilih kolom yang akan disertakan dalam ekspor
        ->get(); // Mengambil data sebagai koleksi

                       
                       
            
         }

    
        //    Header ini akan digunakan sebagai baris pertama pada file Excel yang dihasilkan.

    public function headings(): array
    {
        return [
            'Nik',
            'Nama Karyawan',
            'Jabatan',
            'pukul',
            'Tanggal',
        ];
    }
}
