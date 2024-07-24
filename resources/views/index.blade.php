@extends('layouts.template')
@section('konteng')
<div class="card mx-auto mt-5" style="max-width: 500px;">
    <div class="card-header text-center bg-light text-white">
        <h3 class="text-dark">Absensi</h3>
    </div>
    <div class="card-body">
      @include('komponen.pesan')
        
        <form action="{{ route('absensi.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nik" class="form-label">Masukan Nik:</label>
                <input type="number" inputmode="numeric" name="nik" id="nik" class="form-control" autocomplete="off" required>
            </div>
            <button type="submit" class="btn mt-3 btn-primary w-100">Submit</button>
        </form>
    </div>
</div>
@endsection
