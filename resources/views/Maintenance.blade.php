@extends('layouts.Bootstrap')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-12 col-lg-8">
                <h1 class="text-center text-uppercase text-white fw-bold text-maintenance">
                    automatic maintenance website
                </h1>
                <p class="text-center fw-bold text-secondary">
                    Automatic maintenance has been reported to the admin. <br>
                    {{ date('d F Y, H:i:s') }} 
                    <br>
                    Your ip : {{ request()->ip() }}
                </p>
                <div align="center" class="mt-4">
                    <button class="btn btn-save shadow" onclick="window.location.href = 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'">
                        Try Again
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection