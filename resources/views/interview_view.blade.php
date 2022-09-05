<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jadwal Wawancara</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>

<body style="background-color:#ffffcc;">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a style="pointer-events: none; cursor: default;" class="navbar-brand" href="{{ url('/') }}">HRD</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" data-target="#navbarSupportedContent"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav" >
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/index_main') }}"><span class="fas fa-home"></span>Beranda</a>
            </li>

            @if (!Session::get('exist'))
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/registrasi') }}"><span class="fas fa-registered"></span>Registrasi</a>
                </li>
            @endif

            @if (Session::get('exist') && (Session::get('role')=='Job Applicant'))
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/career_list') }}"><span class="fas fa-list"></span>Daftar Lowongan</a>
                </li>
            @endif

            @if (Session::get('exist') && Session::get('role')=='Job Applicant')
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/applied_job') }}"><span class="fas fa-user-tie"></span>Lamaran Kerja</a>
                </li>
            @endif

            @if (Session::get('exist') && Session::get('role')=='Job Applicant')
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/profile_applicant') }}"><span class="fas fa-id-card"></span>Profil</a>
                </li>
            @endif

            @if (Session::get('exist') && Session::get('role')=='company')
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/career_list') }}"><span class="fab fa-adversal"></span>Promosi Lowongan</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/applied_job') }}"><span class="fas fa-search"></span>Cari Pelamar</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/profile_company') }}"><span class="fas fa-id-card"></span>Profil Perusahaan</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/company_credit') }}"><span class="far fa-credit-card"></span>Beli Kredit</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/company_transaction') }}"><span class="fas fa-history"></span>Riwayat Transaksi</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/laporanCompany') }}"><span class="fas fa-clipboard"></span>Laporan</a>
                </li>
            @endif

            @if (Session::get('exist') && Session::get('role')=='admin')
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/admin_transaction') }}"><span class="fas fa-cash-register"></span>Riwayat Transaksi Perusahaan</a>
                </li>
            @endif

            @if (Session::get('exist'))
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/logout') }}"><span class="fas fa-sign-out-alt"></span>Logout</a>
                </li>
            @endif
        </ul>
    </div>
</nav>

<div class="p-3 border m-2 bg-light text-center">
    <a class="btn btn-primary mr-md-3" href="/applied_job"><span class="fas fa-arrow-left"></span>Kembali ke halaman sebelumnya</a>
    <h1>Tanggal wawancara:{{Session::get('jadwal')->format('d F Y')}}</h1>
    <h1>Jam wawancara:{{Session::get('jadwal')->format('h:i A')}}</h1>
    <h1>Link Zoom:<a href="{{Session::get('link')}}">Klik Disini</a></h1>
    @if(Session::get('role')=='Job Applicant')
        <h1>Lamaran Anda Telah Diproses</h1>
    @endif

    @if (Session::get('role')=='company')
    <form action="{{ url('/change_date') }}" method="post" class="col-lg-6 offset-lg-3 mt-2 form-horizontal" id="some_form">
        <fieldset style="background-color:deepskyblue;" class="rounded p-2">
            {{ csrf_field() }}
            <input class="form-control" type="hidden" value="{{ $job_applies['id'] }}" name="jobaid"/>

            <div class="form-group">
                <label class="text-black font-weight-bold" for="example-datepicker">Ganti Tanggal Wawancara:</label>
                <input class="form-control" value="{{ $job_applies['tgl_wawancara'] }}" name="tawan_new" placeholder="MM/DD/YYY" type="datetime-local"/>
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block"><span class="fas fa-paper-plane"></span>Kirim</button>
        </fieldset>
    </form>
    @endif
</div>

{{--<script type="text/javascript">--}}
{{--    var theButton = document.getElementById('show_date');--}}
{{--    var cancelButton = document.getElementById('cancel_date');--}}
{{--    document.getElementById('some_form').style.visibility='hidden';--}}
{{--    document.getElementById("cancel").style.visibility = 'visible';--}}
{{--    theButton.onclick = function() {--}}
{{--        document.getElementById('some_form').style.visibility='visible';--}}
{{--        document.getElementById("cancel").style.visibility = 'hidden';--}}
{{--    }--}}
{{--    cancelButton.onclick = function() {--}}
{{--        document.getElementById('some_form').style.visibility='hidden';--}}
{{--        document.getElementById("cancel").style.visibility = 'visible';--}}
{{--    }--}}

{{--</script>--}}

</body>
</html>
