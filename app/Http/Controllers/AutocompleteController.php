<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AutocompleteController extends Controller
{
    //
    function index()
    {
//        $filterResult = DB::table('user')
//            ->select('username')
//            ->get();
//        dd($filterResult);
        return view('autocomplete');
    }

    function fetch(Request $request)
    {
        $query = $request->get('query');
        $filterResult = DB::table('job')
            ->select('nama_job')
            ->where('nama_job', 'LIKE', '%'. $query. '%')
            ->get();

        $dataModified = array();
        foreach ($filterResult as $data)
        {
            $dataModified[] = $data->nama_job;
        }

        return response()->json($dataModified);
    }
}
