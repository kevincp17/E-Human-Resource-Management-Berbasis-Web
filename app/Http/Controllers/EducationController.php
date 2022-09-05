<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Fakultas;
use App\Models\Job;
use App\Models\Jurusan;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $educations = DB::table('education')->get();
        return view('/profile_applicant',['educations' => $educations]);
    }

    public function indexFakultas()
    {
        //
        $fakultas = Fakultas::pluck('name','id');
        return view('/education_form',['fakultas' => $fakultas]);
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

        if($request->akhir == "Universitas"){
            $fakultas = Fakultas::where('id', $request->fakultas)->firstOrFail();
            $jurusan = Jurusan::where('id', $request->jurusan)->firstOrFail();

            $education = new Education();
            $education->nama_universitas = $request->unName;
            $education->fakultas = $fakultas->name;
            $education->jurusan = $jurusan->name;
            $education->kualifikasi = $request->kualifikasi;
            $education->tanggal_wisuda = $request->wisud;
            $education->ipk = number_format($request->ipk,2);
            $education->user_id = $user->id;

            $education->save();
        }else{
            $education = new Education();
            $education->nama_universitas = $request->unName;
            $education->fakultas = "Belum Kuliah";
            $education->jurusan = "Belum Kuliah";
            $education->kualifikasi = "SMA/SMK";
            $education->tanggal_wisuda = $request->wisud;
            $education->ipk = "Belum Kuliah";
            $education->user_id = $user->id;

            $education->save();
        }


        $request->session()->flash('alert-success', 'Data riwayat pendidikan berhasil ditambah!');
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
        DB::table('education')->where('id',$id)->delete();
        $request->session()->flash('alert-success', 'Data riwayat pendidikan berhasil dihapus!');
        // alihkan halaman ke halaman pegawai
        return redirect('/profile_applicant');
    }
}
