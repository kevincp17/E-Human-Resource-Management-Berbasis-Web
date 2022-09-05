<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lamar Pekerjaan</title>
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
<div style="margin-top: 100px;"></div>

<h1 align="center">Lamar Pekerjaan {{ Session::get('job') }}</h1>
<div id="container">
    <form id="mapelForm" action="{{url('/insert_apply')}}" method="post" class="col-lg-6 offset-lg-3 form-horizontal" enctype="multipart/form-data">
        <fieldset style="background-color:deepskyblue;" class="rounded p-2">
            {{ csrf_field() }}
            <input class="form-control" type="hidden" id="jobid" name="jobid" value="{{ Session::get('job') }}">
            <input class="form-control" type="hidden" id="jobid" name="comid" value="{{ Session::get('company') }}">
            <input class="form-control" type="hidden" id="userid" name="userid" value="{{ Session::get('user_id') }}">

            <div class="form-group">
                <label class="text-black font-weight-bold" for="gajiEks">Surat Lamaran(PDF maks 2MB):</label>
                <input type="file" name="sular" class="form-control @error('sular') is-invalid @enderror" accept="application/pdf">
                @error('sular')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-lg btn-block"><span class="fas fa-paper-plane"></span>Unggah Surat Lamaran</button>
        </fieldset>
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
