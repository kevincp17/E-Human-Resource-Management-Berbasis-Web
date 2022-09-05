<html>
<head>
    <title>Form Riwayat Pendidikan</title>
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

<div id="container">
    <h4 class="card-title mt-3 text-center">Masukkan Edukasi Terakhir</h4>
    <form action="{{(url('/education_user'))}}" method="post" class="col-lg-6 offset-lg-3 form-horizontal" id="loginForm">
        <fieldset style="background-color:deepskyblue;" class="rounded p-2">
        {{ csrf_field() }}
        <input class="form-control" type="hidden" name="userid" value="{{ Session::get('nama') }}">
        <div class="form-group">
            <div>
                <label class="text-black font-weight-bold" for="namPej">Nama Tempat Pendidikan Terakhir:</label>
                <input class="form-control" type="text" name="unName" placeholder="Nama Tempat Pendidikan Terakhir">
            </div>
        </div>

            <div class="form-group">
                <div>
                    <label class="text-black font-weight-bold" for="namPej">Tingkat Pendidikan Terakhir:</label>
                    <select name="akhir" id="akhir"  class="form-control">
                        <option selected>--Pilih Tingkat Pendidikan Akhir--</option>
                        <option value="SMA/SMK">SMA/SMK</option>
                        <option value="Universitas">Universitas</option>
                    </select>
                </div>
            </div>

            <div id="ipk">
                <div class="form-group">
                    <div>
                        <label class="text-black font-weight-bold" for="namPej">Pilih Fakultas:</label>
                        <select name="fakultas" id="fakultas" class="form-control">
                            <option selected>--Pilih Fakultas--</option>
                            @foreach ($fakultas as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div>
                        <label class="text-black font-weight-bold" for="namPej">Pilih Jurusan:</label>
                        <select name="jurusan" id="jurusan" class="form-control">
                            <option selected>--Pilih Jurusan--</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div>
                        <label class="text-black font-weight-bold" for="namPej">Kualifikasi:</label>
                        <select name="kualifikasi" class="form-control">
                            <option selected>--Pilih Kualifikasi--</option>
                            <option value="Diploma(D3)">Diploma(D3)</option>
                            <option value="Sarjana(S1)">Sarjana(S1)</option>
                            <option value="Master/Pasca Sarjana(S2)">Master/Pasca Sarjana(S2)</option>
                            <option value="Doktor(S3)">Doktor(S3)</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div>
                        <label class="text-black font-weight-bold" for="namPej">Jumlah IPK:</label>
                        <input  class="form-control" type="number" name="ipk"  min="0.00" max="4.00" step="0.01" placeholder="IPK">
                    </div>
                </div>

            </div>

        <div class="form-group">
            <div>
                <label class="text-black font-weight-bold" for="example-datepicker">Tanggal Kelulusan:</label>
                <input class="form-control" name="wisud" placeholder="MM/DD/YYY" type="date"/>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-lg btn-block"><span class="fas fa-paper-plane"></span>Kirim</button>
        </fieldset>
    </form>
    <a href="{{ url('/profile_applicant') }}"><button type="button" class="btn btn-primary col-lg-6 offset-lg-3 btn-lg btn-block"><span class="fas fa-arrow-left"></span>Kembali</button></a>
</div>

<script>
    window.addEventListener('DOMContentLoaded', function() {
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#fakultas').on('change', function () {
                $.ajax({
                    url: '{{ route('dependent-dropdown.jurusan') }}',
                    method: 'POST',
                    data: {id: $(this).val()},
                    success: function (response) {
                        $('#jurusan').empty();

                        $.each(response, function (id, name) {
                            $('#jurusan').append(new Option(name, id))
                        })
                    }
                })
            });
        });
    });

    var inp_fakultas = document.getElementById("fakultas");
    var inp_jurusan = document.getElementById("jurusan");
    document.getElementById("inp_jurusan").disabled = true;
    inp_fakultas.addEventListener("input", function () {
        document.getElementById("inp_jurusan").disabled = false;
    });

</script>

<script>
    $(document).ready(function(){
        var date_input=$('input[name="dateMulai"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        var options={
            format: 'mm/dd/yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
        };
        date_input.datepicker(options);
    })

    $(document).ready(function(){
        var date_input=$('input[name="dateSelesai"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        var options={
            format: 'mm/dd/yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
        };
        date_input.datepicker(options);
    })

    document.getElementById("ipk").hidden=true;

    jQuery(function($) {
        $('#akhir').change(function () {
            var val = $(this).val();
            if (val === 'Universitas') {
                document.getElementById("ipk").hidden=false;

            } else{
                document.getElementById("ipk").hidden=true;
            }
        })
    });
</script>
</body>
</html>




