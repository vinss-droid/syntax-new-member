@extends('layouts.Bootstrap')
@section('content')

<div class="container">
    <div class="row justify-content-center mb-5 row-custom">

        <div class="col-sm-12 col-md-12 col-lg-6 mt-countdown d-none" id="registerEnd">
            <div class="card shadow">
                <div class="card-body">
                    <h4 class="text-center text-uppercase fw-bold">
                        Pendaftaran anggota baru syntax sudah ditutup pada tanggal
                    </h4>
                    <hr>
                    <h3 class="text-center fw-bold text-danger my-4" id="registerEndAt"></h3>
                    <hr>
                    <div class="d-block" align="center">
                        <a type="button" class="text-decoration-none fw-bold my-2" data-bs-toggle="modal" data-bs-target="#Mresend">
                            Kirim ulang link grup wa & discord server!
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-sm-12 col-md-12 col-lg-6 mt-countdown 
        {{ session()->has('success') ? 'd-none' : '' }}" id="countdown-timer">
            <div class="card shadow">
                <div class="card-body">
                    <h4 class="text-center text-uppercase fw-bold">
                        Pendaftaran anggota baru syntax akan dibuka dalam
                    </h4>
                    <hr>
                    <div class="row justify-content-center my-4 count-down-main">
                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <h3 class="text-center fw-bold text-success" id="days"></h3>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <h3 class="text-center fw-bold text-success" id="hours"></h3>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <h3 class="text-center fw-bold text-success" id="minutes"></h3>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <h3 class="text-center fw-bold text-success" id="seconds"></h3>
                        </div>
                    </div>
                    <h3 class="text-center text-success fw-bold my-4 countdown-992-px">
                        <span id="days"></span> 
                        <span id="hours"></span> 
                        <span id="minutes"></span> 
                        <span id="seconds"></span>
                    </h3>
                </div>
            </div>
        </div>

        @if (!session()->has('success'))
        
            <div class="col-sm-12 col-md-12 col-lg-6 d-none" id="main-content">
                <div class="card shadow">
                    <div class="card-body">
                        <h4 class="text-center text-secondary user-select-none fw-bold text-uppercase my-2">
                            Pendaftaran anggota baru syntax
                        </h4>
                        <h4 class="text-center text-secondary user-select-none fw-bold text-uppercase my-2">
                            tahun {{ date('Y') }}
                        </h4>
                        <hr>
                        <div class="container mt-4">
                            <form autocomplete="off">
                                <div class="mt-3 mb-4">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-address-card"></i>
                                        </span>
                                        <input type="text" class="form-control" id="nama" placeholder="contoh: Budi"
                                            autofocus>
                                        <div class="invalid-feedback" id="invalid-nama"></div>
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <label for="jurusan" class="form-label">Jurusan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-graduation-cap"></i>
                                        </span>
                                        <select id="jurusan" class="form-select text-center">
                                            <option value="" selected>--- Pilih Jurusan ---</option>
                                            <option value="REKAYASA PERANGKAT LUNAK">REKAYASA PERANGKAT LUNAK</option>
                                            <option value="TEKNIK KOMPUTER DAN JARINGAN">TEKNIK KOMPUTER DAN JARINGAN
                                            </option>
                                            <option value="MULTIMEDIA">MULTIMEDIA</option>
                                            <option value="TEKNIK TRANSMISI TELEKOMUNIKASI">TEKNIK TRANSMISI TELEKOMUNIKASI
                                            </option>
                                        </select>
                                        <div class="invalid-feedback" id="invalid-jurusan"></div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="wa" class="form-label">No. WhatsApp</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa-brands fa-whatsapp"></i>
                                        </span>
                                        <input type="number" class="form-control" id="wa" placeholder="contoh: 0123456789">
                                        <div class="invalid-feedback" id="invalid-wa"></div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="email" class="form-label">Email Pribadi Aktif</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-envelope"></i>
                                        </span>
                                        <input type="email" class="form-control" id="email"
                                            placeholder="contoh: email@gmail.com">
                                        <div class="invalid-feedback" id="invalid-email"></div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="alasan" class="form-label">Alasan Masuk Syntax</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-comment"></i>
                                        </span>
                                        <textarea id="alasan" cols="8" rows="3" class="form-control"
                                            placeholder="contoh: ingin belajar pemrograman"></textarea>
                                        <div class="invalid-feedback" id="invalid-alasan"></div>
                                    </div>
                                </div>
                                <div class="d-grid mb-3">
                                    <button class="btn btn-save shadow" id="simpan">
                                        <i class="fa-solid fa-floppy-disk"></i> Simpan
                                    </button>
                                </div>
                                <div class="mb-4" align="center">
                                    <a type="button" class="text-decoration-none fw-bold" id="resend">
                                        Kirim ulang link grup wa & discord server!
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        
        @else

            @php
                $member = session()->get('success');
            @endphp

            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-sm-12 col-md-12 col-lg-6 d-inline-block" align="center">
                                <img src="{{ asset('img/success.png') }}" alt="success.png" width="80%">
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 card">
                                <h4 class="text-center text-success text-uppercase fw-bold mt-4">
                                    Horee!! kamu berhasil Mendaftar Menjadi Anggota Baru syntax id
                                </h4>
                                <hr>
                                <p class="text-justify mb-3" align="justify">
                                    Hi {{ $member['nama'] }}, <br><br>
                                    kamu berhasil mendaftar menjadi anggota baru di Syntax ID. <br> 
                                    Link Grup WhatsApp dan Server Discord Syntax sudah dikirim ke email kamu di <strong>{{ $member['email'] }}</strong>. <br> <br>
                                    Jika kamu tidak menerima email tersebut kamu bisa cek kembali di kotak spam email atau dengan mengirim ulang email dengan menekan tombol di bawah.
                                </p>
                                <div class="d-grid mb-4">
                                    <button class="btn btn-save btn-sm shadow" data-member-email="{{ $member['email'] }}" id="sendMail">
                                        <i class="fa-solid fa-paper-plane"></i> Kirim ulang email
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        @endif

    </div>
</div>

{{-- Modal Resend Link --}}
<div class="modal fade" id="Mresend" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
               
                <h5 class="text-center">
                    Kirim Ulang Link Grup WhatsApp & Discord Server
                </h5>

                <hr>

                <form id="FMresend">
                    
                    <div class="alert alert-danger d-none text-center fw-bold" role="alert" id="malert"></div>

                    <div class="mb-4">
                        <label for="Memail" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa-solid fa-envelope"></i>
                            </span>
                            <input type="email" class="form-control" id="memail"
                                placeholder="contoh: email@gmail.com">
                            <div class="invalid-feedback" id="invalid-memail"></div>
                        </div>
                    </div>
                    <div class="d-grid mb-4">
                        <button class="btn btn-save btn-sm shadow" id="msend">
                            <i class="fa-solid fa-paper-plane"></i> Kirim
                        </button>
                        <button class="btn btn-outline-secondary btn-sm shadow mt-1" id="mcancel">
                            Batal
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection

@section('js')

<script src="{{ asset('js/member.js') }}"></script>

@if (!session()->has('success'))

<script src="{{ asset('js/countdownTimer.js') }}"></script>

@endif

@endsection