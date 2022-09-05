<?php

namespace App\Http\Controllers;

use App\Mail\TransactionMail;
use App\Mail\VerifyMailCompany;
use App\Mail\VerifyTransaction;
use App\Models\Company;
use App\Models\Harga;
use App\Models\Job;
use App\Models\Rekening;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Input\Input;
use Carbon\Carbon;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $harga1=Harga::where('id', 1)->firstOrFail();
        $harga2=Harga::where('id', 2)->firstOrFail();
        $harga3=Harga::where('id', 3)->firstOrFail();
        $harga4=Harga::where('id', 4)->firstOrFail();

        $transaction = DB::table('transaction')
            ->join('rekening', 'rekening.id', '=', 'transaction.rekening_id')
            ->join('company', 'company.id', '=', 'rekening.company_id')
            ->select('transaction.id','transaction.uang_bayar','transaction.harga_paket','transaction.tgl_transaksi','transaction.status')
            ->where('company.id','=',$request->session()->get('cid'))
            ->where('transaction.status','=','Aktif')
            ->first();

        $request->session()->put('harga1', $harga1->harga);
        $request->session()->put('harga2', $harga2->harga);
        $request->session()->put('harga3', $harga3->harga);
        $request->session()->put('harga4', $harga4->harga);
        if($transaction){
            $request->session()->put('jangka', date('d F Y', strtotime('+1 month', strtotime($transaction->tgl_transaksi))));
        }

        return view('transaction_company');
    }

    public function index_paket(Request $request)
    {
        //
        $harga1=Harga::where('id', 1)->firstOrFail();
        $harga2=Harga::where('id', 2)->firstOrFail();
        $harga3=Harga::where('id', 3)->firstOrFail();
        $harga4=Harga::where('id', 4)->firstOrFail();



        $request->session()->put('harga1', $harga1->harga);
        $request->session()->put('harga2', $harga2->harga);
        $request->session()->put('harga3', $harga3->harga);
        $request->session()->put('harga4', $harga4->harga);

        return view('data_paket');
    }

    public function index_admin(Request $request)
    {
        $transaction = DB::table('transaction')
            ->join('rekening', 'rekening.id', '=', 'transaction.rekening_id')
            ->join('company', 'company.id', '=', 'rekening.company_id')
            ->join('user', 'user.id', '=', 'company.user_id')
            ->select('transaction.id','user.name as nama_user','company.name as nama_com','transaction.uang_bayar','transaction.harga_paket',DB::raw('DATE_FORMAT(transaction.tgl_transaksi, "%d %M %Y") as tatran'),'transaction.status')
            ->get();
        return view('transaction_admin',['transaction'=>$transaction]);
    }

    public function searchTransaction()
    {
        $transactions = Input::get('categories');

        $transaction = Transaction::whereIn('status', $transactions)->get();

        return view('transaction_admin',['transaction'=>$transaction]);
    }

    public function index_company(Request $request)
    {
        if(Session::get('role')=='company'){
            $transaction = DB::table('transaction')
                ->join('rekening', 'rekening.id', '=', 'transaction.rekening_id')
                ->join('company', 'company.id', '=', 'rekening.company_id')
                ->select('transaction.id','transaction.uang_bayar','transaction.harga_paket',DB::raw('DATE_FORMAT(transaction.tgl_transaksi, "%d %M %Y") as tatran'),'transaction.status')
                ->where('company.id','=',$request->session()->get('cid'))
                ->get();
        }
        return view('transaction_company_history',['transaction'=>$transaction]);
    }

    public function getPackage(Request $request,$id)
    {
        if($id==1){
            $request->session()->put('jposting', '3 Posting Lowongan');
            $request->session()->put('notif', 'Notifikasi Lamaran');
            $request->session()->put('harga', $request->session()->get('harga1'));
            $request->session()->put('kali_posting', 3);
        }
        else if($id==2){
            $request->session()->put('jposting', '5 Posting Lowongan');
            $request->session()->put('notif', 'Notifikasi Lamaran');
            $request->session()->put('harga', $request->session()->get('harga2'));
            $request->session()->put('kali_posting', 5);
        }
        else if($id==3){
            $request->session()->put('jposting', '7 Posting Lowongan');
            $request->session()->put('notif', 'Notifikasi Lamaran');
            $request->session()->put('harga', $request->session()->get('harga3'));
            $request->session()->put('kali_posting', 7);
        }
        else if($id==4){
            $request->session()->put('jposting', '10 Posting Lowongan');
            $request->session()->put('notif', 'Notifikasi Lamaran');
            $request->session()->put('harga', $request->session()->get('harga4'));
            $request->session()->put('kali_posting', 10);
        }
        return view('buy_credit');
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
        $company = Company::where('id', $request->session()->get('cid'))->firstOrFail();
        $user = User::where('id', $company->user_id)->firstOrFail();
        $rekening = new Rekening;

        $date = date('Y-m-d');
        if (Rekening::where('no_rekening', '=', $request->nokar)->exists()){
            $rekeningID=Rekening::where('no_rekening', $request->nokar)->firstOrFail();

            $transaction=new Transaction;
            $transaction->uang_bayar = $request->session()->get('harga');
            $transaction->harga_paket = $request->session()->get('harga');
            $transaction->tgl_transaksi = $date;
            $transaction->jlh_paket_iklan = $request->session()->get('kali_posting');
            $transaction->jlh_iklan = 0;
            $transaction->status = 'Menunggu Verifikasi';
            $transaction->rekening_id = $rekeningID->id;
            $transaction->save();

            Mail::to('kaysypy17th@gmail.com')->send(new TransactionMail($user,$company,$transaction));

            $request->session()->put('status_transaksi', $transaction->status);
            $request->session()->put('jumlah_iklan', 'Bisa');
        }else{
            $rekening->no_rekening = $request->nokar;
            $rekening->nama_kartu = $request->nakar;
            $rekening->exp = $request->exp.'-01';
            $rekening->cvc = $request->cvv;
            $rekening->user_id = $company->user_id;
            $rekening->company_id = $request->session()->get('cid');
            $rekening->save();

            $rekeningID=Rekening::where('id', $rekening->id)->firstOrFail();

            $transaction=new Transaction;
            $transaction->uang_bayar = $request->session()->get('harga');
            $transaction->harga_paket = $request->session()->get('harga');
            $transaction->tgl_transaksi = $date;
            $transaction->jlh_paket_iklan = $request->session()->get('kali_posting');
            $transaction->jlh_iklan = 0;
            $transaction->status = 'Menunggu Verifikasi';
            $transaction->rekening_id = $rekeningID->id;
            $transaction->save();

            Mail::to('kaysypy17th@gmail.com')->send(new TransactionMail($user,$company,$transaction));

            $request->session()->put('status_transaksi', $transaction->status);
            $request->session()->put('jumlah_iklan', 'Bisa');
        }


        return redirect('/company_transaction');
    }

    public function verifySub(Request $request,$id)
    {
        $transaction = Transaction::where('id', $id)->firstOrFail();
        $rekening = Rekening::where('id', $transaction->rekening_id)->firstOrFail();
        $user=User::where('id',$rekening->user_id)->firstOrFail();
        $company=Company::where('id',$rekening->company_id)->firstOrFail();


        $transaction->status = 'Aktif';
        $transaction->save();

        Mail::to($user->email)->send(new VerifyTransaction($user,$company,$transaction));

        $request->session()->put('status_transaksi', $transaction->status);
        return redirect('/admin_transaction');
    }

    public function cancelSub(Request $request,$id)
    {
        $user=User::where('name',$request->session()->get('nama'))->firstOrFail();
        $company=Company::where('id',$request->session()->get('cid'))->firstOrFail();
        $transaction = Transaction::where('id', $id)->firstOrFail();
        $transaction->status = 'Batal';
        $transaction->save();

        Mail::to('kaysypy17th@gmail.com')->send(new TransactionMail($user,$company,$transaction));

        $request->session()->put('status_transaksi', $transaction->status);
        return redirect('/company_transaction');
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
    public function edit()
    {
        //
        return view('update_harga');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $harga1=Harga::where('id', 1)->firstOrFail();
        $harga1->harga = $request->har1;
        $harga1->save();

        $harga2=Harga::where('id', 2)->firstOrFail();
        $harga2->harga = $request->har2;
        $harga2->save();

        $harga3=Harga::where('id', 3)->firstOrFail();
        $harga3->harga = $request->har3;
        $harga3->save();

        $harga4=Harga::where('id', 4)->firstOrFail();
        $harga4->harga = $request->har4;
        $harga4->save();

        $request->session()->put('harga1', $harga1->harga);
        $request->session()->put('harga2', $harga2->harga);
        $request->session()->put('harga3', $harga3->harga);
        $request->session()->put('harga4', $harga4->harga);

        return view('data_paket');
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
