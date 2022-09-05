<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Job;
use App\Models\Rekening;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Session::get('role')=='company'){
            $jobs = DB::table('job')
                ->join('company', 'company.id', '=', 'job.company_id')
                ->join('user', 'user.id', '=', 'company.user_id')
                ->select('job.id','job.nama_job','job.keahlian','company.name','user.kota')
                ->where('company.id','=',$request->session()->get('cid'))
                ->get();
        }
        else if(Session::get('role')!='company'){
                $jobs = DB::table('job')
                    ->join('company', 'company.id', '=', 'job.company_id')
                    ->join('rekening', 'rekening.company_id', '=', 'company.id')
                    ->join('transaction', 'transaction.rekening_id', '=', 'rekening.id')
                    ->join('user', 'user.id', '=', 'company.user_id')
                    ->select('job.id','job.nama_job','job.keahlian','company.name','company.id AS comid','user.kota')
                    ->where('transaction.status','=','Aktif')
                    ->get();
        }
        return view('career_list',['jobs'=>$jobs]);
    }

    public function searchCareer(Request $request)
    {
        $query = $request->get('query');
        $filterResult = DB::table('job')
            ->join('company', 'company.id', '=', 'job.company_id')
            ->join('rekening', 'rekening.company_id', '=', 'company.id')
            ->join('transaction', 'transaction.rekening_id', '=', 'rekening.id')
            ->join('user', 'user.id', '=', 'company.user_id')
            ->select('nama_job')
            ->where('nama_job', 'LIKE', '%'. $query. '%')
            ->where('transaction.status','=','Aktif')
            ->get();
        $dataModifiedJob = array();
        foreach ($filterResult as $data)
        {
            $dataModifiedJob[] = $data->nama_job;
        }

        return response()->json($dataModifiedJob);
    }

    public function searchCareerKota(Request $request)
    {
        $query2 = $request->get('query2');
        $filterResult2 = DB::table('job')
            ->join('company', 'company.id', '=', 'job.company_id')
            ->join('user', 'user.id', '=', 'company.user_id')
            ->select(Str::title('user.kota'))
            ->where('user.kota', 'LIKE', '%'. $query2. '%')
            ->get();
        $dataModifiedKota = array();
        foreach ($filterResult2 as $data)
        {
            $dataModifiedKota[] = $data->kota;
        }

        return response()->json($dataModifiedKota);
    }

    public function filterCareer(Request $request)
    {
        $jobResult=$request->searchJobCom;
        $kotaResult=$request->searchKota;
        $expertiseResult=$request->searchExpertise;
        if($request->session()->get('role')=='Job Applicant'){
            if ($jobResult && $kotaResult==null && !$expertiseResult==null) {
                $jobs = DB::table('job')
                    ->join('company', 'company.id', '=', 'job.company_id')
                    ->join('rekening', 'rekening.company_id', '=', 'company.id')
                    ->join('transaction', 'transaction.rekening_id', '=', 'rekening.id')
                    ->join('user', 'user.id', '=', 'company.user_id')
                    ->select('company.id AS comid','job.id','job.nama_job','job.keahlian','company.name',Str::title('user.kota'))
                    ->where('job.nama_job', 'LIKE', $jobResult)
                    ->where('transaction.status','=','Aktif')
                    ->get();
            }

            else if ($jobResult==null && $kotaResult && !$expertiseResult==null) {
                $jobs = DB::table('job')
                    ->join('company', 'company.id', '=', 'job.company_id')
                    ->join('rekening', 'rekening.company_id', '=', 'company.id')
                    ->join('transaction', 'transaction.rekening_id', '=', 'rekening.id')
                    ->join('user', 'user.id', '=', 'company.user_id')
                    ->select('company.id AS comid','job.id','job.nama_job','job.keahlian','company.name',Str::title('user.kota'))
                    ->where('user.kota', 'LIKE', $kotaResult)
                    ->where('transaction.status','=','Aktif')
                    ->get();
            }

            else if ($jobResult==null && $kotaResult==null && $expertiseResult) {
                $jobs = DB::table('job')
                    ->join('company', 'company.id', '=', 'job.company_id')
                    ->join('rekening', 'rekening.company_id', '=', 'company.id')
                    ->join('transaction', 'transaction.rekening_id', '=', 'rekening.id')
                    ->join('user', 'user.id', '=', 'company.user_id')
                    ->select('company.id AS comid','job.id','job.nama_job','job.keahlian','company.name',Str::title('user.kota'))
                    ->where('job.keahlian', '=', $expertiseResult)
                    ->where('transaction.status','=','Aktif')
                    ->get();
            }
        }else if($request->session()->get('role')=='company'){
            if ($jobResult) {
                $jobs = DB::table('job')
                    ->join('company', 'company.id', '=', 'job.company_id')
                    ->join('user', 'user.id', '=', 'company.user_id')
                    ->select('job.id','job.nama_job','job.keahlian','company.name',Str::title('user.kota'))
                    ->where('job.nama_job', 'LIKE', $jobResult)
                    ->where('company.id', 'LIKE', $request->session()->get('cid'))
                    ->get();
            }

            else if ($kotaResult) {
                $jobs = DB::table('job')
                    ->join('company', 'company.id', '=', 'job.company_id')
                    ->join('user', 'user.id', '=', 'company.user_id')
                    ->select('job.id','job.nama_job','job.keahlian','company.name',Str::title('user.kota'))
                    ->where('user.kota', 'LIKE', $kotaResult)
                    ->where('company.id', 'LIKE', $request->session()->get('cid'))
                    ->get();
            }

            else if ($expertiseResult) {
                $jobs = DB::table('job')
                    ->join('company', 'company.id', '=', 'job.company_id')
                    ->join('user', 'user.id', '=', 'company.user_id')
                    ->select('job.id','job.nama_job','job.keahlian','company.name',Str::title('user.kota'))
                    ->where('job.keahlian', 'LIKE', $expertiseResult)
                    ->where('company.id', 'LIKE', $request->session()->get('cid'))
                    ->get();
            }
        }
        return view('career_list',['jobs'=>$jobs]);
    }

    public function getOneJobDetail(Request $request,$id)
    {
        $jobs = Job::find($id);
        $company = Company::where('id', $jobs->company_id)->firstOrFail();
        $user = User::where('id', $company->user_id)->firstOrFail();
        $request->session()->put('job',$jobs->nama_job);
        $request->session()->put('desc',$jobs->job_desc);
        $request->session()->put('tipe',$jobs->tipe_pegawai);
        $request->session()->put('posisi',$jobs->posisi);
        $request->session()->put('industri',$jobs->industri);
        $request->session()->put('exp',$jobs->pengalaman_kerja);
        $request->session()->put('edu',$jobs->edukasi);
        $request->session()->put('ben',$jobs->benefit);
        $request->session()->put('min_salary',number_format($jobs->min_gaji,2,',','.'));
        $request->session()->put('max_salary',number_format($jobs->max_gaji,2,',','.'));
        $request->session()->put('job_id',$jobs->id);
        $request->session()->put('company',$company->name);
        $request->session()->put('kota',Str::title($user->kota));
        $request->session()->put('telp',$user->no_telp);
        $request->session()->put('foto', $company->foto);
        $request->session()->put('logo', $company->logo);
        return view('career_details',compact(['jobs','company','user']));
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

    public function getApplyJob(Request $request,$id,$comid)
    {
        $jobs = Job::find($id);
        $com = Company::find($comid);
        $request->session()->put('job',$jobs->nama_job);
        $request->session()->put('company',$com->name);
        return view('career_apply');
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

        $company = Company::where('id', $request->cid)->firstOrFail();

        $job = new Job;
        $job->nama_job = $request->namLow;
        $job->tipe_pegawai = $request->type;
        $job->posisi = $request->postion;
        $job->pengalaman_kerja = $request->exp;
        $job->keahlian = $request->expertise;
        $job->keterampilan = $request->skill;
        $job->edukasi = $request->education;
        $job->min_gaji = $request->gaji_low;
        $job->max_gaji = $request->gaji_high;
        $job->job_desc = $request->desk;
        $job->industri = $request->industry;
        $job->benefit = $request->benefits;
        $job->company_id = $company->id;
        $job->save();



        $rekening = Rekening::where('company_id', $company->id)->firstOrFail();


        $transaction = Transaction::where('rekening_id', $rekening->id)->where('status', 'Aktif')->firstOrFail();
        $transaction->jlh_iklan = $transaction->jlh_iklan+1;
        $transaction->save();


        if($transaction->jlh_iklan>=$transaction->jlh_paket_iklan){
            $request->session()->put('jumlah_iklan', 'Tidak Bisa');
        }

        $request->session()->flash('alert-success', 'Lowongan berhasil ditambahkan!');
        return redirect('/career_list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // mengambil data pegawai berdasarkan id yang dipilih
        $job = Job::find($id);
        // passing data pegawai yang didapat ke view edit.blade.php
        return view('update_lowongan',['job' => $job]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $job = Job::where('company_id', $request->session()->get('cid'))->firstOrFail();

        $job->nama_job = $request->namLow;
        $job->tipe_pegawai = $request->type;
        $job->posisi = $request->postion;
        $job->pengalaman_kerja = $request->exp;
        $job->keahlian = $request->expertise;
        $job->keterampilan = $request->skill;
        $job->edukasi = $request->education;
        $job->min_gaji = $request->gaji_low;
        $job->max_gaji = $request->gaji_high;
        $job->job_desc = $request->desk;
        $job->industri = $request->industry;
        $job->benefit = $request->benefits;
        $job->company_id = $request->cid;
        $job->save();

        $request->session()->put('job',$job->nama_job);
        $request->session()->put('desc',$job->job_desc);
        $request->session()->put('tipe',$job->tipe_pegawai);
        $request->session()->put('posisi',$job->posisi);
        $request->session()->put('ahli',$job->keahlian);
        $request->session()->put('exp',$job->pengalaman_kerja);
        $request->session()->put('edu',$job->edukasi);
        $request->session()->put('ben', $job->benefit);
        $request->session()->put('min_salary',number_format($job->min_gaji,2,',','.'));
        $request->session()->put('max_salary',number_format($job->max_gaji,2,',','.'));
        $request->session()->flash('alert-success', 'Data Lowongan yang dipilih berhasil diubah!');
        return redirect('/career_list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //
    }
}
