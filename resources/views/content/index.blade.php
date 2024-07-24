@extends('home')
@section('konten')
    <!-- START DATA -->
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <!-- TOMBOL TAMBAH DATA -->
        <div class="pb-3 d-flex justify-content-end">
            <a href='{{ url('admin/karyawan/create') }}' class="btn mx-2 btn-info">+ Tambah Data</a>
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
