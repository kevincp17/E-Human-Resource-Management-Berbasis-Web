<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Lowongan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
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
<h1 align="center">Update Data Lowongan</h1>
<div id="container">
    <form  id="addjobForm" action="{{url('/update_career')}}" method="post" class="col-lg-6 offset-lg-3 " enctype="multipart/form-data">
        <fieldset style="background-color:deepskyblue;" class="rounded p-2">
            {{ csrf_field() }}
            <input class="form-control" type="hidden" name="cid" value="{{ Session::get('cid') }}">
            <div class="form-group">
                <label class="text-black font-weight-bold" for="namPej">Nama Lowongan:</label>
                <input class="form-control" type="text" id="namPej" name="namLow" value="{{ $job['nama_job'] }}">
            </div>

            <div class="form-group">
                <div>
                    <label class="text-black font-weight-bold" for="namPej">Tipe Pegawai:</label>
                    <select name="type"  class="form-control">
                        <option value="{{ $job['tipe_pegawai'] }}" selected>{{ $job['tipe_pegawai'] }}</option>
                        <option>--Pilih Tipe Pegawai--</option>
                        <option value="Full-Time">Full-Time</option>
                        <option value="Part-Time">Part-Time</option>
                        <option value="Temporer">Temporer</option>
                        <option value="Kontrak">Kontrak</option>
                        <option value="Internship">Internship</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div>
                    <label class="text-black font-weight-bold" for="namPej">Tingkat Posisi:</label>
                    <select name="postion" class="form-control">
                        <option value="{{ $job['posisi'] }}" selected>{{ $job['posisi'] }}</option>
                        <option>--Pilih Tingkat Posisi--</option>
                        <option value="CEO/GM/Direktur/Senior Manajer">CEO/GM/Direktur/Senior Manajer</option>
                        <option value="Manajer/Asisten Manajer">Manajer/Asisten Manajer</option>
                        <option value="Supervisor/Koordinator">Supervisor/Koordinator</option>
                        <option value="Staff(non-manajemen & non-supervisor)">Staff(non-manajemen & non-supervisor)</option>
                        <option value="Pengalaman kurang dari 1 tahun">Pengalaman kurang dari 1 tahun</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="text-black font-weight-bold" for="namPer">Tahun Pengalaman Bekerja:</label>
                <select name="exp" class="form-control">
                    <option value="{{ $job['pengalaman_kerja'] }}" selected>{{ $job['pengalaman_kerja'] }}</option>
                    <option>--Minimal Pengalaman Kerja--</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="Lebih dari 10">Lebih dari 10</option>
                </select>
            </div>

            <div class="form-group">
                <label class="text-black font-weight-bold" for="lokasi">Keahlian:</label>
                <select name="expertise" class="form-control">
                    <option value="{{ $job['keahlian'] }}" selected>{{ $job['keahlian'] }}</option>
                    <option>--Pilih Keahlian--</option>
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
                <label class="text-black font-weight-bold" for="lokasi">Keterampilan:</label>
                <select name="skill" class="form-control">
                    <option value="{{ $job['keterampilan'] }}" selected>{{ $job['keterampilan'] }}</option>
                    <option>--Pilih Keterampilan--</option>
                    <option value="ABAP">ABAP</option>
                    <option value="AJAX">AJAX</option>
                    <option value="Apache Tomcat">Apache Tomcat</option>
                    <option value="Business Intelligence">Business Intelligence</option>
                    <option value="C">C</option>
                    <option value="C#">C#</option>
                    <option value="Cloud Computing">Cloud Computing</option>
                    <option value="DB2">DB2</option>
                    <option value="DHCP">DHCP</option>
                    <option value="DNS">DNS</option>
                    <option value="eDiscovery">eDiscovery</option>
                    <option value="Ethernet">Ethernet</option>
                    <option value="ERP">ERP</option>
                    <option value="Firewall">Firewall</option>
                    <option value="Frame Relay">Frame Relay</option>
                    <option value="Flash">Flash</option>
                    <option value="Gateway">Gateway</option>
                    <option value="HTML">HTML</option>
                    <option value="HP-UX">HP-UX</option>
                    <option value="HUB/Switch">HUB/Switch</option>
                    <option value="IIS">IIS</option>
                    <option value="Illustrator">Illustrator</option>
                    <option value="Informatika">Informatika</option>
                    <option value="JavaScript">JavaScript</option>
                    <option value="JDBC">JDBC</option>
                    <option value="JSP">JSP</option>
                    <option value="LAN">LAN</option>
                    <option value="Linux">Linux</option>
                    <option value="Lotus Notes">Lotus Notes</option>
                    <option value="Microsoft Office">Microsoft Office</option>
                    <option value="MySQL">MySQL</option>
                    <option value="Microsoft Project">Microsoft Project</option>
                    <option value=".NET">.NET</option>
                    <option value="NAS">NAS</option>
                    <option value="NIC">NIC</option>
                    <option value="Oracle DB">Oracle DB</option>
                    <option value="Open Source">Open Source</option>
                    <option value="Oracle Application Server">Oracle Application Server</option>
                    <option value="PHP">PHP</option>
                    <option value="PL/SQL">PL/SQL</option>
                    <option value="Python">Python</option>
                    <option value="QA">QA</option>
                    <option value="QoS">QoS</option>
                    <option value="Ruby">Ruby</option>
                    <option value="RPG">RPG</option>
                    <option value="Router">Router</option>
                    <option value="SAP">SAP</option>
                    <option value="Shell">Shell</option>
                    <option value="SQL Server">SQL Server</option>
                    <option value="TCP/IP">TCP/IP</option>
                    <option value="Tomcat">Tomcat</option>
                    <option value="TSO/ISPF">TSO/ISPF</option>
                    <option value="UBUNTU">UBUNTU</option>
                    <option value="UML">UML</option>
                    <option value="UNIX">UNIX</option>
                    <option value="Virtualisasi">Virtualisasi</option>
                    <option value="Visual C++">Visual C++</option>
                    <option value="VPN">VPN</option>
                    <option value="WAN">WAN</option>
                    <option value="Window OS">Window OS</option>
                    <option value="Wireless">Wireless</option>
                    <option value="XML">XML</option>
                    <option value="XSN">XSN</option>
                </select>
            </div>

            <div class="form-group">
                <label class="text-black font-weight-bold" for="lokasi">Riwayat Pendidikan:</label>
                <select name="education" class="form-control">
                    <option value="{{ $job['edukasi'] }}" selected>{{ $job['edukasi'] }}</option>
                    <option>--Pilih Riwayat Pendidikan--</option>
                    <option value="Diploma(D3)">Diploma(D3)</option>
                    <option value="Sarjana(S1)">Sarjana(S1)</option>
                    <option value="Master/Pasca Sarjana(S2)">Master/Pasca Sarjana(S2)</option>
                    <option value="Doktor(S3)">Doktor(S3)</option>
                    <option value="SMA/SMK">SMA/SMK</option>
                </select>
            </div>

            <div class="form-group">
                <label class="text-black font-weight-bold" for="telp">Gaji:</label>
                <div class="row">
                    <div class="col-md-3">
                        <input class="form-control" type="number" id="telp" name="gaji_low" min="1800000" value="{{ $job['min_gaji'] }}" placeholder="Min">
                    </div>
                    <div>
                        <h4>~</h4>
                    </div>
                    <div class="col-md-3">
                        <input class="form-control" type="number" id="telp" name="gaji_high" value="{{ $job['max_gaji'] }}" placeholder="Max">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="text-black font-weight-bold" for="gaji">Deskripsi Pekerjaan:</label>
                <textarea class="form-control" rows="4" cols="50" name="desk" placeholder="Masukkan deskripsi pekerjaan" form="addjobForm">{{ $job['job_desc'] }}</textarea>
            </div>

            <div class="form-group">
                <label class="text-black font-weight-bold" for="lokasi">Industri:</label>
                <select name="industry" class="form-control">
                    <option value="{{ $job['industri'] }}" selected>{{ $job['industri'] }}</option>
                    <option>--Pilih Industri Pekerjaan--</option>
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
                <label class="text-black font-weight-bold" for="gaji">Tunjangan Dan Lain-lain:</label>
                <textarea class="form-control" rows="4" cols="50" name="benefits" placeholder="Masukkan tunjangan perusahaan">{{ $job['benefit'] }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-lg btn-block"><span class="fas fa-paper-plane"></span>Kirim</button>
        </fieldset>
    </form>
    <a href="{{ url('/career_list') }}"><button type="button" class="btn btn-primary col-lg-6 offset-lg-3 btn-lg btn-block"><span class="fas fa-arrow-left"></span>Kembali</button></a>
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

<script>
    if ($("#contact_us").length > 0) {
        $("#contact_us").validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 50
                },
                mobile_number: {
                    required: true,
                    digits:true,
                    minlength: 10,
                    maxlength:12,
                },
                email: {
                    required: true,
                    maxlength: 50,
                    email: true,
                },
            },
            messages: {
                name: {
                    required: "Please enter name",
                    maxlength: "Your last name maxlength should be 50 characters long."
                },
                mobile_number: {
                    required: "Please enter contact number",
                    digits: "Please enter only numbers",
                    minlength: "The contact number should be 10 digits",
                    maxlength: "The contact number should be 12 digits",
                },
                email: {
                    required: "Please enter valid email",
                    email: "Please enter valid email",
                    maxlength: "The email name should less than or equal to 50 characters",
                },
            },

            submitHandler: function(form) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('#send_form').html('Sending..');
                $.ajax({
                    url: 'http://localhost/blog/save-form' ,
                    type: "POST",
                    data: $('#contact_us').serialize(),
                    success: function( response ) {
                        $('#send_form').html('Submit');
                        $('#res_message').show();
                        $('#res_message').html(response.msg);
                        $('#msg_div').removeClass('d-none');
                        document.getElementById("contact_us").reset();
                        setTimeout(function(){
                            $('#res_message').hide();
                            $('#msg_div').hide();
                        },10000);
                    }
                });
            }
        })
    }
</script>

</body>
</html>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
    $(document).ready(function () {
        $('#mapelForm').validate({
            rules: {
                namat: {
                    required: true
                },

            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
