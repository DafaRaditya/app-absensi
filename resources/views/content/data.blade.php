
@extends('home')
@section('konten')
<div class="d-flex justify-content-between mb-3">
    <div>
    </div>
    <div class="d-flex justify-content-end">
        <a href="{{ url('admin/data-bulanan') }}" class="btn btn-success me-2">Data Bulanan</a>
        <form action="{{ route('absensi.search') }}" method="POST" class="d-flex">
            @csrf
            <input type="date" class="form-control me-2" name="tanggalAbsen" value="{{ \Carbon\Carbon::now()->toDateString() }}">
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3>Data Absensi</h3>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Pukul</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($absensi as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->nik }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>{{ $data->jabatan }}</td>
                        <td>{{ $data->pukul }}</td>
                        <td>{{ $data->tanggal }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- @if (!Request::is('admin/data?filter=today'))
        {{ $absensi->links() }}
        @endif --}}
    </div>
</div>
@endsection
