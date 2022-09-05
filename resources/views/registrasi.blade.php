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
                        <a class="nav-link" href="{{ url('/') }}"><span class="fas fa-registered"></span>Login Pelamar</a>
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="{{ url('/registrasi') }}"><span class="fas fa-registered"></span>Registrasi Pelamar</a>
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
                        <a class="nav-link rounded border  border-light" href="{{ url('/index_company') }}">Perusahaan</a>
                    </li>
                </ul>
            @endif
        </div>
    </nav>

    <div id="container" class="pr-5">
                <h1 class="card-title mt-3 ml-5 text-center">Registrasi Pelamar</h1>
                <form action="{{(url('/registrasi_user'))}}" method="post" class="col-lg-6 offset-lg-3 " id="loginForm" enctype="multipart/form-data">
                    <fieldset style="background-color:deepskyblue;" class="rounded p-2">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div>
                                <label class="text-black font-weight-bold" for="namPej">Nama Lengkap:</label>
                                <input class="form-control" type="text" name="regNama" placeholder="Nama Lengkap">
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label class="text-black font-weight-bold" for="namPej">Email:</label>
                                <input class="form-control" type="text" name="regEmail" placeholder="Email">
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label class="text-black font-weight-bold" for="namPej">Alamat:</label>
                                <input class="form-control" type="text" name="regAlamat" placeholder="Alamat">
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label class="text-black font-weight-bold" for="namPej">Provinsi:</label>
                                <select name="provinsi" id="provinsi" class="form-control">
                                    <option value="">--Pilih Provinsi--</option>
                                    @foreach ($provinces as $id => $name)
                                        dd($id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label class="text-black font-weight-bold" for="namPej">Kabupaten/Kota:</label>
                                <select name="regKota" id="regKota" class="form-control">
                                    <option value="">--Pilih Kabupaten/Kota--</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label class="text-black font-weight-bold" for="namPej">Kecamatan:</label>
                                <select name="kec" id="kec" class="form-control">
                                    <option value="">--Pilih Kecamatan--</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label class="text-black font-weight-bold" for="namPej">Kelurahan:</label>
                                <select name="kel" id="kel" class="form-control">
                                    <option value="">--Pilih Kelurahan--</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="text-black font-weight-bold" for="namPej">RT:</label>
                                    <input class="form-control" type="text" name="rt" placeholder="RT">
                                </div>

                                <div class="col-md-3">
                                    <label class="text-black font-weight-bold" for="namPej">RW:</label>
                                    <input class="form-control" type="text" name="rw" placeholder="RW">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label class="text-black font-weight-bold" for="kode_pos">Kode Pos:</label>
                                <input class="form-control" type="text" name="kode_pos" placeholder="Kode Pos">
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label class="text-black font-weight-bold" for="namPej">Nomor Telpon:</label>
                                <input class="form-control" type="text" name="regTelp" placeholder="Nomor Telpon">
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label class="text-black font-weight-bold" for="namPej">Upload Foto Profil(jpeg,png,jpg maks 2MB):</label>
                                <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror">
                                @error('photo')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label class="text-black font-weight-bold" for="files">Upload KTP(PDF maks 2MB):</label>
                                <input type="file" name="ktp" class="form-control hidden @error('ktp') is-invalid @enderror"  accept="application/pdf" id="files">
                                @error('ktp')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label class="text-black font-weight-bold" for="namPej">Upload CV(PDF maks 2MB):</label>
                                <input type="file" name="cv" class="form-control @error('cv') is-invalid @enderror" accept="application/pdf">
                                @error('cv')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label class="text-black font-weight-bold" for="namPej">Username:</label>
                                <input class="form-control" type="text" name="regUsername" placeholder="Username">
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label class="text-black font-weight-bold" for="namPej">Password:</label>
                                <input class="form-control" type="password" name="regPassword" placeholder="Password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label class="text-black font-weight-bold" for="namPej">Konfirmasi Password:</label>
                                <input class="form-control" type="password" name="regRePassword" placeholder="Konfirmasi Password">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg btn-block"><span class="fas fa-paper-plane"></span>Daftar</button>
                    </fieldset>
                </form>
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

            $('#provinsi').on('change', function () {
                $.ajax({
                    url: '{{ route('dependent-dropdown.kabupaten') }}',
                    method: 'POST',
                    data: {id: $(this).val()},
                    success: function (response) {
                        $('#regKota').empty();

                        $.each(response, function (id, name) {
                            $('#regKota').append(new Option(name, id))
                        })
                    }
                })
            });

            $('#regKota').on('change', function () {
                $.ajax({
                    url: '{{ route('dependent-dropdown.kecamatan') }}',
                    method: 'POST',
                    data: {id: $(this).val()},
                    success: function (response) {
                        $('#kec').empty();

                        $.each(response, function (id, name) {
                            $('#kec').append(new Option(name, id))
                        })
                    }
                })
            });

            $('#kec').on('change', function () {
                $.ajax({
                    url: '{{ route('dependent-dropdown.kelurahan') }}',
                    method: 'POST',
                    data: {id: $(this).val()},
                    success: function (response) {
                        $('#kel').empty();

                        $.each(response, function (id, name) {
                            $('#kel').append(new Option(name, id))
                        })
                    }
                })
            });
        });
    });

    var inp_provinsi = document.getElementById("provinsi");
    var inp_kota = document.getElementById("regKota");
    var inp_kec = document.getElementById("kec");
    var inp_kel = document.getElementById("kel");
    document.getElementById("regKota").disabled = true;
    document.getElementById("kec").disabled = true;
    document.getElementById("kel").disabled = true;
    inp_provinsi.addEventListener("input", function () {
        document.getElementById("regKota").disabled = false;
    });

    inp_kota.addEventListener("input", function () {
        document.getElementById("kec").disabled = false;
    });

    inp_kec.addEventListener("input", function () {
        document.getElementById("kel").disabled = false;
    });


</script>
</html>


