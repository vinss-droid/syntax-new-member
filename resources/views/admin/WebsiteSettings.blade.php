@extends('layouts.Bootstrap')
@section('content')

@php
    $number = $settings->admin_contact;
    $symbol = str_replace('+', '', substr($number, '0', '1'));
    $country_code = str_replace('62', '0', substr($number, '1', '2'));
    $admin_contact = $country_code . substr($number, 3, 14);
@endphp

<div class="container">
    <div class="row justify-content-center row-dashboard">
        <div class="col-sm-12 col-md-12 col-lg-10">
            <div class="card shadow">
                <div class="card-body">
                    <h4 class="text-center text-uppercase fw-bold mt-3 mb-4">
                        website settings
                    </h4>
                    <hr>
                    <div class="row justify-content-center my-4">
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <label for="admin-contact" class="form-label">
                                Admin Contact
                            </label>
                            <input type="number" class="form-control" id="admin-contact" placeholder="contoh: 08123456789" value="{{ $admin_contact }}">
                            <div class="invalid-feedback" id="invalid-admin-contact"></div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <label for="whatsapp-group-link" class="form-label">
                                WhatsApp Group Link
                            </label>
                            <input type="url" class="form-control" id="whatsapp-group-link" placeholder="contoh: https://chat.whatsapp.com/" value="{{ $settings->whatsapp_group_link }}">
                            <div class="invalid-feedback" id="invalid-whatsapp-group-link"></div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <label for="discord-server-link" class="form-label">
                                Discord Server Link
                            </label>
                            <input type="url" class="form-control" id="discord-server-link" placeholder="contoh: https://discord.gg/" value="{{ $settings->discord_server_link }}">
                            <div class="invalid-feedback" id="invalid-discord-server-link"></div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="mb-4">
                                <label for="register_start_at" class="form-label">
                                    Register Start At
                                </label>
                                <input type="datetime-local" class="form-control" id="register_start_at" value="{{ date('Y-m-d\TH:i:s', strtotime($settings->register_start_at)) }}">
                                <div class="invalid-feedback" id="invalid-register-start-at"></div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="mb-5">
                                <label for="register_end_at" class="form-label">
                                    Register End At
                                </label>
                                <input type="datetime-local" class="form-control" id="register_end_at" value="{{ date('Y-m-d\TH:i:s', strtotime($settings->register_end_at)) }}">
                                <div class="invalid-feedback" id="invalid-register-end-at"></div>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid mb-4">
                        <button class="btn btn-save shadow" id="saveSettings">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan
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