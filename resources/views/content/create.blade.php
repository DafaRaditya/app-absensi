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
<form action='{{ url('admin/karyawan') }}' method='post' class="mt-4">
    @csrf
    <div class="mb-3 row">
        <label for="nik" class="col-sm-2 col-form-label">Nik:</label>
        <div class="col-sm-10">
            <input type="number" autocomplete="off" value="{{Session::get('nik')}}" class="form-control" name='nik' id="nik">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="nama" class="col-sm-2 col-form-label">Nama:</label>
        <div class="col-sm-10">
            <input type="text" autocomplete="off" value="{{Session::get('nama')}}" class="form-control" name='nama' id="nama">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="jabatan" class="col-sm-2 col-form-label">Jabatan:</label>
        <div class="col-sm-10">
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
        <div class="col-sm-10 offset-sm-2">
            <button type="submit" class="btn btn-primary float-end">SIMPAN</button>
        </div>
    </div>
</form>
<!-- AKHIR FORM -->

@endsection
