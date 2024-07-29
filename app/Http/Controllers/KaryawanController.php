<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cari = $request->katakunci;
        $data = karyawan::where('nik', 'like', '%'.$cari.'%')
            ->orWhere('nama', 'like', '%'.$cari.'%')
            ->orWhere('jabatan', 'like', '%'.$cari.'%')
            ->orderBy('nik', 'asc')
            ->paginate(5);
    
        return view('content.index', compact('data'));
    }
    
    
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404,'Halaman tidak ditemukan');;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'nik' => 'required|numeric|unique:karyawan,nik',
            'nama' => 'required',
            'jabatan' => 'required',
        ], [
            'nik.required' => 'Nik Wajib Diisi',
            'nik.numeric' => 'Nik Wajib angka',
            'nik.unique' => 'Nik Sudah Dipakai',
            'nama.required' => 'Nama Wajib Diisi',
            'jabatan.required' => 'Jabatan Wajib Diisi',
        ]);
    
        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422); 
        }
    
        // Jika validasi sukses
        $data = [
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
        ];
    
        karyawan::create($data);
    
        return response()->json([
            'success' => true,
            'message' => 'Data karyawan berhasil disimpan.',
        ]);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = karyawan::where('nik', $id)->first();
        return view('content.edit')->with('data', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validasi edit data
        $request->validate([
            'nik' => 'required|numeric',
            'nama' => 'required',
            'jabatan' => 'required',
        ], [
            'nik.required' => 'Nik Wajib Diisi',
            'nik.numeric' => 'Nik Wajib angka',
            'nama.required' => 'Nama Wajib Diisi',
            'jabatan.required' => 'Jabatan Wajib Diisi',
        ]);
    
        $data = [
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
        ];
    
        // Update data karyawan
        Karyawan::where('nik', $id)->update($data);
    
        Absensi::where('nik', $id)
            ->update(['nama' => $request->nama]);
    
        return redirect()->route('karyawan.index')->with('success', 'Data karyawan dan absensi berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       karyawan::where('nik', $id)->delete();
       return redirect()->to('admin/karyawan')->with('success', 'Data Berhasil Dihapus');
    }
}
