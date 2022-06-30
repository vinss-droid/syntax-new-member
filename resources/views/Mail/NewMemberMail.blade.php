<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NEW MEMBER SYNTAX.ID</title>
</head>

<style>

* {

    padding: 0;
    margin: 0;
    font-family: 'Times New Roman', Times, serif;

}

.text-center {

    text-align: center;

}

.text-justify {

    text-align: justify;

}

.fw-bold {

    font-weight: bold;

}

.text-uppercase {

    text-transform: uppercase;

}

.d-grid {

    display: grid;

}

.btn {
  
  border: none;
  padding: 10px;
  border-radius: 6px;
  cursor: pointer;
  display: inline-block;
  text-decoration: none;
  
}

.btn-whatsapp-link {
  
  background-color: #0c8f1e;
  color: white;
  
}

.btn-discord-link {
  
  background-color: #6064a8;
  color: white;
  
}

.container {

    margin: 6%;

}

p {

    line-height: 30px;

}

p.text-center-important {

    text-align: center !important;

}

@media only screen and (max-width: 768px) {

    p {

        text-align: justify !important;

    }

}

</style>

<body>

<div class="container">
    <div align="center">

        <h4 class="text-center fw-bold text-uppercase">NEW MEMBER SYNTAX COMMUNITY</h4>
    
    </div>
    
    <br> <br>

    <div class="text-justify">
    
        <p>Hallo {{ $nameMember }}, </p>
        <br>
        <p>Selamat kamu berhasil menjadi anggota baru dari Syntax Community</p>
        <p>untuk berkomunikasi dan mendapatkan info lebih lanut seputar eskul syntax kamu dapat bergabung pada grup whatsapp dan discord server dengan menekan tombol-tombol dibawah.</p>
    
    </div>

    <br><br>
    
    <div align="center">
    
        <a href="{{ $whatsapp_group_link }}" class="btn btn-whatsapp-link">
            Grup WhatsApp
        </a>
        
        <br> <br>

        <a href="{{ $discord_server_link }}" class="btn btn-discord-link">
            Discord Server
        </a>
    
    </div>
    
    <br><br>
    
    <div class="text-center">
    
        <p>Jika tombol-tombol diatas tidak berfungsi kamu bisa menggunakan link dibawah.</p>

        <br>

        <p class="text-center-important">WhatsApp Group :</p>

        <a href="{{ $whatsapp_group_link }}">{{ $whatsapp_group_link }}</a>

        <br> <br>

        <p class="text-center-important">Discord Server :</p>

        <a href="{{ $discord_server_link }}">{{ $discord_server_link }}</a>
    
    </div>
    
    <br> <br> <br>
    
    <div>
    
        <p>Salah Hangat,</p> 
        <br>
        <p>Admin Syntax Community</p>
    
    </div>
</div>
    
</body>
</html>