<html>
<head>
    <title>Form Pengalaman Bekerja</title>
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
    <h4 class="card-title mt-3 text-center">Masukkan Pengalaman Bekerja</h4>
    <form action="{{(url('/experience_user'))}}" method="post" class="col-lg-6 offset-lg-3 form-horizontal" id="loginForm">
        <fieldset style="background-color:deepskyblue;" class="rounded p-2">
        {{ csrf_field() }}
        <input class="form-control" type="hidden" name="userid" value="{{ Session::get('nama') }}">
        <div class="form-group">
            <div>
                <label class="text-black font-weight-bold" for="namPej">Nama Pekerjaan:</label>
                <input class="form-control" type="text" name="job" placeholder="Nama Pekerjaan">
            </div>
        </div>

        <div class="form-group">
            <div>
                <label class="text-black font-weight-bold" for="namPej">Nama Perusahaan:</label>
                <input class="form-control" type="text" name="company" placeholder="Nama Perusahaan">
            </div>
        </div>

        <div class="form-group">
            <div>
                <label class="text-black font-weight-bold" for="example-datepicker">Tanggal Mulai:</label>
                <input class="form-control" name="tamul" placeholder="MM/DD/YYY" type="date"/>
            </div>
        </div>

        <div class="form-group">
            <div>
                <label class="text-black font-weight-bold" for="example-datepicker">Tanggal Selesai:</label>
                <input class="form-control" name="tasel" placeholder="MM/DD/YYY" type="date"/>
            </div>
        </div>

            <div class="form-group">
                <label class="text-black font-weight-bold" for="lokasi">Keahlian:</label>
                <select name="expertise" class="form-control">
                    <option selected>--Pilih Keahlian--</option>
                    <option value="Statistika">Statistika</option>
                    <option value="Pengiklanan">Pengiklanan</option>
                    <option value="Agrikultur/Kehutanan/Perikanan">Agrikultur/Kehutanan/Perikanan</option>
                    <option value="Arsitektur">Arsitektur</option>
                    <option value="Grafik Design">Grafik Design</option>
                    <option value="Jasa Keuangan">Jasa Keuangan</option>
                    <option value="Biomedis">Biomedis</option>
                    <option value="Bioteknologi">Bioteknologi</option>
                    <option value="Kimia">Kimia</option>
                    <option value="Strategi Perusahaan">Strategi Perusahaan</option>
                    <option value="Digital Marketing">Digital Marketing</option>
                    <option value="E-Commerce">E-Commerce</option>
                    <option value="Pendidikan">Pendidikan</option>
                    <option value="Pendidikan">Teknik-Elektro</option>
                    <option value="Pendidikan">Teknik-Kimia</option>
                    <option value="Pendidikan">Teknik-Mesin</option>
                    <option value="Pendidikan">Teknik-Industri</option>
                    <option value="Pendidikan">Teknik-Lainnya</option>
                    <option value="Dunia Hiburan">Dunia Hiburan</option>
                    <option value="Ahli Nutrisi">Ahli Nutrisi</option>
                    <option value="Geologi/Geofisika">Geologi/Geofisika</option>
                    <option value="Dokter/Perawat/Farmasi">Dokter/Perawat/Farmasi</option>
                    <option value="Jasa Turis">Jasa Turis</option>
                    <option value="IT/Komputer-Hardware">IT/Komputer-Hardware</option>
                    <option value="IT/Komputer-Admin Network/Sistem/Database">IT/Komputer-Admin Network/Sistem/Database</option>
                    <option value="IT/Komputer-Software">IT/Komputer-Software</option>
                    <option value="Jurnalis/Editor">Jurnalis/Editor</option>
                    <option value="Hukum">Hukum</option>
                    <option value="Logistik">Logistik</option>
                    <option value="Perbaikan(Fasilitas & Mesin)">Perbaikan(Fasilitas & Mesin)</option>
                    <option value="Manufaktur">Manufaktur</option>
                    <option value="Marketing">Marketing</option>
                    <option value="Humas/Komunikasi">Humas/Komunikasi</option>
                    <option value="Asuransi">Asuransi</option>
                    <option value="Sales">Sales</option>
                    <option value="Sains & Teknologi">Sains & Teknologi</option>
                </select>
            </div>

            <div class="form-group">
                <label class="text-black font-weight-bold" for="lokasi">Industri:</label>
                <select name="industry" class="form-control">
                    <option selected>--Pilih Industri Pekerjaan--</option>
                    <option value="Akuntasi/Audit/Layanan Pajak">Akuntasi/Audit/Layanan Pajak</option>
                    <option value="Pengiklanan">Pengiklanan</option>
                    <option value="Penerbangan">Penerbangan</option>
                    <option value="Agrikultur/Kehutanan/Perikanan">Agrikultur/Kehutanan/Perikanan</option>
                    <option value="Arsitektur">Arsitektur</option>
                    <option value="Call Center/IT-Enabled Services/BPO">Call Center/IT-Enabled Services/BPO</option>
                    <option value="Kimia/Pupuk/Pestisida">Kimia/Pupuk/Pestisida</option>
                    <option value="Komputer/IT(Hardware)">Komputer/IT(Hardware)</option>
                    <option value="Komputer/IT(Software)">Komputer/IT(Software)</option>
                    <option value="Jasa Keuangan">Jasa Keuangan</option>
                    <option value="Bioteknologi/Farmasi/Klinis">Bioteknologi/Farmasi/Klinis</option>
                    <option value="Pendidikan">Pendidikan</option>
                    <option value="Listrik & Elektronik">Listrik & Elektronik</option>
                    <option value="Makanan & Minuman/Katering/Restoran">Makanan & Minuman/Katering/Restoran</option>
                    <option value="Permata/Perhiasan">Permata/Perhiasan</option>
                    <option value="Kesehatan/Medis">Kesehatan/Medis</option>
                    <option value="Hotel/Perhotelan">Hotel/Perhotelan</option>
                    <option value="Dunia Hiburan/Media">Dunia Hiburan/Media</option>
                    <option value="Manajemen Sumber Daya Manusia">Manajemen Sumber Daya Manusia</option>
                    <option value="Jurnalistik">Jurnalistik</option>
                    <option value="Hukum">Hukum</option>
                    <option value="Kelautan">Kelautan</option>
                    <option value="Manufaktur">Manufaktur</option>
                    <option value="Minyak/Gas/Minyak Bumi">Minyak/Gas/Minyak Bumi</option>
                    <option value="Sains & Teknologi">Sains & Teknologi</option>
                    <option value="Olahraga">Olahraga</option>
                    <option value="Keamanan/Penegakan Hukum">Keamanan/Penegakan Hukum</option>
                    <option value="Telekomunikasi">Telekomunikasi</option>
                    <option value="Tekstil/Garmen">Tekstil/Garmen</option>
                    <option value="Transportasi/Logistik">Transportasi/Logistik</option>
                </select>
            </div>

            <div class="form-group">
                <div>
                    <label class="text-black font-weight-bold" for="namPej">Jabatan:</label>
                    <select name="position" class="form-control">
                        <option selected>--Pilih Jabatan--</option>
                        <option value="CEO/GM/Direktur/Senior Manajer">CEO/GM/Direktur/Senior Manajer</option>
                        <option value="Manajer/Asisten Manajer">Manajer/Asisten Manajer</option>
                        <option value="Supervisor/Koordinator">Supervisor/Koordinator</option>
                        <option value="Staff(non-manajemen & non-supervisor)">Staff(non-manajemen & non-supervisor)</option>
                        <option value="Pengalaman kurang dari 1 tahun">Pengalaman kurang dari 1 tahun</option>
                    </select>
                </div>
            </div>

        <button type="submit" class="btn btn-primary btn-lg btn-block"><span class="fas fa-paper-plane"></span>Kirim</button>
        </fieldset>
    </form>
    <a href="{{ url('/profile_applicant') }}"><button type="button" class="btn btn-primary col-lg-6 offset-lg-3 btn-lg btn-block"><span class="fas fa-arrow-left"></span>Kembali</button></a>
</div>

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
</script>

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
</body>
</html>


