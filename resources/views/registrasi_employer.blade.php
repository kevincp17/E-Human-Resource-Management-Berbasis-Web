<html>
<head>
    <title>Form Registrasi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body style="background-color:#ffffcc;">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a style="pointer-events: none; cursor: default;" class="navbar-brand" href="{{ url('/') }}">HRD</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" data-target="#navbarSupportedContent"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav" >
            @if (Session::get('exist'))
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/index_main') }}"><span class="fas fa-home"></span>Beranda</a>
                </li>
            @endif

            @if (!Session::get('exist'))
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/index_company') }}"><span class="fas fa-registered"></span>Login Perusahaan</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/registrasi_company') }}"><span class="fas fa-registered"></span>Registrasi Perusahaan</a>
                </li>
            @endif

            @if (Session::get('exist') && (Session::get('role')=='Job Applicant' || Session::get('role')=='admin'))
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/career_list') }}"><span class="fas fa-list"></span>Daftar Lowongan</a>
                </li>
            @endif

            @if (Session::get('exist') && (Session::get('role')=='Job Applicant' || Session::get('role')=='admin'))
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
                    <a class="nav-link" href="#"><span class="fas fa-user-tie"></span>Promosi Lowongan</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="#"><span class="fas fa-id-card"></span>Cari Pelamar</a>
                </li>
            @endif

            @if (Session::get('exist'))
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/logout') }}"><span class="fas fa-sign-out-alt"></span>Keluar</a>
                </li>
            @endif

        </ul>

        @if (!Session::get('exist'))
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active ">
                    <a class="nav-link rounded border  border-light" href="{{ url('/') }}">Pelamar Kerja</a>
                </li>
            </ul>
        @endif
    </div>
</nav>

<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
    @endforeach
