<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class AbsensiExport implements FromCollection, WithHeadings
{
    protected $bulan;

    public function __construct($bulan)
    {
        $this->bulan = $bulan;
    }

    public function collection()
    {
        
       return Absensi::whereMonth('tanggal', Carbon::parse($this->bulan)->month)
        ->whereYear('tanggal', Carbon::parse($this->bulan)->year)
        ->select('nik', 'nama', 'jabatan', 'pukul', 'tanggal')
        ->get();
                       
                       
            
         }

    

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
