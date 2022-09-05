<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
@if($jobApply->status == 'Menunggu jawaban')
    <h2>Halo {{$userCom->name}}</h2>

    <p>
        {{$user->name}} telah melamar lowongan {{$job->nama_job}}.
    </p>
@elseif($jobApply->status == 'Diterima')
    <h2>Halo {{$user->name}}</h2>

    <p>
        Lamaran kamu telah diterima oleh perusahaan {{$company->name}}.
    </p>
@elseif($jobApply->status == 'Ditolak')
    <h2>Halo {{$user->name}}</h2>

    <p>
        Lamaran kamu telah ditolak oleh perusahaan {{$company->name}}.
    </p>
@elseif($jobApply->status == 'Batal Wawancara')
    <h2>Halo {{$userCom->name}}</h2>

    <p>
        Wawancara untuk lowongan {{$job->nama_job}} telah dibatalkan oleh {{$user->name}}.
    </p>
@endif
<p>
    Klik <a href="{{ url('/logout') }}">disini</a> untuk melakukan login.
</p>

</body>

</html>
