<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\Distributor;
use App\ActivityStok;

use DB;
use View;
use Auth;
use DateTime;
use Carbon\Carbon;

class DistibutorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products    = DB::table('produk')
                            ->get();

        $distributor    = DB::table('distributor')
                            ->get();

       return view::make('distributor.create', compact('products','distributor'));   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $produk = Produk::where('id',$request->produk)->first();
        // dd($request->stok);

        if ($produk) {
           $old_stok = $produk->stok;
           $new_stok = $old_stok - $request->stok;
         
           $produk->stok = $new_stok;
           $produk->save();

            ActivityStok::create([
            'deskripsi' => 'Pengurangan Stok',
            'kode_user' => $request->distibutor,
            'type_user' => 'distibutor',
            'kode_produk' => $request->produk,
            'status' => 2, //s pengurangan stok
            'qty_stok' => $request->stok,
            'sisa_stok' => $new_stok,
            'tanggal_aktivitas' =>  date('Y-m-d H:i:s'),
            ]);


        }
         
        return redirect()->route('supplier.index')->with('Penambahan Stok Berhasil Di Simpan');
    }

    
    public function laporder(Request $request)
    {

          $data = ActivityStok::leftjoin('supplier as s', 's.kode_supplier', 'aktivitas_stok.kode_user')
                                ->leftjoin('distributor as d', 'd.kode_distributor', 'aktivitas_stok.kode_user')
                                ->leftjoin('produk as p', 'p.id', 'aktivitas_stok.kode_produk')
                                ->get();

         return view::make('laporan.laporanorder', compact('data'));
    }
}
