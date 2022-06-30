$(document).ready(function () {
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#login').click(function (e) { 
        e.preventDefault();
        
        const email = $('#email').val();
        const password = $('#password').val();
        const remember = $('#ingatSaya').val();

        validateLogin(email,password,remember);

    });

    $('#newMember').DataTable();

    $('#saveSettings').click(function (e) { 
        e.preventDefault();
        
        const adminContact = $('#admin-contact').val();
        const whatsappGroupLink = $('#whatsapp-group-link').val();
        const discordServerLink = $('#discord-server-link').val();
        const registerStartAt = $('#register_start_at').val();
        const registerEndtAt = $('#register_end_at').val();

        validateWebsiteSettings(adminContact,whatsappGroupLink,discordServerLink,registerStartAt,registerEndtAt);

    });

});