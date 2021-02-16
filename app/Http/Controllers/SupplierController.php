<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\Supplier;
use App\ActivityStok;

use DB;
use View;
use Auth;
use DateTime;
use Carbon\Carbon;

class SupplierController extends Controller
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

        $supplier    = DB::table('supplier')
                            ->get();

       return view::make('supplier.create', compact('products','supplier'));   

    }

    public function create(Request $request)
    {
        $produk = Produk::where('id',$request->produk)->first();
       
        if ($produk) {
           $old_stok = $produk->stok;
           $new_stok = $old_stok + $request->stok;
         
           $produk->stok = $new_stok;
           $produk->save();

            ActivityStok::create([
            'deskripsi' => 'Penambahan Stok',
            'kode_user' => $request->supplier,
            'type_user' => 'supplier',
            'kode_produk' => $request->produk,
            'status' => 1, //1 penambahan stok
            'qty_stok' => $request->stok,
            'sisa_stok' => $new_stok,
            'tanggal_aktivitas' =>  date('Y-m-d H:i:s'),
            ]);


        }
         
        return redirect()->route('supplier.index')->with('Penambahan Stok Berhasil Di Simpan');
    }

  
}
