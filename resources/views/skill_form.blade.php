<html>
<head>
    <title>Form Keterampilan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>

<body style="background-color:#ffffcc;">

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a style="pointer-events: none; cursor: default;" class="navbar-brand" href="{{ url('/') }}">HRD</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" data-target="#navbarSupportedContent"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav">
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

<div class="p-3 mt-5">
    <h4 class="card-title mt-3 text-center">Masukkan Keterampilan</h4>
    <form action="{{(url('/skill_user'))}}" method="post" class="col-lg-6 offset-lg-3 form-horizontal" id="validate_form" >
        <fieldset style="background-color:deepskyblue;" class="rounded p-2">
        {{ csrf_field() }}
        <input class="form-control" type="hidden" name="userid" value="{{ Session::get('nama') }}">
        <div class="form-group">
            <div>
                <label class="text-black font-weight-bold" for="namPej">Nama Keterampilan:</label>
                <input class="form-control" type="text" id="namPej" name="ket">
{{--                <select name="ket" class="form-control" required data-parsley-required-message="You must select at least one option." data-parsley-trigger="keyup">--}}
{{--                    <option selected>--Pilih Keterampilan--</option>--}}
{{--                    <option value="ABAP">ABAP</option>--}}
{{--                    <option value="AJAX">AJAX</option>--}}
{{--                    <option value="Apache Tomcat">Apache Tomcat</option>--}}
{{--                    <option value="Business Intelligence">Business Intelligence</option>--}}
{{--                    <option value="C">C</option>--}}
{{--                    <option value="C#">C#</option>--}}
{{--                    <option value="Cloud Computing">Cloud Computing</option>--}}
{{--                    <option value="DB2">DB2</option>--}}
{{--                    <option value="DHCP">DHCP</option>--}}
{{--                    <option value="DNS">DNS</option>--}}
{{--                    <option value="eDiscovery">eDiscovery</option>--}}
{{--                    <option value="Ethernet">Ethernet</option>--}}
{{--                    <option value="ERP">ERP</option>--}}
{{--                    <option value="Firewall">Firewall</option>--}}
{{--                    <option value="Frame Relay">Frame Relay</option>--}}
{{--                    <option value="Flash">Flash</option>--}}
{{--                    <option value="Gateway">Gateway</option>--}}
{{--                    <option value="HTML">HTML</option>--}}
{{--                    <option value="HP-UX">HP-UX</option>--}}
{{--                    <option value="HUB/Switch">HUB/Switch</option>--}}
{{--                    <option value="IIS">IIS</option>--}}
{{--                    <option value="Illustrator">Illustrator</option>--}}
{{--                    <option value="Informatika">Informatika</option>--}}
{{--                    <option value="JavaScript">JavaScript</option>--}}
{{--                    <option value="JDBC">JDBC</option>--}}
{{--                    <option value="JSP">JSP</option>--}}
{{--                    <option value="LAN">LAN</option>--}}
{{--                    <option value="Linux">Linux</option>--}}
{{--                    <option value="Lotus Notes">Lotus Notes</option>--}}
{{--                    <option value="Microsoft Office">Microsoft Office</option>--}}
{{--                    <option value="MySQL">MySQL</option>--}}
{{--                    <option value="Microsoft Project">Microsoft Project</option>--}}
{{--                    <option value=".NET">.NET</option>--}}
{{--                    <option value="NAS">NAS</option>--}}
{{--                    <option value="NIC">NIC</option>--}}
{{--                    <option value="Oracle DB">Oracle DB</option>--}}
{{--                    <option value="Open Source">Open Source</option>--}}
{{--                    <option value="Oracle Application Server">Oracle Application Server</option>--}}
{{--                    <option value="PHP">PHP</option>--}}
{{--                    <option value="PL/SQL">PL/SQL</option>--}}
{{--                    <option value="Python">Python</option>--}}
{{--                    <option value="QA">QA</option>--}}
{{--                    <option value="QoS">QoS</option>--}}
{{--                    <option value="Ruby">Ruby</option>--}}
{{--                    <option value="RPG">RPG</option>--}}
{{--                    <option value="Router">Router</option>--}}
{{--                    <option value="SAP">SAP</option>--}}
{{--                    <option value="Shell">Shell</option>--}}
{{--                    <option value="SQL Server">SQL Server</option>--}}
{{--                    <option value="TCP/IP">TCP/IP</option>--}}
{{--                    <option value="Tomcat">Tomcat</option>--}}
{{--                    <option value="TSO/ISPF">TSO/ISPF</option>--}}
{{--                    <option value="UBUNTU">UBUNTU</option>--}}
{{--                    <option value="UML">UML</option>--}}
{{--                    <option value="UNIX">UNIX</option>--}}
{{--                    <option value="Virtualisasi">Virtualisasi</option>--}}
{{--                    <option value="Visual C++">Visual C++</option>--}}
{{--                    <option value="VPN">VPN</option>--}}
{{--                    <option value="WAN">WAN</option>--}}
{{--                    <option value="Window OS">Window OS</option>--}}
{{--                    <option value="Wireless">Wireless</option>--}}
{{--                    <option value="XML">XML</option>--}}
{{--                    <option value="XSN">XSN</option>--}}
{{--                </select>--}}
            </div>
        </div>

        <div class="form-group">
            <div>
                <label class="text-black font-weight-bold" for="namPej">Pilih tingkat keterampilan:</label>
                <select name="tingkat" class="form-control">
                    <option selected>--Pilih Tingkat--</option>
                    <option value="Lanjutan">Lanjutan</option>
                    <option value="Menengah">Menengah</option>
                    <option value="Pemula">Pemula</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-lg btn-block"><span class="fas fa-paper-plane"></span>Kirim</button>
        </fieldset>
    </form>
    <a href="{{ url('/profile_applicant') }}"><button type="button" class="btn btn-primary col-lg-6 offset-lg-3 btn-lg btn-block"><span class="fas fa-arrow-left"></span>Kembali</button></a>

</div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

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
    $(document).ready(function(){
        $(document).ready(function() {
            $("#validate_form").validate({
                rules: {
                    ket: "required",
                    tingkat: "required",
                },
                messages: {
                    ket: "Ket is required",
                    tingkat: "Tingkat is required",
                }
            });
        });
    });
</script>

</body>
</html>


