<?php

namespace App\Http\Controllers;

use App\Mail\ApplyMail;
use App\Models\Job;
use App\Models\JobApply;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class JobApplyController extends Controller
{

    public function index(Request $request)
    {
        //
        $user = User::where('name', $request->session()->get('nama'))->firstOrFail();
        if($request->session()->get('role')=='Job Applicant'){
            $job_applies = DB::table('job_applies')
                ->join('job', 'job.id', '=', 'job_applies.job_id')
                ->join('company', 'company.id', '=', 'job.company_id')
                ->join('user', 'user.id', '=', 'job_applies.user_id')
                ->select('job_applies.id AS jobap','job.id AS jobid','user.id','user.name','job.nama_job', 'user.no_telp','user.alamat','user.kota','job_applies.status','job_applies.surat_lamaran','company.name AS company_name')
                ->where('user.id', '=', $user->id)
                ->get();
        }
        else if ($request->session()->get('role')=='company'){
            $job_applies = DB::table('job_applies')
                ->join('job', 'job.id', '=', 'job_applies.job_id')
                ->join('user', 'user.id', '=', 'job_applies.user_id')
                ->select('job_applies.id AS jobap','job.id AS jobid','job.company_id','user.id','user.name','job.nama_job', 'user.no_telp','user.alamat','user.kota','job_applies.status','job_applies.surat_lamaran')
                ->where('job.company_id','=',$request->session()->get('cid'))
                ->get();
        }

//        dd($request->session()->get('cid'));

        return view('/applied_job',['job_applies' => $job_applies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function accept_apply(Request $request)
    {
        //
        $user = User::where('name', $request->session()->get('nama'))->firstOrFail();
        $job = Job::where('nama_job', $request->session()->get('nama_lowongan'))->firstOrFail();
        $company = DB::table('company')->where('id','=',$job->company_id)->first();
        $userCom = DB::table('user')->where('id','=',$company->user_id)->first();

        $job_applies=JobApply::where('user_id', $user->id)->where('job_id', $job->id)->firstOrFail();
        $job_applies->status = "Diterima";
        $job_applies->tgl_wawancara = $request->tawan;
        $job_applies->link = $request->link;
        $job_applies->save();

        Mail::to($user->email)->send(new ApplyMail($user,$userCom,$job,$job_applies,$company));

        $job_applies = DB::table('job_applies')
            ->join('job', 'job.id', '=', 'job_applies.job_id')
            ->join('user', 'user.id', '=', 'job_applies.user_id')
            ->select('job_applies.id AS jobap','job.id as jobid','job.company_id','user.id','user.name','job.nama_job', 'user.no_telp','user.alamat','user.kota','job_applies.status','job_applies.surat_lamaran')
            ->where('job.company_id','=',$request->session()->get('cid'))
            ->get();

        $request->session()->flash('alert-success', 'Lamaran telah diterima');
        return view('/applied_job',['job_applies' => $job_applies]);
    }

    public function decline_apply(Request $request,$id,$jobid,$jobap)
    {
        //
        $user = User::where('id', $id)->firstOrFail();
        $job = Job::where('id', $jobid)->firstOrFail();
        $company = DB::table('company')->where('id','=',$job->company_id)->first();
        $userCom = DB::table('user')->where('id','=',$company->user_id)->first();

        $job_applies=JobApply::where('id', $jobap)->firstOrFail();
        $job_applies->status = "Ditolak";
        $job_applies->save();

        Mail::to($user->email)->send(new ApplyMail($user,$userCom,$job,$job_applies,$company));

        $job_applies = DB::table('job_applies')
            ->join('job', 'job.id', '=', 'job_applies.job_id')
            ->join('user', 'user.id', '=', 'job_applies.user_id')
            ->select('job.company_id','user.id','user.name','job.nama_job', 'user.no_telp','user.alamat','user.kota','job_applies.status','job_applies.surat_lamaran')
            ->where('job.company_id','=',$request->session()->get('cid'))
            ->get();

        $request->session()->flash('alert-danger', 'Lamaran ditolak admin');
        return view('/applied_job',['job_applies' => $job_applies]);
    }

    public function interview(Request $request,$id, $jobid)
    {
        $job_applies=JobApply::where('user_id', $id)->where('id', $jobid)->firstOrFail();
//        $job_applies = DB::table('job_applies')
//            ->join('job', 'job.id', '=', 'job_applies.job_id')
//            ->join('user', 'user.id', '=', 'job_applies.user_id')
//            ->select('job.company_id','user.id','user.name','job.nama_job', 'user.no_telp','user.alamat','user.kota','job_applies.salary_expectation','job_applies.status')
//            ->where('job.company_id','=',$request->session()->get('cid'))
//            ->get();
        $request->session()->put('jadwal',$job_applies->tgl_wawancara);
        $request->session()->put('link',$job_applies->link);
        return view('interview_view',['job_applies' => $job_applies]);
    }

    public function changeInterview(Request $request)
    {
        //
        $job_applies=JobApply::where('id', $request->jobaid)->firstOrFail();
        $job_applies->tgl_wawancara = $request->tawan_new;
        $job_applies->save();
        $request->session()->put('jadwal',$job_applies->tgl_wawancara);
        return view('interview_view',['job_applies' => $job_applies]);
    }

    public function declineInterview(Request $request,$id,$jobid,$jobap)
    {
        //
        $user = User::where('id', $id)->firstOrFail();
        $job = Job::where('id', $jobid)->firstOrFail();
        $company = DB::table('company')->where('id','=',$job->company_id)->first();
        $userCom = DB::table('user')->where('id','=',$company->user_id)->first();

        $job_applies=JobApply::where('user_id', $id)->where('id', $jobap)->firstOrFail();
        $job_applies->status = 'Batal Wawancara';
        $job_applies->save();

        Mail::to($userCom->email)->send(new ApplyMail($user,$userCom,$job,$job_applies,$company));

        $job_applies = DB::table('job_applies')
            ->join('job', 'job.id', '=', 'job_applies.job_id')
            ->join('company', 'company.id', '=', 'job.company_id')
            ->join('user', 'user.id', '=', 'job_applies.user_id')
            ->select('job_applies.id AS jobap','job.id AS jobid','user.id','user.name','job.nama_job', 'user.no_telp','user.alamat','user.kota','job_applies.status','job_applies.surat_lamaran','company.name AS company_name')
            ->where('user.id', '=', $user->id)
            ->get();

        $request->session()->flash('alert-danger', 'Wawancara berhasil ditolak');

        return view('applied_job',['job_applies' => $job_applies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'sular' => 'required|mimetypes:application/pdf|max:2048'
        ],
            [
                'sular.required' => 'Harap isi field ini!',
                'sular.mimetypes' => 'Ekstensi file harus PDF!',
                'sular.max' => 'Ukuran maksimal file surat lamaran adalah 2MB'
            ]);

        $company = DB::table('company')->where('name','=',$request->session()->get('company'))->first();
        $job = DB::table('job')->where('nama_job','=',$request->session()->get('job'))->where('company_id','=',$company->id)->first();
        $user = DB::table('user')->where('id','=',$request->session()->get('user_id'))->first();
        $userCom = DB::table('user')->where('id','=',$company->user_id)->first();

        $sularName = time().'.'.$request->sular->extension();
        $request->sular->move(public_path('surat_lamaran'), $sularName);

        $jobApply = new JobApply;
        $jobApply->user_id = $user->id;
        $jobApply->job_id = $job->id;
        $jobApply->status = 'Menunggu jawaban';
        $jobApply->surat_lamaran = $sularName;
        $jobApply->save();

        Mail::to($userCom->email)->send(new ApplyMail($user,$userCom,$job,$jobApply,$company));

        $request->session()->put('sular', $sularName);

        $request->session()->flash('alert-success', 'Lamaran anda sudah masuk, silahkan dicek dihalaman lamaran anda!');
        return redirect('/career_list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $count = DB::table('job_applies')->select('id')->count();

        if($count > 0) {
            //more than one raw
            return view('/applied_job',['job_applies' => $job_applies]);
        }else {
            //zero raw
        }
    }

    public function displaySular($sular)
    {
        $file = JobApply::where('surat_lamaran', $sular)->firstOrFail();
        $path = 'surat_lamaran/';
        $pathToFile = public_path($path . $file->surat_lamaran);
        return response()->file($pathToFile);
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

    public function getApplySearch($id)
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
