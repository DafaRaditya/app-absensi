@extends('home')
@section('konten')
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
<form action='{{ url('admin/karyawan/'. $data->nik) }}' method='post' class="mt-4">
    @csrf
    @method('PUT')
    <div class="mb-3 row">
        <label for="nik" class="col-sm-2 col-form-label">NIK</label>
        <div class="col-sm-10">
            <input type="number" value="{{ $data->nik }}" class="form-control" name='nik' id="nik" readonly>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-10">
            <input type="text" value="{{ $data->nama }}" class="form-control" name='nama' id="nama">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
        <div class="col-sm-10">
            <select class="form-control" name="jabatan" id="jabatan">
                <option value="Guru Umum" {{ $data->jabatan == 'Guru Umum' ? 'selected' : '' }}>Guru Umum</option>
                <option value="Guru Jurusan" {{ $data->jabatan == 'Guru Jurusan' ? 'selected' : '' }}>Guru Jurusan</option>
                <option value="Staff" {{ $data->jabatan == 'Staff' ? 'selected' : '' }}>Staf</option>
                <option value="Administrasi" {{ $data->jabatan == 'Administrasi' ? 'selected' : '' }}>Administrasi</option>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-10 offset-sm-2">
            <button type="submit" class="btn btn-primary float-end">SIMPAN</button>
        </div>
    </div>
</form>
<!-- AKHIR FORM -->

@endsection
