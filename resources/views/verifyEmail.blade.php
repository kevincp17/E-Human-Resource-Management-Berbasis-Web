<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
<h2>Selamat datang di website kami, {{ $user->name }}</h2>

<p>
    Klik <a href="{{ url('/userApplicant/verify/' .$verifyUser->token) }}">disini</a> untuk verifikasi email anda.
</p>

</body>

</html>
