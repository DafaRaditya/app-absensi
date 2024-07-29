@extends('home')
@section('konten')
    <!-- START DATA -->
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <!-- TOMBOL TAMBAH DATA -->
        <div class="pb-3 d-flex justify-content-end">
            <!-- Modal HTML -->
            <div class="modal fade" id="karyawanModal" tabindex="-1" aria-labelledby="karyawanModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="karyawanModalLabel">Formulir Karyawan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @if ($errors->any())
                                <div class="pt-3">
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $item)
                                                <li>{{$item}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
            
                            <!-- START FORM -->
                            <form id="karyawanForm" action='{{ url('admin/karyawan') }}' method='post'>
                                @csrf
                                <div class="mb-3 row">
                                    <label for="nik" class="col-sm-4 col-form-label">Nik:</label>
                                    <div class="col-sm-8">
                                        <input type="number" autocomplete="off" class="form-control" name='nik' id="nik">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="nama" class="col-sm-4 col-form-label">Nama:</label>
                                    <div class="col-sm-8">
                                        <input type="text" autocomplete="off" class="form-control" name='nama' id="nama">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="jabatan" class="col-sm-4 col-form-label">Jabatan:</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="jabatan" id="jabatan">
                                            <option value="" disabled selected>Pilih Jabatan Disini</option>
                                            <option value="Guru Umum">Guru Umum</option>
                                            <option value="Guru Jurusan">Guru Jurusan</option>
                                            <option value="Staff">Staf</option>
                                            <option value="Administrasi">Administrasi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    {{-- <div class="col-sm-8 offset-sm-4">
                                        
                                    </div> --}}
                                </div>
                            <!-- AKHIR FORM -->
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>

                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <button type="button" class="btn btn-primary me-1" data-bs-toggle="modal" data-bs-target="#karyawanModal">
                + Tambah Data
            </button>
            
  
            {{-- <a href='{{ url('admin/karyawan/create') }}' class="btn mx-2 btn-info">+ Tambah Data</a> --}}
            <form class="d-flex" action="{{ route('karyawan.index') }}" method="GET">
                <input type="search" class="form-control me-2" placeholder="Cari Data Karyawan" name="katakunci" value="{{ Request::get('katakunci') }}" aria-label="Search">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col-md-1">No</th>
                    <th class="col-md-3">Nik</th>
                    <th class="col-md-4">Nama</th>
                    <th class="col-md-2">Jabatan</th>
                    <th class="col-md-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = $data->firstItem() ?>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $item->nik }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->jabatan }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <a href="{{ url('admin/karyawan/'.$item->nik.'/edit') }}" class="btn btn-warning btn-sm me-1"><i class="fa-regular fa-pen-to-square"></i></a>

                                <form class="delete-form d-inline" action="{{ url('admin/karyawan/'.$item->nik) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" name="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php $i++ ?>
                @endforeach
            </tbody>
        </table>
        {{ $data->links() }}
    </div>
    <!-- AKHIR DATA -->
@endsection