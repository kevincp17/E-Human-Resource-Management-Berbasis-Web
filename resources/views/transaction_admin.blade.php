<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat Transaksi Perusahaan-Admin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <a class="nav-link" href="{{ url('/company_list') }}"><span class="fas fa-building"></span>Daftar Perusahaan</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/admin_transaction') }}"><span class="fas fa-cash-register"></span>Riwayat Transaksi Perusahaan</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/admin_credit') }}"><span class="fas fa-archive"></span>Data Paket</a>
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

<div class="p-3 text-center">
    <h1>Riwayat Transaksi</h1>
</div>

<div class="table-responsive p-3">
    <br>
    <table class="table table-bordered table-striped table-hover table-sm bg-light">
        <thead>
        <tr>
            <th scope="col">Nama</th>
            <th scope="col">Perusahaan</th>
            <th scope="col">Uang Bayar</th>
            <th scope="col">Harga Paket</th>
            <th scope="col">Tanggal Transaksi</th>
            <th scope="col">Status</th>
            <th scope="col">Opsi</th>
        </tr>
        </thead>
        <tbody id="myTable">
        @if($transaction->count()>0)
            @foreach($transaction as $data)
                <tr>
                    <td>{{ $data->nama_user }}</td>
                    <td>{{ $data->nama_com }}</td>
                    <td>Rp{{ number_format($data->uang_bayar,2,',','.') }}</td>
                    <td>Rp{{ number_format($data->harga_paket,2,',','.') }}</td>
                    <td>{{ $data->tatran }}</td>
                    <td>{{ $data->status }}</td>
                    @if ($data->status=='Menunggu Verifikasi')
                    <td><a class="btn btn-primary mr-md-3" href="verify_sub/{{ $data->id }}"><span class="fas fa-info-circle"></span>Verifikasi Bayaran</a></td>
                    @else
                        <td>Opsi tidak berlaku</td>
                    @endif
                </tr>
            @endforeach
        @elseif($transaction->count()==0)
            <tr>
                <td colspan="7"><h3 class="text-center text-danger">Data transaksi masih belum ada</h3></td>
            </tr>
        @endif
        </tbody>
    </table>
</div>

</body>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        var route = "{{ url('/admin_transaction/searchTransaction') }}";
        var transactions = [];

        // Listen for 'change' event, so this triggers when the user clicks on the checkboxes labels
        $('input[name="transaction[]"]').on('change', function (e) {

            e.preventDefault();
            transactions = []; // reset

            $('input[name="transaction[]"]:checked').each(function()
            {
                transactions.push($(this).val());
            });

            $('#jobCom').typeahead({
                source: function (query, process) {
                    return $.post(route, {
                        query: query
                    }, function (data) {
                        return process(data);
                    });
                }
            });

        });

    });
</script>

</html>