<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Orderdetil;
use DB;
use View;
use Auth;
use DateTime;

class LaporanController extends Controller
{
    public function laptopcustomer(Request $request)
    {	
    	$data = Order::leftJoin('order_detail AS OD', 'orders.id', '=', 'OD.order_id')
                            ->select('name',DB::raw('sum(OD.qty) as qty'))
                            ->groupby('name')
                            ->Orderby('qty', 'DESC')
                            ->limit(10)
                            ->get();
                           // dd($data);
        return view::make('laporan.topcustomer', compact('data'));
    }

    public function laptopproduct(Request $request)
    {	
    	$data = Orderdetil::leftJoin('product AS P', 'P.id', '=', 'order_detail.product_id')
                            ->select('product_name',DB::raw('sum(order_detail.qty) as qty'))
                            ->groupby('product_name')
                            ->Orderby('qty', 'DESC')
                            ->limit(10)
                            ->get();
                           // dd($data);
        return view::make('laporan.topproduk', compact('data'));
    }

    public function laporder(Request $request)
    {   

          $data = Order::leftJoin('order_detail  AS O', 'O.order_id', '=', 'orders.id')
                             ->leftJoin('product AS P', 'P.id', '=', 'O.product_id')
                           ->select('P.product_name',DB::raw('count(invoice_id) as totalorder'),DB::raw('sum(payment_discount) as totaldiscount'),DB::raw('sum(delivery_fee) as totalongkir'),DB::raw('sum(qty) as totalqty'),DB::raw('count(P.product_name) as totalitem'),DB::raw('sum(payment_final) as totalbayar'))
                            ->groupby('product_name')
                            ->Orderby('product_name', 'ASC')
                            ->get();
                            // dd($data);

        return view::make('laporan.laporanorder', compact('data'));
    }

     public function carilaporder(Request $request)
    {   
         $awal = $request->awal;
        $akhir = $request->akhir;

          $data = Order::leftJoin('order_detail  AS O', 'O.order_id', '=', 'orders.id')
                             ->leftJoin('product AS P', 'P.id', '=', 'O.product_id')
                           ->select('P.product_name',DB::raw('count(invoice_id) as totalorder'),DB::raw('sum(payment_discount) as totaldiscount'),DB::raw('sum(delivery_fee) as totalongkir'),DB::raw('sum(qty) as totalqty'),DB::raw('count(P.product_name) as totalitem'),DB::raw('sum(payment_final) as totalbayar'))
                           ->whereBetween('payment_date', [$awal, $akhir])
                            ->groupby('product_name')
                            ->Orderby('product_name', 'ASC')
                            ->get();
                            // dd($data);

        return view::make('laporan.laporanorder', compact('data'));
    }

     public function lapcustomer(Request $request)
    {   
        $data = Order::leftJoin('users AS U', 'U.id', '=', 'orders.customer_id')
                            ->select('customer_id','first_name',DB::raw('count(orders.customer_id) as qty'))
                             // ->whereBetween('ayment_date', [1, 100])
                            ->groupby('customer_id','first_name')
                            ->get();
                           // dd($data);
        return view::make('laporan.laporancustomer', compact('data'));
    }

    public function carilapcustomer(Request $request)
    {   

        // menangkap data pencarian
        $awal = $request->awal;
        $akhir = $request->akhir;

        // mengambil data dari table pegawai sesuai pencarian data
        $data = Order::leftJoin('users AS U', 'U.id', '=', 'orders.customer_id')
                            ->select('customer_id','first_name',DB::raw('count(orders.customer_id) as qty'))
                            ->whereBetween('payment_date', [$awal, $akhir])
                            ->groupby('customer_id','first_name')
                            ->get();
      
        return view::make('laporan.laporancustomer', compact('data'));
    }
   
    public function laporanlabaagent(Request $request)
    {   
        $data = Order::leftJoin('order_detail AS OD', 'OD.order_id', '=', 'orders.id')
                            ->leftJoin('product AS P', 'P.id', '=', 'od.product_id')
                            ->select('agent_name','product_id','P.price_sell','P.price_agent', DB::raw('(P.price_sell - P.price_agent) as labaitem'), DB::raw('((P.price_sell - P.price_agent) * sum(OD.qty))as labatotal'),DB::raw('sum(OD.qty) as qty'))
                            ->groupby('agent_name','product_id','P.price_sell','p.price_agent')
                            ->Orderby('qty', 'DESC')
                            ->get();
                          
        return view::make('laporan.laporanlabaagent', compact('data'));
    }

