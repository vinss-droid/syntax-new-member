function validateNewMember(nama,jurusan,wa,email,alasan)
{
    
    if (nama == '') {
        
        $('#nama').addClass('is-invalid');

        $('#invalid-nama').text(`NAMA WAJIB DI ISI`);

    } else {
        
        $('#nama').removeClass('is-invalid');

    }
    
    if (jurusan == '') {
        
        $('#jurusan').addClass('is-invalid');

        $('#invalid-jurusan').text(`JURUSAN WAJIB DI PILIH`);

    } else {
        
        $('#jurusan').removeClass('is-invalid');

    }
    
    if (wa == '') {
        
        $('#wa').addClass('is-invalid');

        $('#invalid-wa').text(`NO. WHATSAPP WAJIB DI ISI`);

    } else {
        
        $('#wa').removeClass('is-invalid');

    }
    
    if (email == '') {
        
        $('#email').addClass('is-invalid');

        $('#invalid-email').text(`EMAIL WAJIB DI ISI`);

    } else {
        
        $('#email').removeClass('is-invalid');

    }
    
    if (alasan == '') {
        
        $('#alasan').addClass('is-invalid');

        $('#invalid-alasan').text(`ALASAN WAJIB DI ISI`);

    } else {
        
        $('#alasan').removeClass('is-invalid');

    }

    if (nama != '' && jurusan != '' && wa != '' && email != '' && alasan != '') {

        chekWaNumber(nama,jurusan,wa,email,alasan);
        
    }

}


function chekWaNumber(nama,jurusan,wa,email,alasan) 
{
    
    $.ajax({
        type: "GET",
        url: "/chek-whatsapp-number/" + wa,
        success: function (response) {
            
            if (response.error == false && response.return == true) {
                
                checkEmail(nama,jurusan,wa,email,alasan);

            } else {
                
                $('#wa').addClass('is-invalid');

                $('#invalid-wa').text(`NO. WHATSAPP SUDAH TERDAFTAR`);

            }

        }
    });

}

function checkEmail(nama,jurusan,wa,email,alasan) 
{
    
    $.ajax({
        type: "GET",
        url: "/check-email/" + email,
        success: function (response) {

            if (response.error == false && response.return == true) {
                
                saveNewMember(nama,jurusan,wa,email,alasan);

            } else {
                
                $('#email').addClass('is-invalid');

                $('#invalid-email').text(`EMAIL SUDAH TERDAFTAR`);

            }
            
        }
    });

}

function saveNewMember(nama,jurusan,wa,email,alasan) 
{

    $('#simpan').attr('disabled', true);

    $('#simpan').html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
    Loading...`);
    
    $.ajax({
        type: "POST",
        url: "/save-new-member",
        data: {
            'nama': nama,
            'jurusan': jurusan,
            'wa': wa,
            'email': email,
            'alasan': alasan
        },
        success: function (response) {

            if (response.error === false) {
                
                window.location.reload();

            } else {

                Swal.fire(
                    'Gagal',
                    'Gagal menyimpan',
                    'error'
                );
                
            }
            
        }
    });

}

function validateResendMail(email) {
    
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    let isEmail = regex.test(email);

    if (email == '') {
        
        $('#memail').addClass('is-invalid');
        $('#invalid-memail').text('EMAIL WAJIB DI ISI');

    } else {

        if (isEmail) {
            
            $('#memail').removeClass('is-invalid');

            resendLink(email);

        } else {

            $('#memail').addClass('is-invalid');
            $('#invalid-memail').text('EMAIL TIDAK VALID');

        }
        
    }

}

function resendLink(email) {
    
    $('#mcancel').addClass('d-none');

    $('#msend').attr('disabled', true);

    $('#msend').html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
    Loading...`);

    $.ajax({
        type: "POST",
        url: "/resend-new-member-notification",
        data: {
            'email': email
        },
        success: function (response) {

            if (response.error == false && response.return == true) {
                
                $('#malert').removeClass('d-none alert-danger');
                $('#malert').addClass('alert-success');
                $('#malert').text(`LINK GRUP WHATSAPP & DISCORD TELAH DI KIRIM ULANG KE EMAIL ${email}`);

                let time = 30;
                
                let resendCountDown = setInterval(() => {
                    
                    $('#msend').html(`Kirim ulang link dalam ${time} detik`);

                    time -= 1;

                    if (time == -1) {

                        $('#malert').addClass('d-none alert-danger');
                        $('#malert').removeClass('alert-success');
                        $('#msend').removeAttr('disabled');
                        $('#msend').html(`<i class="fa-solid fa-paper-plane"></i> Kirim`);
                        $('#mcancel').removeClass('d-none');

                        clearInterval(resendCountDown);

                    }

                }, 1000);

            } else if (response.error == false && response.return == false) {
                
                $('#msend').removeAttr('disabled');
                $('#msend').html(`<i class="fa-solid fa-paper-plane"></i> Kirim`);
                $('#mcancel').removeClass('d-none');

                $('#memail').addClass('is-invalid');
                $('#invalid-memail').text('EMAIL TIDAK TERDAFTAR');

            } else {

                Swal.fire(
                    'Gagal',
                    'Gagal mengirim ulang link',
                    'error'
                );

            }
            
        }
    });

}

