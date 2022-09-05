<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Job;
use App\Models\User;
use Carbon\Carbon;
use Faker\Provider\File;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use League\CommonMark\Block\Element\Document;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $user = User::where('name', $request->session()->get('nama'))->firstOrFail();
        $request->session()->put('cv', $user->cv);
        $request->session()->put('sular', $user->surat_lamaran);
        $request->session()->put('ktp', $user->ktp);
//        $files=Document::file($user->id);
//        $request->session()->put('file', $user->cv);
        $educations = DB::table('education')->select('id','nama_universitas', 'fakultas', 'jurusan','kualifikasi','ipk',DB::raw('DATE_FORMAT(tanggal_wisuda, "%d %M %Y") as tawis'))->where('user_id', '=', $user->id)->get();
        $skills = DB::table('skill')->where('user_id', '=', $user->id)->get();
        $experiences = DB::table('experience')->select('id','nama_job', 'nama_perusahaan','keahlian','industri','jabatan',DB::raw('DATE_FORMAT(tanggal_mulai, "%d %M %Y") as tamul'),DB::raw('DATE_FORMAT(tanggal_selesai, "%d %M %Y") as tasel'))->where('user_id', '=', $user->id)->get();
        $bahasa = DB::table('languange')->select('id','bahasa', 'lisan','tulisan')->where('user_id', '=', $user->id)->get();

        return view('/profile_applicant',['educations' => $educations,'skills' => $skills,'experiences' => $experiences,'bahasa'=>$bahasa,'user'=>$user]);
    }

    public function index_company(Request $request)
    {
        //
        $user = User::where('name', $request->session()->get('nama'))->firstOrFail();
        $company =Company::where('user_id', $user->id)->firstOrFail();
        $request->session()->put('comverview', $company->overview);
            $request->session()->put('jml_peg', $company->jumlah_pegawai);
            $request->session()->put('time', $company->process_time);
            $request->session()->put('foto', $company->foto);
            return view('/profile_company',['company'=>$company,'user'=>$user]);
    }

    public function show_profile(Request $request,$id)
    {
        $user = User::where('id', $id)->firstOrFail();
        $role = \App\Models\Role::where('id', $user->role_id)->firstOrFail();
        $request->session()->put('nama', $user->name);
        $request->session()->put('alamat', $user->alamat);
        $request->session()->put('kota', Str::title($user->kota));
        $request->session()->put('telp', $user->no_telp);
        $request->session()->put('email', $user->email);
        $request->session()->put('ktp', $user->ktp);
        $request->session()->put('CV', $user->cv);
        $request->session()->put('sular', $user->surat_lamaran);
        $request->session()->put('foto', $user->foto);
//        $files=File::file($id);
//        $request->session()->put('file', $user->cv);
        $educations = DB::table('education')->select('id','nama_universitas', 'fakultas', 'jurusan','kualifikasi','ipk',DB::raw('DATE_FORMAT(tanggal_wisuda, "%d %M %Y") as tawis'))->where('user_id', '=', $user->id)->get();
        $skills = DB::table('skill')->where('user_id', '=', $user->id)->get();
        $experiences = DB::table('experience')->select('id','nama_job', 'nama_perusahaan','keahlian','industri','jabatan',DB::raw('DATE_FORMAT(tanggal_mulai, "%d %M %Y") as tamul'),DB::raw('DATE_FORMAT(tanggal_selesai, "%d %M %Y") as tasel'))->where('user_id', '=', $user->id)->get();
        $bahasa = DB::table('languange')->select('id','bahasa', 'lisan','tulisan')->where('user_id', '=', $user->id)->get();

        return view('/profile_applicant',['educations' => $educations,'skills' => $skills,'experiences' => $experiences,'bahasa'=>$bahasa,'user'=>$user]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function overviewEdit(Request $request)
    {
        // mengambil data pegawai berdasarkan id yang dipilih
        $com = Company::where('user_id', $request->session()->get('user_id'))->firstOrFail();
        // passing data pegawai yang didapat ke view edit.blade.php
        return view('company_overview',['com' => $com]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeOverview(Request $request)
    {
//        $com = DB::table('company')->select('id')->where('id','=',$request->cid)->first();
//        $com = Company::FindOrFail($com->id);
        $com = Company::where('user_id', $request->userid)->firstOrFail();
        $com->overview = $request->desk;
        $com->process_time = $request->process;
        $com->jumlah_pegawai = $request->size;
        $com->save();
        $request->session()->put('comverview',$com->overview);
        $request->session()->put('jml_peg', $com->jumlah_pegawai);
        $request->session()->put('time', $com->process_time);
        return redirect('/profile_company');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCV()
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

    public function ktpUpload()
    {
        return view('profile_applicant');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ktpUploadPost(Request $request)
    {
        $request->validate([
            'ktp' => 'required|mimetypes:application/pdf,application/vnd.ms-excel|max:2048'
        ],
            [
                'ktp.required' => 'Harap isi field ini!',
                'ktp.mimetypes' => 'Ekstensi file harus PDF!',
                'ktp.max' => 'Ukuran maksimal file KTP adalah 2MB'
            ]);

        $imageName = time().'.'.$request->ktp->extension();
        $request->ktp->move(public_path('ktp'), $imageName);

        /* Store $imageName name in DATABASE from HERE */
        $user = DB::table('user')->select('id')->where('name','=',$request->namektp)->first();
        $userFoto = User::FindOrFail($user->id);
        $userFoto->ktp = $imageName;
        $userFoto->save();

        $request->session()->put('ktp', $imageName);
        return back()
            ->with('success','You have successfully upload image.')
            ->with('ktp',$imageName);
    }

    public function displayKTP($ktp)
    {
        $file = User::where('ktp', $ktp)->firstOrFail();
        $path = 'ktp/';
        $pathToFile = public_path($path . $file->ktp);
        return response()->file($pathToFile);
    }

    public function cvUpload()
    {
        return view('profile_applicant');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cvUploadPost(Request $request)
    {
        $request->validate([
            'cv' => 'required|mimetypes:application/pdf,application/vnd.ms-excel|max:2048'
        ],
            [
                'cv.required' => 'Harap isi field ini!',
                'cv.mimetypes' => 'Ekstensi file harus PDF!',
                'cv.max' => 'Ukuran maksimal file CV adalah 2MB'
            ]);

        $cvName = time().'.'.$request->cv->extension();
        $request->cv->move(public_path('cv'), $cvName);

        /* Store $imageName name in DATABASE from HERE */
        $user = DB::table('user')->select('id')->where('name','=',$request->namektp)->first();
        $userCV = User::FindOrFail($user->id);
        $userCV->CV = $cvName;
        $userCV->save();

        $request->session()->put('cv', $cvName);
        return back()
            ->with('success','You have successfully upload cv.')
            ->with('cv',$cvName);
    }

    public function displayCV($cv)
    {
        $file = User::where('cv', $cv)->firstOrFail();
        $path = 'cv/';
        $pathToFile = public_path($path . $file->cv);
        return response()->file($pathToFile);
    }

    public function sularUpload()
    {
        return view('profile_applicant');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sularUploadPost(Request $request)
    {


        $sularName = time().'.'.$request->sular->extension();
        $request->sular->move(public_path('surat_lamaran'), $sularName);

        /* Store $imageName name in DATABASE from HERE */
        $user = DB::table('user')->select('id')->where('name','=',$request->session()->get('nama'))->first();
        $userSular = User::FindOrFail($user->id);
        $userSular->surat_lamaran = $sularName;
        $userSular->save();

        $request->session()->put('sular', $sularName);
        $request->session()->flash('alert-success', 'Lamaran anda sudah masuk, silahkan dicek dihalaman lamaran anda!');
        return redirect('/career_list');
    }

    public function displaySular($sular)
    {
        $file = User::where('surat_lamaran', $sular)->firstOrFail();
        $path = 'surat_lamaran/';
        $pathToFile = public_path($path . $file->surat_lamaran);
        return response()->file($pathToFile);
}
    public function imageUpload()
    {
        return view('profile_applicant');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageUploadPost(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
            [
                'photo.required' => 'Harap isi field ini!',
                'photo.image' => 'Ekstensi file harus jpeg,png atau jpg!',
                'photo.max' => 'Ukuran maksimal foto profil adalah 2MB'
            ]);

        $imageName = time().'.'.$request->photo->extension();
        $request->photo->move(public_path('photos'), $imageName);

        /* Store $imageName name in DATABASE from HERE */
        $user = DB::table('user')->where('name','=',$request->userid)->first();
        $user = User::FindOrFail($user->id);
        $user->foto = $imageName;
        $user->save();

        $request->session()->put('foto', $imageName);
        return back()
            ->with('success','You have successfully upload logo.')
            ->with('photo',$imageName);
    }

    public function imageUploadLogo()
    {
        return view('profile_applicant');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageUploadLogoPost(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
            [
                'logo.required' => 'Harap isi field ini!',
                'logo.image' => 'Ekstensi file harus jpeg,png atau jpg!',
                'logo.max' => 'Ukuran maksimal logo adalah 2MB'
            ]);

        $imageName = time().'.'.$request->logo->extension();
        $request->logo->move(public_path('logo'), $imageName);

        /* Store $imageName name in DATABASE from HERE */
        $com = DB::table('company')->select('id')->where('user_id','=',$request->userid)->first();
        $comLogo = Company::FindOrFail($com->id);
        $comLogo->logo = $imageName;
        $comLogo->save();

        $request->session()->put('logoCom', $imageName);
        return back()
            ->with('success','You have successfully upload logo.')
            ->with('logo',$imageName);
    }

    public function imageUploadCompany()
    {
        return view('profile_company');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageUploadCompanyPost(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
            [
                'photo.required' => 'Harap isi field ini!',
                'photo.image' => 'Ekstensi file harus jpeg,png,jpg,gif, atau svg!',
                'photo.max' => 'Ukuran maksimal foto perusahaan adalah 2MB'
            ]);

        $imageName = time().'.'.$request->photo->extension();

        $request->photo->move(public_path('photos'), $imageName);

        /* Store $imageName name in DATABASE from HERE */
        $com = DB::table('company')->select('id')->where('user_id','=',$request->userid)->first();
        $comFoto = Company::FindOrFail($com->id);
        $comFoto->foto = $imageName;
        $comFoto->save();

        $request->session()->put('fotoCom', $imageName);
        return back()
            ->with('success','You have successfully upload image.')
            ->with('photo',$imageName);
    }
}
