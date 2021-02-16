<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\ActivityStok;
use App\Average_Produk;
use DB;
use View;
use Auth;
use DateTime;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $products    = DB::table('produk AS P')
                            ->get();

        return view::make('product.show', compact('products'));   
    }

    public function store(Request $request)
    {

         Produk::create([
            'nama_produk' => $request->nama_produk,
            'harga_jual' => $request->harga_jual,
            'harga_beli' => $request->harga_beli,
            'stok' => $request->stok,
            ]);

        return redirect()->route('products.index')->with('Data Product Berhasil Di Simpan');
    }

    public function Average_Produk()
    {

         $data = ActivityStok::leftJoin('produk  AS p', 'p.id', '=', 'aktivitas_stok.kode_produk')
                             ->leftJoin('supplier AS supp', 'supp.kode_supplier', '=', 'aktivitas_stok.kode_user')
                           ->select('kode_produk','nama_produk','nama_supplier',DB::raw('sum(qty_stok) as qty_stok'),DB::raw('sum(p.id) as jumlah_produk'))
                           ->where('status', 1)
                           ->groupBy('kode_produk','nama_produk','nama_supplier')
                            ->get();

        if ($data) {

            $status = 200;
            $msg = 'tampil data sukses!';
            return response()->json(compact('status', 'msg', 'data'), 200);
        }else{
             $status = 400;
            $msg = 'tampil data gagal!';
            return response()->json(compact('status', 'msg'), 400);
        }
       
    }

    public function Activity_Produk()
    {

         $data = Produk::get();

         $tgl_awal = '2020-02-01 00:00:00';
         $tgl_akhir = '2020-02-30 00:00:00';

         foreach ($data as $key => $data) {
                $produk_tambah = ActivityStok::where('kode_produk', $data->id)
                                          ->select(DB::raw('sum(qty_stok) as qty_masuk', 'sisa_stok'))
                                          ->where('status', 1)
                                          ->whereBetween('tanggal_aktivitas', array($tgl_awal, $tgl_akhir))
                                          ->first();

                 $produk_kurang = ActivityStok::where('kode_produk', $data->id)
                                          ->select(DB::raw('sum(qty_stok) as qty_keluar', 'sisa_stok'))
                                          ->where('status', 2)
                                           ->whereBetween('tanggal_aktivitas', array($tgl_awal, $tgl_akhir))
                                          ->first();

                $data["stok_masuk"]= $produk_tambah;
                $data["stok_keluar"]= $produk_kurang;
         }

        if ($data) {

            $status = 200;
            $msg = 'tampil data sukses!';
            return response()->json(compact('status', 'msg', 'data'), 200);
        }else{
             $status = 400;
            $msg = 'tampil data gagal!';
            return response()->json(compact('status', 'msg'), 400);
        }
       
    }
}
