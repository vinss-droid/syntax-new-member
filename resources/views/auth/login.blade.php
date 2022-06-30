@extends('layouts.Bootstrap')
@section('content')

<div class="container">
    <div class="row justify-content-center row-auth">
        <div class="col-sm-12 col-md-12 col-lg-6">
            <div class="card shadow">
                <div class="card-body">
                    <h4 class="text-center text-uppercase fw-bold">login</h4>
                    <hr>
                    <div class="d-none my-4" id="alert-login">
                        <div class="alert alert-danger text-uppercase fw-bold text-center" role="alert">
                            Email atau Password Salah
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" placeholder="contoh: email@gmail.com" id="email" autofocus>
                        <div class="invalid-feedback" id="invalid-email"></div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" placeholder="contoh: ******" id="password">
                        <div class="invalid-feedback" id="invalid-password"></div>
                    </div>
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="ingatSaya">
                        <label class="form-check-label user-select-none" for="ingatSaya">
                          Ingat Saya
                        </label>
                    </div>
                    <div class="d-grid mb-4">
                        <button class="btn btn-save shadow" id="login">
                            <i class="fa-solid fa-right-to-bracket"></i> Login
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script src="{{ asset('js/admin.js') }}"></script>
@endsection