<?php

namespace App\Http\Controllers;

use App\Models\JobApply;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileMatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request,$id,$jobid,$jobap)
    {
        $score=0;
        $user = User::where('id', $id)->firstOrFail();
        $job_applies = DB::table('job_applies')
            ->join('job', 'job.id', '=', 'job_applies.job_id')
            ->join('user', 'user.id', '=', 'job_applies.user_id')
            ->where('job_applies.id','=',$jobap)
            ->where('user.id','=',$id)
            ->first();
        $request->session()->put('nama', $user->name);
        $request->session()->put('nama_lowongan', $job_applies->nama_job);
        $request->session()->put('industri', $job_applies->industri);
        $request->session()->put('kualifikasi', $job_applies->edukasi);
        $request->session()->put('keterampilan', $job_applies->keterampilan);
        $request->session()->put('keahlian', $job_applies->keahlian);
        $request->session()->put('pengalaman_kerja', $job_applies->pengalaman_kerja);

        $educations = DB::table('education')->select('id','nama_universitas', 'fakultas', 'jurusan','kualifikasi','ipk',DB::raw('DATE_FORMAT(tanggal_wisuda, "%d %M %Y") as tawis'))->where('user_id', '=', $user->id)->get();
        $skills = DB::table('skill')->where('user_id', '=', $user->id)->get();
        $experiences = DB::table('experience')->select('id','nama_job', 'nama_perusahaan','keahlian','industri','jabatan',DB::raw('DATE_FORMAT(tanggal_mulai, "%d %M %Y") as tamul'),DB::raw('DATE_FORMAT(tanggal_selesai, "%d %M %Y") as tasel'))->where('user_id', '=', $user->id)->get();
//        dd($educations->pluck('nama_universitas'));
        $req_year=(int)$job_applies->pengalaman_kerja;


        foreach ($educations as $education){
            if($job_applies->edukasi == 'SMA/SMK'){
                if($education->kualifikasi != $job_applies->edukasi){
                    $score+=1;
                }else{
                    $score+=1;
                }
            }

            if($job_applies->edukasi == 'Sarjana' || $job_applies->edukasi == 'Diploma'){
                if($education->kualifikasi == 'SMA/SMK'){
                    $score+=0;
                }else{
                    $score+=1;
                }
            }

            if($job_applies->edukasi == 'Master/Pasca Sarjana'){
                if($education->kualifikasi == 'SMA/SMK' || $education->kualifikasi == 'Sarjana' || $education->kualifikasi == 'Diploma'){
                    $score+=0;
                }else{
                    $score+=1;
                }
            }

            if($job_applies->edukasi == 'Doktor'){
                if($education->kualifikasi == 'Doktor'){
                    $score+=1;
                }else{
                    $score+=0;
                }
            }
        }

        foreach ($skills as $skill){
            if($skill->skill_name == $job_applies->keterampilan){
                $score+=1;
            }
        }

        foreach ($experiences as $experience){
            $diff = abs(strtotime($experience->tasel)-strtotime($experience->tamul));
            $years = floor($diff / (365*60*60*24));

            if($experience->industri == $job_applies->industri && $experience->keahlian == $job_applies->keahlian && (int)$years >= $req_year){
                $score+=3;
            }else if($experience->industri != $job_applies->industri && $experience->keahlian == $job_applies->keahlian && (int)$years >= $req_year){
                $score+=2;
            }
            else if($experience->industri == $job_applies->industri && $experience->keahlian != $job_applies->keahlian && (int)$years >= $req_year){
                $score+=2;
            }
            else if($experience->industri == $job_applies->industri && $experience->keahlian == $job_applies->keahlian && (int)$years < $req_year){
                $score+=2;
            }
            else if($experience->industri == $job_applies->industri && $experience->keahlian != $job_applies->keahlian && (int)$years < $req_year){
                $score+=1;
            }
            else if($experience->industri != $job_applies->industri && $experience->keahlian == $job_applies->keahlian && (int)$years < $req_year){
                $score+=1;
            }
            else if($experience->industri != $job_applies->industri && $experience->keahlian != $job_applies->keahlian && (int)$years >= $req_year){
                $score+=1;
            }
        }
        $request->session()->put('skor', $score);

        return view('profile_matchup',compact('job_applies','educations','skills','experiences'));
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