function sendMail(email) {

    $('#sendMail').attr('disabled', true);

    $('#sendMail').html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
    Loading...`);
    
    $.ajax({
        type: "POST",
        url: "/resend-new-member-notification",
        data: {
            'email': email
        },
        success: function (response) {
            
            if (response.error == false && response.return == true) {
                
                Swal.fire(
                    'Sukses',
                    'Berhasil mengirim ulang email',
                    'success'
                );

                let time = 30;
                
                let resendCountDown = setInterval(() => {
                    
                    $('#sendMail').html(`Kirim ulang email dalam ${time} detik`);

                    time -= 1;

                    if (time == -1) {

                        $('#sendMail').removeAttr('disabled');
                        $('#sendMail').html(`<i class="fa-solid fa-paper-plane"></i> Kirim ulang email`);

                        clearInterval(resendCountDown);

                    }

                }, 1000);

            } else  {
                
                $('#sendMail').removeAttr('disabled');
                $('#sendMail').html(`<i class="fa-solid fa-paper-plane"></i> Kirim`);

                Swal.fire(
                    'Gagal',
                    'Gagal mengirim ulang email',
                    'error'
                );

            }

        }

    });

}

function validateLogin(email,pw,remember) {

    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    let isEmail = regex.test(email);
    
    if (email === '') {
        
        $('#email').addClass('is-invalid');
        $('#invalid-email').text(`EMAIL WAJIB DI ISI`);

    } else {

        if (isEmail) {

            $('#email').removeClass('is-invalid');
            
        } else {

            $('#email').addClass('is-invalid');
            $('#invalid-email').text(`EMAIL TIDAK VALID`);

        }
        
    }
    
    if (pw === '') {
        
        $('#password').addClass('is-invalid');
        $('#invalid-password').text(`PASSWORD WAJIB DI ISI`);

    } else {

        $('#password').removeClass('is-invalid');
        
    }

    if (email != '' && pw != '' && isEmail) {
        
        login(email,pw,remember);

    }

}

function login(email,pw,remember) {
    
    $('#login').attr('disabled', true);

    $('#login').html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
    Loading...`);

    $.ajax({
        type: "POST",
        url: "/login",
        data: {
            'email': email,
            'password': pw,
            'remember': remember
        },
        success: function (response) {

            if (response.error == false) {
                
                window.location.href = '/dashboard'

            } else {

                $('#alert-login').removeClass('d-none');

                $('#login').removeAttr('disabled');

                $('#login').html(`<i class="fa-solid fa-right-to-bracket"></i> Login`);
                
            }
            
        }


    });

}

function validateWebsiteSettings(adminContact, whatsappGroupLink, discordServerLink, registerStartAt, registerEndAt) 
{
 
    if (adminContact === '') {
        
        $('#admin-contact').addClass('is-invalid');
        $('#invalid-admin-contact').text(`ADMIN CONTACT WAJIB DI ISI`);

    } else {
        
        $('#admin-contact').removeClass('is-invalid');

    }

    if (whatsappGroupLink === '') {

        $('#whatsapp-group-link').addClass('is-invalid');
        $('#invalid-whatsapp-group-link').text(`WHATSAPP GROUP LINK WAJIB DI ISI`);
        
    } else {

        $('#whatsapp-group-link').removeClass('is-invalid');
        
    }
    
    if (discordServerLink === '') {

        $('#discord-server-link').addClass('is-invalid');
        $('#invalid-discord-server-link').text(`DISCORD SERVER LINK WAJIB DI ISI`);
        
    } else {

        $('#discord-server-link').removeClass('is-invalid');
        
    }
    
    if (registerStartAt === '') {

        $('#register_start_at').addClass('is-invalid');
        $('#invalid-register-start-at').text(`REGISTER START AT WAJIB DI ISI`);
        
    } else {

        $('#register_start_at').removeClass('is-invalid');
        
    }
    
    if (registerEndAt === '') {

        $('#register_end_at').addClass('is-invalid');
        $('#invalid-register-end-at').text(`REGISTER END AT WAJIB DI ISI`);
        
    } else {

        $('#register_end_at').removeClass('is-invalid');
        
    }

    if (adminContact != '' && whatsappGroupLink != '' && discordServerLink != '' && registerStartAt != '' && registerEndAt != '') {
        
        saveWebsiteSettings(adminContact, whatsappGroupLink, discordServerLink, registerStartAt, registerEndAt);

    }
    
}

function saveWebsiteSettings(adminContact, whatsappGroupLink, discordServerLink, registerStartAt, registerEndAt) 
{

    $('#saveSettings').attr('disabled', true);

    $('#saveSettings').html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
    Loading...`);

    console.log(whatsappGroupLink);

    $.ajax({
        type: "POST",
        url: "/save-website-settings",
        data: {
            'admin_contact': adminContact,
            'register_start_at': registerStartAt,
            'register_end_at': registerEndAt,
            'whatsapp_group_link': whatsappGroupLink,
            'discord_server_link': discordServerLink
        },
        success: function (response) {

            if (response.error == false) {

                Swal.fire(
                    'Berhasil',
                    'Berhasil menyimpan website settings',
                    'success'
                );

                $('#saveSettings').removeAttr('disabled');

                $('#saveSettings').html(`<i class="fa-solid fa-floppy-disk"></i> Simpan`);

            } else {

                Swal.fire(
                    'Gagal',
                    'Gagal menyimpan website settings',
                    'error'
                );
                
                $('#saveSettings').removeAttr('disabled');

                $('#saveSettings').html(`<i class="fa-solid fa-floppy-disk"></i> Simpan`);

            }
            
        }
    });
    
}