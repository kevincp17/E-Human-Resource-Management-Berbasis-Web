<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Lamaran</title>
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

<div class="p-3">
    <h1>Daftar Lamaran</h1>

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div>
    <div class="table-responsive">
        <br>
        <table class="table table-bordered table-striped table-hover table-sm mx-auto bg-light">
            <thead>
            <tr>


                @if(Session::get('role')=='company')
                    <th scope="col">Pelamar</th>
                @endif
                    @if(Session::get('role')=='Job Applicant')
                        <th scope="col">Lowongan</th>
                        <th scope="col">Nama Perusahaan</th>
                    @endif

                @if(Session::get('role')=='company')
                    <th scope="col">No.Telp</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Kabupaten/Kota</th>
                @endif
                <th scope="col">Status</th>
                @if(Session::get('role')=='company' || Session::get('role')=='Job Applicant')
                    <th scope="col">Opsi</th>
                @endif
            </tr>
            </thead>
            <tbody id="myTable">

            @if($job_applies->count()>0)
            @foreach($job_applies as $data)
                <tr>
                    @if(Session::get('role')=='company')
                        <td>{{ $data->name }}</td>
                    @endif

                        @if(Session::get('role')=='Job Applicant')
                    <td>{{ $data->nama_job }}</td>
                    <td>{{ $data->company_name }}</td>
                        @endif

                    @if(Session::get('role')=='company')
                        <td>{{ $data->no_telp }}</td>
                        <td>{{ $data->alamat }}</td>
                        <td>{{ ucwords(strtolower($data->kota)) }}</td>
                    @endif
                    <td>{{ $data->status }}</td>
                    @if(Session::get('role')=='company' && $data->status=='Menunggu jawaban')
                        <td>
                            <a class="btn btn-info mr-md-3" href="applied_detail/{{ $data->id }}"><span class="fas fa-info-circle"></span>Detail Pelamar</a>
                            <a class="btn btn-primary mr-md-3" href="{{ url('accept/ ' . $data->id . '/' . $data->jobid. '/' .$data->jobap)}}"><span class="fas fa-check-circle"></span>Terima</a>
                            <a class="btn btn-danger mr-md-3" href="{{ url('/decline_job/'.$data->id . '/' . $data->jobid. '/' .$data->jobap) }}" id="cancel"><spam class="fa fa-times" aria-hidden="true"></spam>Tolak</a>
                            <a class="btn btn-primary" href="{{ url('/display_sular/'.$data->surat_lamaran) }}" ><span class="fas fa-redo"></span>Tampilkan Surat Lamaran</a>
                        </td>
                        @elseif((Session::get('role')=='company' || Session::get('role')=='Job Applicant') && $data->status=='Diterima')
                            <td>
                                <a class="btn btn-info mr-md-3" href="{{ url('interview/ ' . $data->id . '/' . $data->jobap ."'")}}"><span class="fas fa-info-circle"></span>Jadwal Wawancara</a>
                                @if (Session::get('exist') && Session::get('role')=='Job Applicant')
                                <a class="btn btn-danger mr-md-3" href="{{ url('/decline_int/'. $data->id . '/' . $data->jobid. '/' .$data->jobap) }}" id="cancel"><spam class="fa fa-times" aria-hidden="true"></spam>Batal Wawancara</a>
                                @endif
                            </td>
                        @elseif((Session::get('role')=='company' || Session::get('role')=='Job Applicant') && ($data->status=='Batal Wawancara' || $data->status=='Menunggu jawaban'))
                            <td>
                                <a class="btn btn-primary" href="{{ url('/display_sular/'.$data->surat_lamaran) }}" ><span class="fas fa-redo"></span>Tampilkan Surat Lamaran</a>
                            </td>
                    @endif
                </tr>
            @endforeach
            @elseif($job_applies->count()==0)
                <tr>
                    <td colspan="7"><h3 class="text-center text-danger">Data lamaran masih belum ada</h3></td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
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

</body>
</html>