     public function carilaporanlabaagent(Request $request)
    {   

        $awal = $request->awal;
        $akhir = $request->akhir;

       $data = Order::leftJoin('order_detail AS OD', 'OD.order_id', '=', 'orders.id')
                            ->leftJoin('product AS P', 'P.id', '=', 'od.product_id')
                            ->select('agent_name','product_id','P.price_sell','P.price_agent', DB::raw('(P.price_sell - P.price_agent) as labaitem'), DB::raw('((P.price_sell - P.price_agent) * sum(OD.qty))as labatotal'),DB::raw('sum(OD.qty) as qty'))
                            ->whereBetween('payment_date', [$awal, $akhir])
                            ->groupby('agent_name','product_id','P.price_sell','p.price_agent')
                            ->Orderby('qty', 'DESC')
                            ->get();
                            // dd($data);
        return view::make('laporan.laporanlabaagent', compact('data'));
    }

    public function laporderkeagen(Request $request)
    {   
        $data = Order::select('agent_name','name',DB::raw('count(invoice_id) as jlh'))
                            ->groupby('agent_name','name')
                            ->Orderby('agent_name', 'ASC')
                            ->get();
  
        return view::make('laporan.laporanorderkeagen', compact('data'));
    }
   
    public function laporanitemproduk(Request $request)
    {   
        $data = Orderdetil::leftJoin('product AS P', 'P.id', '=', 'order_detail.product_id')
                           ->select('P.product_name','price',DB::raw('(price * sum(order_detail.qty)) as total'), DB::raw('sum(order_detail.qty) as qty'))
                            ->groupby('product_id','product_name','price')
                            ->Orderby('product_id', 'ASC')
                            ->get();
                          
        return view::make('laporan.laporanitemproduk', compact('data'));
    }

     public function carilaporanitemproduk(Request $request)
    {   
        $awal = $request->awal;
        $akhir = $request->akhir;

        $data = Orderdetil::leftJoin('product AS P', 'P.id', '=', 'order_detail.product_id')
                            ->leftJoin('orders AS O', 'O.id', '=', 'order_detail.order_id')
                            ->select('P.product_name','price',DB::raw('price * sum(order_detail.qty) as total'), DB::raw('sum(order_detail.qty) as qty'))
                            ->whereBetween('O.payment_date', [$awal, $akhir])
                            ->groupby('product_id','product_name','price')
                            ->Orderby('product_id', 'ASC')
                            ->get();
                          
        return view::make('laporan.laporanitemproduk', compact('data'));
    }

     public function laporancategoryproduk(Request $request)
    {   
        $data = Orderdetil::leftJoin('product AS P', 'P.id', '=', 'order_detail.product_id')
                            ->leftJoin('product_category AS PC', 'PC.id', '=', 'P.category')
                           ->select('PC.name','price',DB::raw('(price * sum(order_detail.qty)) as total'), DB::raw('sum(order_detail.qty) as qty'))
                            ->groupby('name','price')
                            ->Orderby('name', 'ASC')
                            ->get();
                          
        return view::make('laporan.laporancategoryproduk', compact('data'));
    }

    public function carilaporancategoryproduk(Request $request)
    {   
        $awal = $request->awal;
        $akhir = $request->akhir;

        $data = Orderdetil::leftJoin('product AS P', 'P.id', '=', 'order_detail.product_id')
                            ->leftJoin('product_category AS PC', 'PC.id', '=', 'P.category')
                             ->leftJoin('orders AS O', 'O.id', '=', 'order_detail.order_id')
                           ->select('PC.name','price',DB::raw('(price * sum(order_detail.qty)) as total'), DB::raw('sum(order_detail.qty) as qty'))
                           ->whereBetween('O.payment_date', [$awal, $akhir])
                            ->groupby('name','price')
                            ->Orderby('name', 'ASC')
                            ->get();
                          
        return view::make('laporan.laporancategoryproduk', compact('data'));
    }


}
