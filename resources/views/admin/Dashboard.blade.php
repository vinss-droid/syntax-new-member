@extends('layouts.Bootstrap')
@section('content')

<div class="container">
    <div class="row justify-content-center row-dashboard">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <h4 class="text-center text-uppercase fw-bold mt-3 mb-4">
                            new member syntax id
                        </h4>
                        <hr>
                        <table class="table table-hover table-bordered text-center" id="newMember">
                            <thead>
                                <tr>
                                    <th class="col-1 text-center">No</th>
                                    <th class="col-2 text-center">Nama</th>
                                    <th class="col-2 text-center">Jurusan</th>
                                    <th class="col-2 text-center">WhatsApp</th>
                                    <th class="col-2 text-center">Email</th>
                                    <th class="col-3 text-center">Alasan</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($newMembers as $newMember)
                                
                                    <tr>
                                        <td class="col-1">
                                            {{ $no++ }}
                                        </td>
                                        <td class="col-2">
                                            {{ $newMember->nama }}
                                        </td>
                                        <td class="col-2">
                                            {{ $newMember->jurusan }}
                                        </td>
                                        <td class="col-2">
                                            <a href="https://wa.me/{{ $newMember->wa }}" class="btn btn-success btn-sm shadow" target="_blank">
                                                <i class="fa-brands fa-whatsapp"></i> {{ $newMember->wa }}
                                            </a>
                                        </td>
                                        <td class="col-2">
                                            <a href="mailto:{{ $newMember->email }}" class="btn btn-primary btn-sm shadow">
                                                <i class="fa-solid fa-envelope"></i> {{ $newMember->email }}
                                            </a>
                                        </td>
                                        <td class="col-3">
                                            {{ $newMember->alasan }}
                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script src="{{ asset('js/admin.js') }}"></script>

    @if (session('websettingsNotFound'))

    <script>

        $(document).ready(function () {
            
            Swal.fire(
                'Warning',
                'Record table settings not found, insert one data to table settings to view website-settings',
                'warning'
            );

        });

    </script>
        
    @endif

@endsection