</div>
@include('sweetalert::alert')
<div id="container" class="pr-5">
    <div class="row">
        <div class="col-md-6 mt-5">
            <div class="w-100 ml-5">
                <div class="row mb-5">
                    <h3>Cari Pelamar</h3>
                    <h5>Dapatkan pelamar sesuai dengan kualifikasi yang relevan.</h5>
                </div>

                <div class="row">
                    <h3>Promosi Lowongan</h3>
                    <h5>Buat lowongan pekerjaan yang dapat menarik perhatian pelamar kerja.</h5>
                </div>

            </div>
        </div>

        <div class="col-md-6 ">
            <div class="float-right w-100">
                <h4 class="card-title mt-3 ml-5 text-center">Registrasi Perusahaan</h4>
                <form action="{{(url('/registrasi_company'))}}" method="post" class="offset-lg-3 pr-5 form-horizontal" id="loginForm" enctype="multipart/form-data">
                    <fieldset style="background-color:deepskyblue;" class="rounded p-2">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div>
                                <label class="text-black font-weight-bold" for="namPej">Nama Lengkap:</label>
                                <input class="form-control" type="text" name="comNama" placeholder="Nama Lengkap">
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label class="text-black font-weight-bold" for="namPej">Nama Perusahaan:</label>
                                <input class="form-control" type="text" name="comNamaPer" placeholder="Nama Perusahaan">
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label class="text-black font-weight-bold" for="namPej">Nomor Telpon:</label>
                                <input class="form-control" type="text" name="comTelp" placeholder="Nomor Telpon">
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label class="text-black font-weight-bold" for="namPej">Email:</label>
                                <input class="form-control" type="text" name="comEmail" placeholder="Email">
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label class="text-black font-weight-bold" for="namPej">Alamat:</label>
                                <input class="form-control" type="text" name="comAlamat" placeholder="Alamat">
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label class="text-black font-weight-bold" for="namPej">Provinsi:</label>
                                <select name="comProvinsi" id="comProvinsi" class="form-control">
                                    <option value="">--Pilih Provinsi--</option>
                                    @foreach ($provinces as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label class="text-black font-weight-bold" for="namPej">Kabupaten/Kota:</label>
                                <select name="comKota" id="comKota" class="form-control">
                                    <option value="">--Pilih Kabupaten/Kota--</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label class="text-black font-weight-bold" for="namPej">Kecamatan:</label>
                                <select name="comKec" id="comKec" class="form-control">
                                    <option value="">--Pilih Kecamatan--</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label class="text-black font-weight-bold" for="namPej">Kelurahan:</label>
                                <select name="comKel" id="comKel" class="form-control">
                                    <option value="">--Pilih Kelurahan--</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label class="text-black font-weight-bold" for="kode_pos">Kode Pos:</label>
                                <input class="form-control" type="text" name="com_kode_pos" placeholder="Kode Pos">
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label class="text-black font-weight-bold" for="namPej">Upload Logo(jpeg,png,jpg maks 2MB):</label>
                                <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror">
                                @error('logo')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label class="text-black font-weight-bold" for="namPej">Upload Foto Perusahaan(jpeg,png,jpg maks 2MB):</label>
                                <input type="file" name="photoCom" class="form-control @error('photoCom') is-invalid @enderror">
                                @error('photoCom')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label class="text-black font-weight-bold" for="namPej">Upload SIUP(PDF maks 2MB):</label>
                                <input type="file" name="siup" class="form-control @error('siup') is-invalid @enderror" accept="application/pdf">
                                @error('siup')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label class="text-black font-weight-bold" for="namPej">Username:</label>
                                <input class="form-control" type="text" name="comUsername" placeholder="Username">
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label class="text-black font-weight-bold" for="namPej">Password:</label>
                                <input class="form-control" type="password" name="comPassword" placeholder="Password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label class="text-black font-weight-bold" for="namPej">Konfirmasi Password:</label>
                                <input class="form-control" type="password" name="comRePassword" placeholder="Re-Password">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block"><span class="fas fa-paper-plane"></span>Daftar</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
</body>
<script>
    window.addEventListener('DOMContentLoaded', function() {
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#comProvinsi').on('change', function () {
                $.ajax({
                    url: '{{ route('dependent-dropdown.kabupaten') }}',
                    method: 'POST',
                    data: {id: $(this).val()},
                    success: function (response) {
                        $('#comKota').empty();

                        $.each(response, function (id, name) {
                            $('#comKota').append(new Option(name, id))
                        })
                    }
                })
            });

            $('#comKota').on('change', function () {
                $.ajax({
                    url: '{{ route('dependent-dropdown.kecamatan') }}',
                    method: 'POST',
                    data: {id: $(this).val()},
                    success: function (response) {
                        $('#comKec').empty();

                        $.each(response, function (id, name) {
                            $('#comKec').append(new Option(name, id))
                        })
                    }
                })
            });

            $('#comKec').on('change', function () {
                $.ajax({
                    url: '{{ route('dependent-dropdown.kelurahan') }}',
                    method: 'POST',
                    data: {id: $(this).val()},
                    success: function (response) {
                        $('#comKel').empty();

                        $.each(response, function (id, name) {
                            $('#comKel').append(new Option(name, id))
                        })
                    }
                })
            });
        });
    });

    var inp_provinsi = document.getElementById("comProvinsi");
    var inp_kota = document.getElementById("comKota");
    var inp_kec = document.getElementById("comKec");
    var inp_kel = document.getElementById("comKel");
    document.getElementById("comKota").disabled = true;
    document.getElementById("comKec").disabled = true;
    document.getElementById("comKel").disabled = true;
    inp_provinsi.addEventListener("input", function () {
        document.getElementById("comKota").disabled = false;
    });

    inp_kota.addEventListener("input", function () {
        document.getElementById("comKec").disabled = false;
    });

    inp_kec.addEventListener("input", function () {
        document.getElementById("comKel").disabled = false;
    });
</script>
</html>


