<?php

namespace App\Http\Controllers;

use App\Mail\VerifyMail;
use App\Mail\VerifyMailCompany;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Rekening;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Company;

use App\Models\VerifyUser;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('index');
    }

    public function indexPelamar()
    {
        //
        return view('index_applicant');
    }

    public function indexPerusahaan()
    {
        return view('index_company');
    }

    public function indexRegPelamar()
    {
        //
        $provinces = Province::pluck('name','id');
        return view('registrasi',['provinces'=>$provinces]);
    }

    public function indexRegPerusahaan()
    {
        //
        $provinces = Province::pluck('name','id');
        return view('registrasi_employer',['provinces'=>$provinces]);
    }

    public function validateLoginApplicant(Request $request)
    {

        $user = User::where('email', $request->isiEmail)->where('password', $request->isiPassword)->firstOrFail();

        if ($user) {
            if ($user->email_verified_at == null) {
                $request->session()->put('exist', false);
                $request->session()->flash('alert-message', 'Tolong verifikasikan email terlebih dahulu');
                return redirect(route('user.loginApplicant'));
            }
            $count = DB::table('job_applies')->select('id')->count();


            if($user->role_id==1) {
                $role = \App\Models\Role::where('id', $user->role_id)->firstOrFail();
                $request->session()->put('exist', true);
                $request->session()->put('nama', $user->name);
                $request->session()->put('role', $role->role);
                $request->session()->put('jumlah_lamaran', $count);
            }
            else if($user->role_id==2){
                $role = \App\Models\Role::where('id', $user->role_id)->firstOrFail();
                $request->session()->put('exist', true);
                $request->session()->put('nama', $user->name);
                $request->session()->put('email', $user->email);
                $request->session()->put('role', $role->role);
                $request->session()->put('user_id', $user->id);
                $request->session()->put('alamat', $user->alamat);
                $request->session()->put('kota', Str::title($user->kota));
                $request->session()->put('kecamatan', Str::title($user->kecamatan));
                $request->session()->put('kelurahan', Str::title($user->kelurahan));
                $request->session()->put('provinsi', Str::title($user->provinsi));
                $request->session()->put('rt', $user->RT);
                $request->session()->put('rw', $user->RW);
                $request->session()->put('kode_pos', $user->kode_pos);
                $request->session()->put('telp', $user->no_telp);
                $request->session()->put('foto', $user->foto);
                $request->session()->put('ktp', $user->ktp);
                $request->session()->put('cv', $user->cv);
                $request->session()->put('id_user', $user->id);
                $count_accept = DB::table('job_applies')->select('id')->where('user_id', '=', $user->id)->where('status', '=', 'Diterima')->count();
                $count_wait = DB::table('job_applies')->select('id')->where('user_id', '=', $user->id)->where('status', '=', 'Menunggu jawaban')->count();
                $count_reject = DB::table('job_applies')->select('id')->where('user_id', '=', $user->id)->where('status', '=', 'Ditolak')->count();
                $request->session()->put('accept_lamaran', $count_accept);
                $request->session()->put('wait_lamaran', $count_wait);
                $request->session()->put('reject_lamaran', $count_reject);
            }
            else{
                $request->session()->flash('alert-danger', 'Username atau password salah!');
            }
            $request->session()->flash('alert-success', 'Login Berhasil');
            return redirect(route('home'));
        }
    }

    public function validateLoginCompany(Request $request)
    {
        $user = User::where('email', $request->isiEmail)->where('password', $request->isiPassword)->firstOrFail();

        if ($user) {
            if ($user->email_verified_at == null) {
                $request->session()->put('exist', false);
                $request->session()->flash('alert-success', 'Tolong verifikasikan email terlebih dahulu');
                return redirect(route('user.loginCompany'));
            }
            if($user->role_id==3){
                $company = Company::where('user_id', $user->id)->firstOrFail();
                $role = \App\Models\Role::where('id', $user->role_id)->firstOrFail();

                $request->session()->put('exist', true);
                $request->session()->put('nama', $user->name);
                $request->session()->put('email', $user->email);
                $request->session()->put('role', $role->role);
                $request->session()->put('user_id', $user->id);
                $request->session()->put('alamat', $user->alamat);
                $request->session()->put('kota', Str::title($user->kota));
                $request->session()->put('kecamatan', Str::title($user->kecamatan));
                $request->session()->put('kelurahan', Str::title($user->kelurahan));
                $request->session()->put('provinsi', Str::title($user->provinsi));
//            $request->session()->put('comverview', $company->overview);
                $request->session()->put('fotoCom', $company->foto);
                $request->session()->put('logoCom', $company->logo);
                $request->session()->put('siup', $company->SIUP);
                $request->session()->put('kode_pos', $user->kode_pos);
                $request->session()->put('telp', $user->no_telp);
                $request->session()->put('id_user', $user->id);

                $count_wait = DB::table('job_applies')->select('id')->where('status', '=', 'Menunggu jawaban')->count();
                $count_accept = DB::table('job_applies')->select('id')->where('user_id', '=', $user->id)->where('status', '=', 'Diterima')->count();
                $count_reject = DB::table('job_applies')->select('id')->where('user_id', '=', $user->id)->where('status', '=', 'Batal Wawancara')->count();
                $request->session()->put('lamaran_masuk', $count_wait);
                $request->session()->put('wawancara', $count_accept);
                $request->session()->put('batal_wawancara', $count_reject);
                $request->session()->put('cid', $company->id);
                $request->session()->put('cname', $company->name);
                $request->session()->put('jumlah_iklan', 'Bisa');

                $rekening = Rekening::where('user_id', $user->id)->first();
                if($rekening){
                    $transaction = Transaction::where('rekening_id', $rekening->id)->where('status', 'Aktif')->first();
                    if($transaction){
                        $request->session()->put('status_transaksi', $transaction->status);
                        if($transaction->jlh_paket_iklan==$transaction->jlh_iklan){
                            $request->session()->put('jumlah_iklan', 'Tidak Bisa');
                        }
                    }
                    else if(!$transaction){
                        $request->session()->put('status_transaksi', null);
                    }
                }else if(!$rekening){
                    $request->session()->put('status_transaksi', null);
                }

            }
            else{
                $request->session()->flash('alert-danger', 'Username atau password salah!');
            }
            $request->session()->flash('alert-success', 'Login Berhasil');
            return redirect(route('home'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginApplicant(Request $request)
    {
        //
        $user = User::where('email', $request->isiEmail)->firstOrFail();
        $count = DB::table('job_applies')->select('id')->count();
        if($user->role_id==1) {
            $role = \App\Models\Role::where('id', $user->role_id)->firstOrFail();
            $request->session()->put('exist', true);
            $request->session()->put('nama', $user->name);
            $request->session()->put('role', $role->role);
            $request->session()->put('jumlah_lamaran', $count);
        }
        else if($user->role_id==2){
            $role = \App\Models\Role::where('id', $user->role_id)->firstOrFail();
//            $province = Province::where('id', $user->provinsi)->firstOrFail();
//            $regency = Regency::where('id', $user->kota)->firstOrFail();
//            $district = District::where('id', $user->kecamatan)->firstOrFail();
//            $village = Village::where('id', $user->kelurahan)->firstOrFail();
            $request->session()->put('exist', true);
            $request->session()->put('nama', $user->name);
            $request->session()->put('email', $user->email);
            $request->session()->put('role', $role->role);
            $request->session()->put('user_id', $user->id);
            $request->session()->put('alamat', $user->alamat);
            $request->session()->put('kota', Str::title($user->kota));
            $request->session()->put('kecamatan', Str::title($user->kecamatan));
            $request->session()->put('kelurahan', Str::title($user->kelurahan));
            $request->session()->put('provinsi', Str::title($user->provinsi));
            $request->session()->put('rt', $user->RT);
            $request->session()->put('rw', $user->RW);
            $request->session()->put('kode_pos', $user->kode_pos);
            $request->session()->put('telp', $user->no_telp);
            $request->session()->put('foto', $user->foto);
            $request->session()->put('ktp', $user->ktp);
            $request->session()->put('cv', $user->cv);
            $request->session()->put('sular', $user->surat_lamaran);
            $request->session()->put('id_user', $user->id);
            $count_accept = DB::table('job_applies')->select('id')->where('user_id', '=', $user->id)->where('status', '=', 'Diterima')->count();
            $count_wait = DB::table('job_applies')->select('id')->where('user_id', '=', $user->id)->where('status', '=', 'Menunggu jawaban')->count();
            $count_reject = DB::table('job_applies')->select('id')->where('user_id', '=', $user->id)->where('status', '=', 'Ditolak')->count();
            $request->session()->put('accept_lamaran', $count_accept);
            $request->session()->put('wait_lamaran', $count_wait);
            $request->session()->put('reject_lamaran', $count_reject);
        }
        else{
            $request->session()->flash('alert-danger', 'Username atau password salah!');
        }

        return redirect('/index_main');
    }

    public function registrasiUser(Request $request)
    {
        //
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ktp' => 'required|mimetypes:application/pdf,application/vnd.ms-excel|max:2048',
            'cv' => 'required|mimetypes:application/pdf,application/vnd.ms-excel|max:2048'
        ],
        [
            'photo.required' => 'Harap isi field ini!',
            'photo.image' => 'Ekstensi file harus jpeg,png,jpg,gif atau svg!',
            'photo.max' => 'Ukuran maksimal foto profil adalah 2MB',

            'ktp.required' => 'Harap isi field ini!',
            'ktp.mimetypes' => 'Ekstensi file harus PDF!',
            'ktp.max' => 'Ukuran maksimal file KTP adalah 2MB',

            'cv.required' => 'Harap isi field ini!',
            'cv.mimetypes' => 'Ekstensi file harus PDF!',
            'cv.max' => 'Ukuran maksimal file CV adalah 2MB'
        ]);

        $imageName = time().'.'.$request->photo->extension();
        $request->photo->move(public_path('photos'), $imageName);

        $ktpName = time().'.'.$request->ktp->extension();
        $request->ktp->move(public_path('ktp'), $ktpName);

        $cvName = time().'.'.$request->cv->extension();
        $request->cv->move(public_path('cv'), $cvName);

        $count = DB::table('job_applies')->select('id')->count();
        $province = Province::where('id', $request->provinsi)->firstOrFail();
        $regency = Regency::where('id', $request->regKota)->firstOrFail();
        $district = District::where('id', $request->kec)->firstOrFail();
        $village = Village::where('id', $request->kel)->firstOrFail();


        if($request->regPassword==$request->regRePassword){
            $users =new User;
            $users->name = $request->regNama;
            $users->email = $request->regEmail;
            $users->alamat = $request->regAlamat;
            $users->kota = $regency->name;
            $users->kecamatan = $district->name;
            $users->kelurahan = $village->name;
            $users->provinsi = $province->name;
            $users->RT = $request->rt;
            $users->RW = $request->rw;
            $users->kode_pos = $request->kode_pos;
            $users->no_telp = $request->regTelp;
            $users->username = $request->regUsername;
            $users->password = $request->regPassword;
            $users->role_id = 2;
            $users->foto = $imageName;
            $users->ktp = $ktpName;
            $users->cv = $cvName;
            $users->save();

            $verifyUser=new VerifyUser;
            $verifyUser->token = Str::random(60);
            $verifyUser->user_id = $users->id;
            $verifyUser->save();

            $role = \App\Models\Role::where('id', $users->role_id)->firstOrFail();

            $request->session()->put('nama', $users->name);
            $request->session()->put('role', $role->role);
            $request->session()->put('email', $users->email);
            $request->session()->put('kota', Str::title($users->kota));
            $request->session()->put('kecamatan', Str::title($users->kecamatan));
            $request->session()->put('kelurahan', Str::title($users->kelurahan));
            $request->session()->put('provinsi', Str::title($users->provinsi));
            $request->session()->put('rt', $users->RT);
            $request->session()->put('rw', $users->RW);
            $request->session()->put('kode_pos', $users->kode_pos);
            $request->session()->put('alamat', $users->alamat);
            $request->session()->put('telp', $users->no_telp);
            $request->session()->put('user_id', $users->id);
            $request->session()->put('foto', $users->foto);
            $request->session()->put('ktp', $users->ktp);
            $request->session()->put('cv', $users->cv);
            $count_accept = DB::table('job_applies')->select('id')->where('user_id', '=', $users->id)->where('status', '=', 'Diterima')->count();
            $count_wait = DB::table('job_applies')->select('id')->where('user_id', '=', $users->id)->where('status', '=', 'Menunggu jawaban')->count();
            $count_reject = DB::table('job_applies')->select('id')->where('user_id', '=', $users->id)->where('status', '=', 'Ditolak')->count();
            $request->session()->put('accept_lamaran', $count_accept);
            $request->session()->put('wait_lamaran', $count_wait);
            $request->session()->put('reject_lamaran', $count_reject);

            Mail::to($users->email)->send(new VerifyMail($users,$verifyUser));

            $request->session()->flash('alert-success', 'Tolong tekan link terkirim pada email anda');
            return redirect()->route('user.loginApplicant')->with('success', 'Please click on the link sent to your email');
        }
    }

    public function loginCompany(Request $request){
        $user = User::where('email', $request->isiEmail)->firstOrFail();
        if($user->role_id==3){
            $company = Company::where('user_id', $user->id)->firstOrFail();
            $role = \App\Models\Role::where('id', $user->role_id)->firstOrFail();

            $request->session()->put('exist', true);
            $request->session()->put('nama', $user->name);
            $request->session()->put('email', $user->email);
            $request->session()->put('role', $role->role);
            $request->session()->put('user_id', $user->id);
            $request->session()->put('alamat', $user->alamat);
            $request->session()->put('kota', Str::title($user->kota));
            $request->session()->put('kecamatan', Str::title($user->kecamatan));
            $request->session()->put('kelurahan', Str::title($user->kelurahan));
            $request->session()->put('provinsi', Str::title($user->provinsi));
//            $request->session()->put('comverview', $company->overview);
            $request->session()->put('kode_pos', $user->kode_pos);
            $request->session()->put('telp', $user->no_telp);
            $request->session()->put('id_user', $user->id);
            $count_accept = DB::table('job_applies')->select('id')->where('user_id', '=', $user->id)->where('status', '=', 'Diterima')->count();
            $count_wait = DB::table('job_applies')->select('id')->where('user_id', '=', $user->id)->where('status', '=', 'Menunggu jawaban')->count();
            $count_reject = DB::table('job_applies')->select('id')->where('user_id', '=', $user->id)->where('status', '=', 'Ditolak')->count();
            $company_id = DB::table('company')->select('id')->where('user_id', '=', $user->id)->get();
            $request->session()->put('accept_lamaran', $count_accept);
            $request->session()->put('wait_lamaran', $count_wait);
            $request->session()->put('reject_lamaran', $count_reject);
            $request->session()->put('cid', $company->id);
        }
        else{
            $request->session()->flash('alert-danger', 'Username atau password salah!');
        }
        return redirect('/index_main');
    }

    public function registrasiCompany(Request $request)
    {
        $request->validate([
            'photoCom' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'siup' => 'required|mimetypes:application/pdf,application/vnd.ms-excel|max:2048'
        ],
            [
                'photoCom.required' => 'Harap isi field ini!',
                'photoCom.image' => 'Ekstensi file harus jpeg,png,jpg,gif atau svg!',
                'photoCom.max' => 'Ukuran maksimal foto perusahaan adalah 2MB',

                'logo.required' => 'Harap isi field ini!',
                'logo.mimetypes' => 'Ekstensi file harus PDF!',
                'logo.max' => 'Ukuran maksimal file logo adalah 2MB',

                'siup.required' => 'Harap isi field ini!',
                'siup.mimetypes' => 'Ekstensi file harus PDF!',
                'siup.max' => 'Ukuran maksimal file SIUP adalah 2MB'
            ]);
        $imageName = time().'.'.$request->photoCom->extension();
        $request->photoCom->move(public_path('photos'), $imageName);

        $logoName = time().'.'.$request->logo->extension();
        $request->logo->move(public_path('logo'), $logoName);

        $siupName = time().'.'.$request->siup->extension();
        $request->siup->move(public_path('siup'), $siupName);

        $province = Province::where('id', $request->comProvinsi)->firstOrFail();
        $regency = Regency::where('id', $request->comKota)->firstOrFail();
        $district = District::where('id', $request->comKec)->firstOrFail();
        $village = Village::where('id', $request->comKel)->firstOrFail();

        $companySearch=Company::where('name',$request->comNamaPer)->first();

        if($companySearch == null){
            if($request->regPassword==$request->regRePassword){
                $users =new User;
                $users->name = $request->comNama;
                $users->email = $request->comEmail;
                $users->no_telp = $request->comTelp;
                $users->alamat = $request->comAlamat;
                $users->kota = $regency->name;
                $users->kecamatan = $district->name;
                $users->kelurahan = $village->name;
                $users->provinsi = $province->name;
                $users->kode_pos = $request->com_kode_pos;
                $users->username = $request->comUsername;
                $users->password = $request->comPassword;
                $users->role_id = 3;
                $users->save();

                $userCom = DB::table('user')->select('id')->where('name','=',$request->comNama)->first();
                $companies=new Company;
                $companies->name=$request->comNamaPer;
                $companies->foto=$imageName;
                $companies->logo=$logoName;
                $companies->SIUP=$siupName;
                $companies->user_id=$userCom->id;
                $companies->save();

                $verifyUser=new VerifyUser;
                $verifyUser->token = Str::random(60);
                $verifyUser->user_id = $users->id;
                $verifyUser->save();

                $role = \App\Models\Role::where('id', $users->role_id)->firstOrFail();

                $request->session()->put('nama', $users->name);
                $request->session()->put('role', $role->role);
                $request->session()->put('telp', $users->no_telp);
                $request->session()->put('user_id', $users->id);
                $request->session()->put('cid', $userCom->id);
                $request->session()->put('alamat', $users->alamat);
                $request->session()->put('kota', Str::title($users->kota));
                $request->session()->put('kecamatan', Str::title($users->kecamatan));
                $request->session()->put('kelurahan', Str::title($users->kelurahan));
                $request->session()->put('provinsi', Str::title($users->provinsi));
                $request->session()->put('fotoCom', $companies->foto);
                $request->session()->put('logoCom', $companies->logo);
                $request->session()->put('siup', $companies->SIUP);
                $request->session()->put('kode_pos', $users->kode_pos);
                $request->session()->put('status_transaksi', null);
                Mail::to($users->email)->send(new VerifyMailCompany($users,$verifyUser,$companies));
                $request->session()->flash('alert-success', 'Tolong tekan link terkirim pada email anda');
                return redirect()->route('user.loginCompany');
            }
        }

        elseif ($companySearch){
//            $request->session()->flash('alert-success', 'Nama perusahaan sudah terdaftar!');
            alert()->error('Peringatan','Nama perusahaan sudah diambil');
            return redirect()->back();
        }
    }

    public function verifyEmailApplicant(Request $request,$token)
    {
        $verifiedUser = VerifyUser::where('token', $token)->first();
        $date = date('Y-m-d');
        if (isset($verifiedUser)) {
            $user = User::where('id', $verifiedUser->user_id)->firstOrFail();
            if (!$user->email_verified_at) {
                $user->email_verified_at = $date;
                $user->save();
                $request->session()->flash('alert-success', 'Email anda berhasil di verifikasi');
                return redirect(route('user.loginApplicant'));
            } else {
                $request->session()->flash('alert-info', 'Email anda berhasil di verifikasi');
                return redirect()->back();
            }
        } else {
            return redirect(route('user.loginApplicant'))->with('error', 'Something went wrong!!');
        }
    }

    public function verifyEmailCompany(Request $request,$token)
    {
        $verifiedUser = VerifyUser::where('token', $token)->first();
        $date = date('Y-m-d');
        if (isset($verifiedUser)) {
            $user = User::where('id', $verifiedUser->user_id)->firstOrFail();
            if (!$user->email_verified_at) {
                $user->email_verified_at = $date;
                $user->save();
                $request->session()->flash('alert-success', 'Email anda berhasil di verifikasi');
                return redirect(route('user.loginCompany'));
            } else {
                $request->session()->flash('alert-info', 'Email anda berhasil di verifikasi');
                return redirect()->back();
            }
        } else {
            return redirect(route('user.loginApplicant'))->with('error', 'Something went wrong!!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeKTP(Request $request)
    {
        if($cv=$request->file('cv')){
            $namef=$cv->getClientOriginalName();
            if($cv->move('cv',$namef)){
                DB::update('update user set foto = "'.$namef.'" where name = ?', [$request->session()->get('nama')]);
                $request->session()->put('foto', $namef);
                $request->session()->flash('alert-success', 'Data foto berhasil ditambah!');
                return redirect('/profile_applicant');
            }
        }
//        return redirect('/profile_applicant');

    }

    public function storePhoto(Request $request)
    {
        if($cv=$request->file('cv')){
            $namef=$cv->getClientOriginalName();
            if($cv->move('cv',$namef)){
                DB::update('update user set cv = "'.$namef.'" where name = ?', [$request->session()->get('nama')]);
                $request->session()->flash('alert-success', 'Data CV berhasil ditambah!');
                return redirect('/profile_applicant');
            }
        }
//        return redirect('/profile_applicant');

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

    public function logout(Request $request)
    {
        $request->session()->put('exist', false);
        return redirect('/');
    }
}
