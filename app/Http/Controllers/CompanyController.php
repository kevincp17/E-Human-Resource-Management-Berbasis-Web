<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = DB::table('company')
            ->join('user', 'user.id', '=', 'company.user_id')
            ->select('user.name','company.name as nama_com','company.SIUP')
            ->orderBy('user.name')
            ->simplePaginate(10);
        return view('company_list',['company'=>$company]);
    }

    public function displaySIUP($siup)
    {
        $file = Company::where('SIUP', $siup)->firstOrFail();
        $path = 'siup/';
        $pathToFile = public_path($path . $file->SIUP);
        return response()->file($pathToFile);
    }

    public function searchCompany(Request $request)
    {
        $query = $request->get('query');
        $filterResult = DB::table('company')
            ->join('user', 'user.id', '=', 'company.user_id')
            ->select('user.name','company.name as nama_com','company.SIUP')
            ->where('company.name', 'LIKE', '%'. $query. '%')
            ->orderBy('user.name')
            ->simplePaginate(10);

        $dataModifiedComName = array();
        foreach ($filterResult as $data)
        {
            $dataModifiedComName[] = $data->nama_com;
        }

        return response()->json($dataModifiedComName);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function filterCompany(Request $request)
    {
        $comnamResult=$request->searchComName;

        $company = DB::table('company')
            ->join('user', 'user.id', '=', 'company.user_id')
            ->select('user.name','company.name as nama_com','company.SIUP')
            ->where('company.name', 'LIKE', $comnamResult)
            ->orderBy('user.name')
            ->simplePaginate(10);

        return view('company_list',['company'=>$company]);
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
