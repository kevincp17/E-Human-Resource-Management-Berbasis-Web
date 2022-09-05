<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Fakultas;
use App\Models\Jurusan;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Http\Request;

class DependentDropdownController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexKabupaten(Request $request)
    {
        //
        $regencies = Regency::where('province_id', $request->get('id'))
            ->pluck('name', 'id');

        return response()->json($regencies);
    }

    public function indexKecamatan(Request $request)
    {
        //
        $districts = District::where('regency_id', $request->get('id'))
            ->pluck('name', 'id');

        return response()->json($districts);
    }

    public function indexKelurahan(Request $request)
    {
        //
        $villages = Village::where('district_id', $request->get('id'))
            ->pluck('name', 'id');

        return response()->json($villages);
    }

    public function indexJurusan(Request $request)
    {
        //
        $jurusan = Jurusan::where('fakultas_id', $request->get('id'))
            ->pluck('name', 'id');

        return response()->json($jurusan);
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
