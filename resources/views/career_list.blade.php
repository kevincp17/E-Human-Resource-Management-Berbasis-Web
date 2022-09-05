<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Lowongan Pekerjaan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

    </head>

<body style="background-color:#ffffcc;">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
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


<div class="p-3">
    @if (Session::get('role')=='Job Applicant')
    <h1>Cari Lowongan Yang Anda Inginkan</h1>
    @elseif(Session::get('role')=='company')
        <h1>Daftar Lowongan Yang Anda Buat</h1>
    @endif

    @if (Session::get('role')=='company' && Session::get('exist') && Session::get('status_transaksi')=='Aktif' && Session::get('jumlah_iklan')=='Bisa')
        <a class="btn btn-primary mr-md-3" href="{{ url('/career_add') }}"><span class="fas fa-plus"></span>Tambah Lowongan</a>
        @elseif(Session::get('role')=='company' && Session::get('exist') && (Session::get('status_transaksi')!='Aktif' || Session::get('jumlah_iklan')!='Bisa'))
            Untuk mengiklankan lowongan, <a href="{{ url('/company_credit') }}">beli kredit</a> terlebih dahulu.
        @endif
    <div class="m-3"></div>
    <form action="{{ url('/filter_career') }}" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-3 form-group">
                <input class="form-control" id="jobCom" type="text" name="searchJobCom" placeholder="Nama Pekerjaan" autocomplete="off">
            </div>

            @if (Session::get('role')=='Job Applicant')
            <div class="col-md-3 form-group">
                <input class="form-control" id="kota" name="searchKota" type="text" placeholder="Kabupaten/Kota" autocomplete="off">
            </div>
            @endif

            <div class="col-md-3 form-group">
                <select name="searchExpertise" class="form-control">
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

            <div class="col-md-3">
                <button type="submit" class="btn btn-primary btn-block"><span class="fas fa-search"></span>Cari</button>
            </div>


        </div>
    </form>
        <a class="btn btn-primary" href="{{ url('/career_list') }}" role="button"><span class="fas fa-redo"></span>Reset Data Lowongan</a>

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div>
    <div class="table-responsive">
        <br>
        <table class="table table-bordered table-striped table-hover table-sm bg-light">
            <thead>
            <tr>
                <th scope="col">Nama Pekerjaan</th>
                <th scope="col">Nama Perusahaan</th>
                <th scope="col">Kabupaten/Kota</th>
                <th scope="col">Opsi</th>
            </tr>
            </thead>
            <tbody id="myTable">
            @if($jobs->count()>0)
            @foreach($jobs as $data)
                <tr>
                    <td>{{ $data->nama_job }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ ucwords(strtolower($data->kota)) }}</td>
                    <td>
                        <a class="btn btn-primary mr-md-3" href="career_details/{{ $data->id }}"><span class="fas fa-info-circle"></span>Detail Lowongan</a>
                        @if (Session::get('exist') && Session::get('role')=='Job Applicant')
                            <a class="btn btn-danger mr-md-3" name="btnLamar" href="{{ url('career_apply/ ' . $data->id . '/' . $data->comid ."'")}}"><span class="fas fa-check"></span>Lamar Lowongan</a>
                        @elseif(Session::get('exist') && Session::get('role')=='company')
                            <a class="btn btn-danger mr-md-3" name="btnLamarEdit" href="career_edit/{{ $data->id }}"><span class="fas fa-edit"></span>Edit</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            @elseif($jobs->count()==0)
                <tr>
                    <td colspan="7"><h3 class="text-center text-danger">Data lowongan pekerjaan masih belum ada</h3></td>
                </tr>
            @endif
            </tbody >
        </table>
    </div>

</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript">
    var route = "{{ url('/search_career') }}";

    $('#jobCom').typeahead({
        source: function (query, process) {
            return $.get(route, {
                query: query
            }, function (data) {
                return process(data);
            });
        }
    });

    var route2 = "{{ url('/search_career2') }}";

    $('#kota').typeahead({
        source: function (query2, process) {
            return $.get(route2, {
                query: query2
            }, function (data) {
                return process(data);
            });
        }
    });
</script>

</body>
</html>

