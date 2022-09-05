<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <h2>Halo {{$user->name}}</h2>

    <p>
        Admin telah melakukan verifikasi pembayaran anda. Sekarang anda dapat mempromosikan lowongan sebanyak {{$transaction->jlh_paket_iklan}} kali.
    </p>

    <p>
        Klik <a href="{{ url('/logout') }}">disini</a> untuk melakukan login.
    </p>

</body>

</html>
