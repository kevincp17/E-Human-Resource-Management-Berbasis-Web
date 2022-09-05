<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil Pelamar Kerja</title>
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
    @if(Session::get('foto'))
        <img src="{{ asset("/photos/".Session::get('foto'))}}">
{{--    <img src="photos/{{ Session::get('foto') }}">--}}
    @else
        <h5 class="text-danger">Foto profil pelamar belum di upload</h5>
    @endif

    @if(Session::get('role')=='Job Applicant')
    <form action="{{(url('/image-uploadPost'))}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input class="form-control" type="hidden" name="userid" value="{{ Session::get('nama') }}">
        <div class="row">
            <div class="col-md-3">
                <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror">
                @error('photo')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-success">Update Foto Profil(jpeg,png,jpg maks 2MB)</button>
            </div>
        </div>
    </form>
        @endif

    <h3><i class="fa fa-user" aria-hidden="true"></i>{{ Session::get('nama') }}</h3>
    <h3><i class="fa fa-envelope" aria-hidden="true"></i>{{ Session::get('email') }}</h3>
    <h3><i class="fa fa-phone" aria-hidden="true"></i>{{ Session::get('telp') }}</h3>
    <h3><i class="fa fa-home" aria-hidden="true"></i>{{ Session::get('alamat') }} RT.{{ Session::get('rt') }} RW.{{ Session::get('rw') }},Kelurahan {{ Session::get('kelurahan') }}, Kecamatan {{ Session::get('kecamatan') }},{{ Session::get('kota') }},{{ Session::get('provinsi') }} {{ Session::get('kode_pos') }}</h3>
    <a class="btn btn-primary mr-md-3" href="/applied_job"><span class="fas fa-arrow-left"></span>Kembali ke halaman sebelumnya</a>

</div>

@if(Session::get('role')=='Job Applicant' || Session::get('role')=='company')
    <div class="p-3 border m-2 bg-light">
        <h1>KTP</h1>
        <div class="text-center">
            @if(Session::get('ktp'))
                <h5 class="text-success">KTP pelamar sudah di upload</h5>
                <a class="btn btn-primary" href="{{ url('/display_ktp/'.Session::get('ktp')) }}" ><span class="fas fa-redo"></span>Tampilkan KTP</a>
            @else
                <h5 class="text-danger">Foto KTP pelamar belum di upload</h5>
            @endif
        </div>
        @if (Session::get('role')=='Job Applicant')
        <form id="mapelForm" action="{{url('/insert_ktp')}}" method="post" class="col-lg-10 offset-lg-3 form-horizontal" enctype="multipart/form-data">
                @csrf
                <input class="form-control" type="hidden" name="namektp" value="{{ Session::get('nama') }}">
                <div class="row">
                    <div class="col-md-6">
                        <input type="file" name="ktp" class="form-control @error('ktp') is-invalid @enderror" accept="application/pdf">
                        @error('ktp')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success">Update KTP(PDF maks 2MB)</button>
                    </div>
                </div>
        </form>
        @endif
    </div>

    <div class="p-3 border m-2 bg-light">
        <h1>CV</h1>
        <div class="text-center">
            @if(Session::get('cv'))
                <h5 class="text-success">CV pelamar sudah di upload</h5>
                <a class="btn btn-primary" href="{{ url('/display_cv/'.Session::get('cv')) }}" ><span class="fas fa-redo"></span>Tampilkan CV</a>
            @else
                <h5 class="text-danger">CV pelamar belum di upload</h5>
            @endif
        </div>
        @if(Session::get('role')=='Job Applicant')
        <form id="mapelForm" action="{{url('/insert_cv')}}" method="post" class="col-lg-10 offset-lg-3 form-horizontal" enctype="multipart/form-data">
            @csrf
            <input class="form-control" type="hidden" name="namektp" value="{{ Session::get('nama') }}">
            <div class="row">
                <div class="col-md-6">
                    <input type="file" name="cv" class="form-control @error('cv') is-invalid @enderror" accept="application/pdf">
                    @error('cv')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <button type="submit" class="btn btn-success">Update CV(PDF maks 2MB)</button>
                </div>
            </div>
        </form>
        @endif
    </div>

