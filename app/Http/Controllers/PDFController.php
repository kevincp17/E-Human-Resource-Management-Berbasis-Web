<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        return view('laporan');
    }

    public function downloadPDF(Request $request)
    {
        $job_applies_terima = DB::table('job_applies')
            ->join('job', 'job.id', '=', 'job_applies.job_id')
            ->join('user', 'user.id', '=', 'job_applies.user_id')
            ->select('user.name','job.nama_job', 'user.no_telp','user.alamat','user.kota','job_applies.status')
            ->where('job.company_id','=',$request->session()->get('cid'))
            ->where('job_applies.status','=',"Diterima")
            ->get();


        $job_applies_tolak = DB::table('job_applies')
            ->join('job', 'job.id', '=', 'job_applies.job_id')
            ->join('user', 'user.id', '=', 'job_applies.user_id')
            ->select('job.company_id','user.name','job.nama_job', 'user.no_telp','user.alamat','user.kota','job_applies.status')
            ->where('job.company_id','=',$request->session()->get('cid'))
            ->where('job_applies.status','=',"Ditolak")
            ->get();



        $job_applies_batal = DB::table('job_applies')
            ->join('job', 'job.id', '=', 'job_applies.job_id')
            ->join('user', 'user.id', '=', 'job_applies.user_id')
            ->select('user.name','job.nama_job', 'user.no_telp','user.alamat','user.kota','job_applies.status')
            ->where('job.company_id','=',$request->session()->get('cid'))
            ->where('job_applies.status','=',"Batal Wawancara")
            ->get();

            $transaction = DB::table('transaction')
                ->join('rekening', 'rekening.id', '=', 'transaction.rekening_id')
                ->join('company', 'company.id', '=', 'rekening.company_id')
                ->select('transaction.id','transaction.uang_bayar','transaction.harga_paket',DB::raw('DATE_FORMAT(transaction.tgl_transaksi, "%d %M %Y") as tatran'),'transaction.status')
                ->where('company.id','=',$request->session()->get('cid'))
                ->get();

        $date = date('d F Y');
        $request->session()->put('tanggal', $date);

        $pdf = PDF::loadview('laporan_perusahaan',['job_applies_terima'=>$job_applies_terima,'job_applies_tolak'=>$job_applies_tolak,'job_applies_batal'=>$job_applies_batal,'transaction'=>$transaction]);
        return $pdf->stream();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
