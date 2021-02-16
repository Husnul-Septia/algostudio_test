<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\User;
use Auth;
use View;

class UserController extends Controller
{
   
    public function index()
    {   
        $data = User::all();
        // return view('customer.show');
        return view::make('customer.show', compact('data'));   
    }

    public function cari(Request $request)
    {

        // menangkap data pencarian
        $cari = $request->users;

        // mengambil data dari table pegawai sesuai pencarian data
        $data = User::where('account_type','=', $cari)
                    ->get();
      
            // mengirim data pegawai ke view index
        return view::make('customer.show', compact('data'));   
 
    }

    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'nama' => 'required',
        //     'alamat' => 'required',
        //     ]);
        //  Customer::create([
        //     'id' =>  Auth::User()->id,
        //     'referral_id' => $request->referral,
        //     'address' => $request->alamat,
        //     'kelurahan' => $request->kel,
        //     'kecamatan'=> $request->kec,
        //     'kota' => $request->kota,
        //     'provinsi' => $request->prov,
        //     'no_rekening' => $request->norek,
        //     ]);

        // return redirect()->route('users.index')->with('Data Berhasil Di Simpan');
    }

    
}
