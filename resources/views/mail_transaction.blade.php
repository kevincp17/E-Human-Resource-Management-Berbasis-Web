<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
@if($transaction->status == 'Menunggu Verifikasi')
    <h2>Halo admin</h2>

    <p>
        {{$user->name}} dari perusahaan {{$company->name}} telah melakukan transaksi. Tolong verifikasi transaksi pembayarannya.
    </p>
@elseif($transaction->status == 'Batal')
    <h2>Halo admin</h2>

    <p>
        {{$user->name}} dari perusahaan {{$company->name}} telah membatalkan langganan.
    </p>
    @endif
<p>
    Klik <a href="{{ url('/logout') }}">disini</a> untuk melakukan login.
</p>
</body>

</html>
