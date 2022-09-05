<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat Transaksi Perusahaan</title>
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



@if (Session::get('role')=='company' && Session::get('exist') && Session::get('status_transaksi')=='Aktif')
    <div style="position: absolute;top:250px;text-align: center">
        <h1>Pembelian paket tidak bisa dilakukan selagi paket langganan anda masih aktif. <a href="{{ url('/company_transaction') }}">Batalkan</a> atau tunggu masa berlaku paket habis pada tanggal <br>{{Session::get('jangka')}}.</h1>
    </div>
@else
    <div class="p-3 text-center" style="margin-top: 100px;">
        <h1>Berapa banyak iklan yang akan anda beli?</h1>
    </div>

<div class="row ml-5 mt-3 pr-5">
    <div  class="col font-weight-bold">
        <div style="background-color:deepskyblue" class="text-center card item-wr">
            3 Iklan Lowongan
            <div>
                <ul>
                    <li>3 Posting Lowongan</li>
                    <li>Notifikasi Lamaran</li>
                    <li>Rp{{ number_format(Session::get('harga1'),2,',','.') }}/bulan</li>
                </ul>
            </div>
            <a class="btn btn-primary mr-md-3 w-100" href="{{ url('/get_package/1') }}"><span class="fas fa-shopping-cart"></span>Beli Sekarang</a>
        </div>
    </div>

    <div  class="col font-weight-bold">
        <div style="background-color:deepskyblue" class="text-center card item-wr">
            5 Iklan Lowongan
            <div>
                <ul>
                    <li>5 Posting Lowongan</li>
                    <li>Notifikasi Lamaran</li>
                    <li>Rp{{ number_format(Session::get('harga2'),2,',','.') }}/bulan</li>
                </ul>
            </div>
            <a class="btn btn-primary mr-md-3 w-100" href="{{ url('/get_package/2') }}"><span class="fas fa-shopping-cart"></span>Beli Sekarang</a>
        </div>
    </div>

    <div  class="col font-weight-bold ">
        <div style="background-color:deepskyblue" class="text-center card item-wr">
            7 Iklan Lowongan
            <div>
                <ul>
                    <li>7 Posting Lowongan</li>
                    <li>Notifikasi Lamaran</li>
                    <li>Rp{{ number_format(Session::get('harga3'),2,',','.') }}/bulan</li>
                </ul>
            </div>
            <a class="btn btn-primary mr-md-3 w-100" href="{{ url('/get_package/3') }}"><span class="fas fa-shopping-cart"></span>Beli Sekarang</a>
        </div>
    </div>

    <div class="col font-weight-bold">
        <div style="background-color:deepskyblue" class="text-center card item-wr">
            10 Iklan Lowongan
            <div>
                <ul>
                    <li>10 Posting Lowongan</li>
                    <li>Notifikasi Lamaran</li>
                    <li>Rp{{ number_format(Session::get('harga4'),2,',','.') }}/bulan</li>
                </ul>
            </div>
            <a class="btn btn-primary mr-md-3 w-100" href="{{ url('/get_package/4') }}"><span class="fas fa-shopping-cart"></span>Beli Sekarang</a>
        </div>
    </div>
</div>
@endif

</body>
</html>
