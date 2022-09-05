<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Lamaran Dan Transaksi Perusahaan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
<style type="text/css">
    table tr td,
    table tr th{
        font-size: 13pt;
        border: 1px solid #ddd;
        padding: 8px;
    }

    table{
        border-collapse: collapse;
    }

    .footer {
        width: 100%;
        text-align: center;
        position: fixed;
    }

    .footer {
        bottom: 0px;
    }
    .pagenum:before {
        content: counter(page);
    }

</style>

<center>
    <h1>Laporan Lamaran Dan Transaksi Perusahaan {{Session::get('cname')}}</h1>
    <h5>{{Session::get('tanggal')}}</h5>
</center>

<div class="p-3">
    <h3>Daftar Lamaran Yang Diterima</h3>
    Data pelamar yang berhasil diterima oleh perusahaan karena mencukupi syarat minimum lowongan.
    @if($job_applies_terima->count()>0)
    <div>
        <table>
            <thead>
            <tr>
                @if(Session::get('role')=='company')
                    <th scope="col">Pelamar</th>
                @endif
                <th scope="col">Lowongan</th>
                @if(Session::get('role')=='company')
                    <th scope="col">No.Telp</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Kabupaten/Kota</th>
                @endif
            </tr>
            </thead>
            <tbody id="myTable">

                @foreach($job_applies_terima as $data)
                    <tr>
                        @if(Session::get('role')=='company')
                            <td>{{ $data->name }}</td>
                        @endif
                        <td>{{ $data->nama_job }}</td>
                        @if(Session::get('role')=='company')
                            <td>{{ $data->no_telp }}</td>
                            <td>{{ $data->alamat }}</td>
                            <td>{{ ucwords(strtolower($data->kota)) }}</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@elseif($job_applies_terima->count()==0)
    <div style="color: red;font-weight: bold;">
        Informasi lamaran yang diterima masih belum ada.
    </div>
@endif

<div class="p-3">
    <h3>Daftar Lamaran Yang Ditolak</h3>
    Data pelamar yang ditolak oleh perusahaan karena tidak mencukupi syarat minimum lowongan.
    @if($job_applies_tolak->count()>0)
    <div>
        <table class="table table-bordered">
            <thead>
            <tr>
                @if(Session::get('role')=='company')
                    <th scope="col">Pelamar</th>
                @endif
                <th scope="col">Lowongan</th>
                @if(Session::get('role')=='company')
                    <th scope="col">No.Telp</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Kabupaten/Kota</th>
                @endif
            </tr>
            </thead>
            <tbody id="myTable">

            @foreach($job_applies_tolak as $data)
                <tr>
                    @if(Session::get('role')=='company')
                        <td>{{ $data->name }}</td>
                    @endif
                    <td>{{ $data->nama_job }}</td>
                    @if(Session::get('role')=='company')
                        <td>{{ $data->no_telp }}</td>
                        <td>{{ $data->alamat }}</td>
                        <td>{{ ucwords(strtolower($data->kota)) }}</td>
                    @endif
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
    @elseif($job_applies_tolak->count()==0)
        <div style="color: red;font-weight: bold;">
            Informasi lamaran yang ditolak masih belum ada.
        </div>
    @endif
</div>

<div class="p-3">
    <h3>Daftar Lamaran Yang Batal Wawancara</h3>
    Data pelamar yang sudah diterima tapi membatalkan wawancara.
    @if($job_applies_batal->count()>0)
    <div>
        <table class="table table-bordered">
            <thead>
            <tr>
                @if(Session::get('role')=='company')
                    <th scope="col">Pelamar</th>
                @endif
                <th scope="col">Lowongan</th>
                @if(Session::get('role')=='company')
                    <th scope="col">No.Telp</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Kabupaten/Kota</th>
                @endif
            </tr>
            </thead>
            <tbody id="myTable">

            @foreach($job_applies_batal as $data)
                <tr>
                    @if(Session::get('role')=='company')
                        <td>{{ $data->name }}</td>
                    @endif
                    <td>{{ $data->nama_job }}</td>
                    @if(Session::get('role')=='company')
                        <td>{{ $data->no_telp }}</td>
                        <td>{{ $data->alamat }}</td>
                        <td>{{ ucwords(strtolower($data->kota)) }}</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @elseif($job_applies_batal->count()==0)
        <div style="color: red;font-weight: bold;">
            Informasi lamaran yang batal wawancara masih belum ada.
        </div>
    @endif
</div>

<div class="footer">
    Halaman <span class="pagenum"></span>
</div>

<div class="mt-7"></div>

<div class="p-3">
    <h3>Riwayat Transaksi Perusahaan</h3>
    Data transaksi pembelian paket langganan yang telah dilakukan perusahaan {{Session::get('cname')}}.
</div>
@if($transaction->count()>0)
<div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">Tanggal Transaksi</th>
            <th scope="col">Harga Paket</th>
            <th scope="col">Uang Bayar</th>
        </tr>
        </thead>
        <tbody id="myTable">

            <?php
            $total=0;
            ?>
            @foreach($transaction as $data)
                <tr>
                    <td>{{ $data->tatran }}</td>
                    <td>Rp{{ number_format($data->harga_paket,2,',','.') }}</td>
                    <td>Rp{{ number_format($data->uang_bayar,2,',','.') }}</td>
                </tr>
                <?php
                $total+=$data->uang_bayar;
                    ?>
            @endforeach
            <tr>
                <td colspan="2">Total Pengeluaran</td>
                <!--td></td!-->
                <td>Rp{{ number_format($total,2,',','.') }}</td>
            </tr>
        </tbody>
    </table>
</div>
@elseif($transaction->count()==0)
    <div style="color: red;font-weight: bold;">
        Informasi transaksi masih belum ada.
    </div>
@endif

<div class="footer">
    Halaman <span class="pagenum"></span>
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
