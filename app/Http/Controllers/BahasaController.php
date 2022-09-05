<?php

namespace App\Http\Controllers;

use App\Models\Bahasa;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BahasaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $bahasa = new Bahasa;
        $bahasa->bahasa = $request->bahasa;
        $bahasa->lisan = $request->lisan;
        $bahasa->tulisan = $request->tulisan;
        $bahasa->user_id = $user->id;
        $bahasa->save();
        $request->session()->flash('alert-success', 'Data bahasa berhasil ditambah!');
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
        DB::table('languange')->where('id',$id)->delete();
        $request->session()->flash('alert-success', 'Data bahasa berhasil dihapus!');
        // alihkan halaman ke halaman pegawai
        return redirect('/profile_applicant');
    }
}