{{--    <div class="p-3 border m-2 bg-light">--}}
{{--        <h1>Surat Lamaran</h1>--}}
{{--        <div class="text-center">--}}
{{--            @if(Session::get('sular'))--}}
{{--                <h5 class="text-success">Surat lamaran sudah di upload</h5>--}}
{{--                <a class="btn btn-primary" href="{{ url('/display_sular/'.Session::get('sular')) }}" role="button"><span class="fas fa-redo"></span>Tampilkan Surat Lamaran</a>--}}
{{--            @else--}}
{{--                <h5 class="text-danger">Surat lamaran belum di upload</h5>--}}
{{--            @endif--}}
{{--        </div>--}}
{{--        @if(Session::get('role')=='Job Applicant')--}}
{{--        <form id="mapelForm" action="{{url('/insert_apply')}}" method="post" class="col-lg-10 offset-lg-3 form-horizontal" enctype="multipart/form-data">--}}
{{--            @csrf--}}
{{--            <input class="form-control" type="hidden" name="namektp" value="{{ Session::get('user_id') }}">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-6">--}}
{{--                    <input type="file" name="sular" class="form-control" accept="application/pdf,application/vnd.ms-excel">--}}
{{--                </div>--}}

{{--                <div class="col-md-6">--}}
{{--                    <button type="submit" class="btn btn-success">Unggah Surat Lamaran</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--        @endif--}}
{{--    </div>--}}
@endif


<div class="p-3 border m-2 bg-light">
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div>
    <h1>Riwayat Pendidikan</h1>
    <div class="table-responsive">
        @if (Session::get('role')=='Job Applicant')
            <a class="btn btn-primary mr-md-3" href="education_form"><span class="fas fa-plus"></span>Tambah Riwayat Pendidikan</a>
        @endif
        <br>
        <table class="table table-bordered table-striped table-hover table-sm">
            <thead>
            <tr>
                <th scope="col">Nama Universitas</th>
                <th scope="col">Fakultas</th>
                <th scope="col">Jurusan</th>
                <th scope="col">Kualifikasi</th>
                <th scope="col">Tanggal Wisuda</th>
                <th scope="col">IPK</th>
                @if (Session::get('role')=='Job Applicant')
                <th scope="col">Opsi</th>
                @endif
            </tr>
            </thead>
            <tbody id="myTable">
            @if($educations->count()>0)
            @foreach($educations as $data)
                <tr>
                    <td>{{ $data->nama_universitas }}</td>
                    <td>{{ $data->fakultas }}</td>
                    <td>{{ $data->jurusan }}</td>
                    <td>{{ $data->kualifikasi }}</td>
                    <td>{{ $data->tawis}}</td>
                    <td>{{ $data->ipk }}</td>
                    @if (Session::get('role')=='Job Applicant')
                    <td><a class="btn btn-danger mr-md-3" href="education_delete/{{ $data->id }}"><span class="fa fa-trash" aria-hidden="true"></span>Hapus</a></td>
                    @endif
                </tr>
            @endforeach
            @elseif($educations->count()==0)
                <tr>
                    <td colspan="7"><h3 class="text-center text-danger">Data riwayat pendidikan masih belum ada</h3></td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>

    <h1>Keterampilan</h1>
    <div class="table-responsive">
        @if (Session::get('role')=='Job Applicant')
            <a class="btn btn-primary mr-md-3" href="skill_form"><span class="fas fa-plus"></span>Tambah Keterampilan</a>
        @endif
        <br>
        <table class="table table-bordered table-striped table-hover table-sm ">
            <thead>
            <tr>
                <th scope="col">Keterampilan</th>
                <th scope="col">Tingkat</th>
                @if (Session::get('role')=='Job Applicant')
                    <th scope="col">Opsi</th>
                @endif
            </tr>
            </thead>
            <tbody id="myTable">
            @if($skills->count()>0)
            @foreach($skills as $data)
                <tr>
                    <td>{{ $data->skill_name }}</td>
                    <td>{{ $data->tingkat }}</td>
                    @if (Session::get('role')=='Job Applicant')
                    <td><a class="btn btn-danger mr-md-3" href="skill_delete/{{ $data->id }}"><span class="fa fa-trash" aria-hidden="true"></span>Hapus</a></td>
                    @endif
                </tr>
            @endforeach
            @elseif($skills->count()==0)
                <tr>
                    <td colspan="7"><h3 class="text-center text-danger">Data keterampilan masih belum ada</h3></td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>

    <h1>Pengalaman Bekerja</h1>
    <div class="table-responsive">
        @if (Session::get('role')=='Job Applicant')
            <a class="btn btn-primary mr-md-3" href="experience_form"><span class="fas fa-plus"></span>Tambah Pengalaman Bekerja</a>
        @endif
        <br>
        <table class="table table-bordered table-striped table-hover table-sm">
            <thead>
            <tr>
                <th scope="col">Nama Pekerjaan</th>
                <th scope="col">Nama Perusahaan</th>
                <th scope="col">Spesialisasi</th>
                <th scope="col">Industri</th>
                <th scope="col">Jabatan</th>
                <th scope="col">Lama Bekerja</th>
                @if (Session::get('role')=='Job Applicant')
                    <th scope="col">Opsi</th>
                @endif
            </tr>
            </thead>
            <tbody id="myTable">
            @if($experiences->count()>0)
            @foreach($experiences as $data)
                <tr>
                    <td>{{ $data->nama_job }}</td>
                    <td>{{ $data->nama_perusahaan }}</td>
                    <td>{{ $data->keahlian }}</td>
                    <td>{{ $data->industri }}</td>
                    <td>{{ $data->jabatan }}</td>
                    <td>{{ $data->tamul }}-{{ $data->tasel }}</td>
                    @if (Session::get('role')=='Job Applicant')
                    <td><a class="btn btn-danger mr-md-3" href="experience_delete/{{ $data->id }}"><spam class="fa fa-trash" aria-hidden="true"></spam>Hapus</a></td>
                    @endif
                </tr>
            @endforeach
            @elseif($experiences->count()==0)
                <tr>
                    <td colspan="7"><h3 class="text-center text-danger">Data pengalaman bekerja masih belum ada</h3></td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>

    <h1>Bahasa</h1>
    Tingkat Kemahiran: 0 - Jelek, 10 - Baik Sekali
    <div class="table-responsive">
        @if (Session::get('role')=='Job Applicant')
            <a class="btn btn-primary mr-md-3" href="bahasa_form"><span class="fas fa-plus"></span>Tambah Bahasa</a>
        @endif
        <br>
        <table class="table table-bordered table-striped table-hover table-sm">
            <thead>
            <tr>
                <th scope="col">Bahasa</th>
                <th scope="col">Lisan</th>
                <th scope="col">Tulisan</th>
                @if (Session::get('role')=='Job Applicant')
                    <th scope="col">Opsi</th>
                @endif
            </tr>
            </thead>
            <tbody id="myTable">
            @if($bahasa->count()>0)
                @foreach($bahasa as $data)
                    <tr>
                        <td>{{ $data->bahasa }}</td>
                        <td>{{ $data->lisan }}</td>
                        <td>{{ $data->tulisan }}</td>
                        @if (Session::get('role')=='Job Applicant')
                            <td><a class="btn btn-danger mr-md-3" href="bahasa_delete/{{ $data->id }}"><spam class="fa fa-trash" aria-hidden="true"></spam>Hapus</a></td>
                        @endif
                    </tr>
                @endforeach
            @elseif($experiences->count()==0)
                <tr>
                    <td colspan="7"><h3 class="text-center text-danger">Data bahasa masih belum ada</h3></td>
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
