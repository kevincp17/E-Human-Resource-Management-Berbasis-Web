<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $provinces = Province::pluck('name','id');
        return view('experience_form',['provinces'=>$provinces]);
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
        $user = DB::table('user')->select('id')->where('name','=',$request->userid)->first();


        $experience = new Experience;
        $experience->nama_job = $request->job;
        $experience->nama_perusahaan = $request->company;
        $experience->tanggal_mulai = $request->tamul;
        $experience->tanggal_selesai = $request->tasel;
        $experience->keahlian = $request->expertise;
        $experience->industri = $request->industry;
        $experience->jabatan = $request->position;
        $experience->user_id = $user->id;
        $experience->save();
        $request->session()->flash('alert-success', 'Data pengalaman bekerja berhasil ditambah!');
        return redirect('/profile_applicant');
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
    public function destroy(Request $request,$id)
    {
        //
        DB::table('experience')->where('id',$id)->delete();
        $request->session()->flash('alert-success', 'Data pengalaman bekerja berhasil dihapus!');
        // alihkan halaman ke halaman pegawai
        return redirect('/profile_applicant');
    }
}
