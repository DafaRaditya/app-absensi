@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">

                    <!-- Script SweetAlert -->
                        @include('komponen.pesan')

                   @yield('konten')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
