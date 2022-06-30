<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pendaftaran Anggota Baru Syntx.id</title>
    {{-- ICON --}}
    <link rel="shortcut icon" href="{{ asset('img/syntax.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('img/syntax.png') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    {{-- MY CSS --}}
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Signika+Negative:wght@300;400&display=swap" rel="stylesheet">
    {{-- DataTables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css">
</head>
<body class="{{ !Request::is('maintenance') ? 'bg-new-member' : 'bg-dark' }}">
    

    @if (!Request::is('login'))
        
        @if (!Request::is('maintenance'))
            @include('layouts.Navbar')
        @endif

    @endif

    @yield('content')


    {{-- Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    {{-- jQuery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{-- FontAwesome --}}
    <script src="https://kit.fontawesome.com/768e0ea7cb.js" crossorigin="anonymous"></script>
    {{-- SweetAlert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- MYJS --}}
    <script src="{{ asset('js/functions.js') }}"></script>
    {{-- DataTables --}}
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>
    @yield('js')

</body>
</html>