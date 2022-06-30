$(document).ready(function () {
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#login').dblclick(function(e) {

        e.preventDefault();

        window.location.href = '/login';

    });

    $('#simpan').click(function (e) { 
        e.preventDefault();
        
        const nama = $('#nama').val();
        const jurusan = $('#jurusan').val();
        const wa = $('#wa').val();
        const email = $('#email').val();
        const alasan = $('#alasan').val();

        validateNewMember(nama,jurusan,wa,email,alasan);

    });

    $('#resend').click(function (e) { 
        e.preventDefault();
        
        $('#Mresend').modal('show');

    });

    $('#mcancel').click(function (e) { 
        e.preventDefault();
        
        $('#FMresend').trigger('reset');

        $('#malert').addClass('d-none');

        $('#Mresend').modal('hide');

    });

    $('#msend').click(function (e) { 
        e.preventDefault();
        
        const email = $('#memail').val();

        validateResendMail(email);

    });

    $('#sendMail').click(function (e) { 
        e.preventDefault();
        
        const email = $(this).data('member-email');

        sendMail(email);

    });

});