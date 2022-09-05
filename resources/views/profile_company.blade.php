<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil Perusahaan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
    <style>
        .error{ color:red; }
    </style>
</head>

<body style="background-color:#ffffcc;">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<style type="text/css">
    .pagination li{
        float: left;
        list-style-type: none;
        margin:5px;
    }
</style>
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

<div class="p-3 border m-2 bg-light">
    @if(Session::get('logoCom'))
        <img src="logo/{{ Session::get('logoCom') }}">
    @else
        <h5 class="text-danger">Foto perusahaan belum di upload</h5>
    @endif
        <form action="{{(url('/image-uploadLogoPost'))}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input class="form-control" type="hidden" name="userid" value="{{ Session::get('user_id') }}">
            <div class="row">
                <div class="col-md-6">
                    <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror">
                    @error('logo')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <button type="submit" class="btn btn-success">Update Logo(jpeg,png,jpg maks 2MB</button>
                </div>
            </div>
        </form>
    <h3><i class="fa fa-user" aria-hidden="true"></i>{{ Session::get('nama') }}</h3>
    <h3><i class="fa fa-envelope" aria-hidden="true"></i>{{ Session::get('email') }}</h3>
    <h3><i class="fa fa-phone" aria-hidden="true"></i>{{ Session::get('telp') }}</h3>
    <h3 class="text-capitalize"><i class="fas fa-map-marker-alt" aria-hidden="true"></i>{{ Session::get('alamat') }},Kelurahan {{ Session::get('kelurahan') }}, Kecamatan {{ Session::get('kecamatan') }},{{ Session::get('kota') }},{{ Session::get('provinsi') }} {{ Session::get('kode_pos') }}</h3>
</div>

<div class="p-3 border m-2 bg-light">
    @if (Session::get('role')=='company')
        <a class="btn btn-primary mr-md-3" href="{{(url('/post_overview'))}}"><span class="fas fa-plus"></span>Tambah Informasi Perusahaan</a>
    @endif

    <h3>Overview Perusahaan</h3>
        @if(Session::get('comverview'))
            <h5>{{ Session::get('comverview') }}</h5>
        @else
            <h5 class="text-danger">Informasi overview perusahaan belum di masukkan</h5>
        @endif
    <div class="mb-3"></div>
    <h3>Informasi Tambahan Perusahaan</h3>
    <div class="row col-md-10">
        <div class="col-md-5">
            <h5 class="font-weight-bold">Jumlah Pegawai</h5>
            @if(Session::get('jml_peg'))
                <h5>{{ Session::get('jml_peg') }} pegawai</h5>
            @else
                <h5 class="text-danger">Informasi jumlah pegawai belum di masukkan</h5>
            @endif
        </div>

        <div class="col-md-5">
            <h5 class="font-weight-bold">Rata-rata waktu proses lamaran</h5>
            @if(Session::get('time'))
                <h5>{{ Session::get('time') }} hari</h5>
            @else
                <h5 class="text-danger">Informasi waktu proses lamaran belum di masukkan</h5>
            @endif
        </div>
    </div>
    <div class="mb-3"></div>

    <h3>Foto Perusahaan</h3>
    @if(Session::get('fotoCom'))
    <img src="photos/{{ Session::get('fotoCom') }}">
    @else
        <h5 class="text-danger">Foto perusahaan belum di upload</h5>
    @endif
    <form action="{{(url('/image-uploadCompanyPost'))}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input class="form-control" type="hidden" name="userid" value="{{ Session::get('user_id') }}">
        <div class="row">
            <div class="col-md-6">
                <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror">
                @error('photo')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <button type="submit" class="btn btn-success">Update Foto Perusahaan(jpeg,png,jpg maks 2MB</button>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>

</body>
</html>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

