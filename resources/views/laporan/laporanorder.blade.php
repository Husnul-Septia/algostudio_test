@extends('template.index')

@section('content')

<div>
	<form method="get">
		 <div class="box-header">          
	     </div>
	       
	    <div class="box-body">
		 <div class="row">
			  <div class="col-md-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Laporan Tracking Produk</h3>
                                </div>       
                                 <div class="box-body">
                                    <table class="table table-bordered">
                                        <tr>
                                        <th>Nama Produk</th>
										                    <th>Keterangan</th>
                                        <th>Qty Stok</th>
                                        <th>Type User</th>
                                        <th>Tanggal Transaksi</th>
                                        </tr>
                                      @foreach($data as $data)
                                        <tr>
                                            <td>{{ $data->nama_produk }}</td>
										                        <td>{{ $data->deskripsi }}</td>
                                            <td>{{ $data->qty_stok}}</td>
                                            <td>{{ $data->type_user }}</td>
                                            <td>{{ $data->tanggal_aktivitas }}</td>
                                        </tr>  

                                       @endforeach                                    
                                    </table>
                                    
                                </div><!-- /.box-body -->
 					                </div>                            
                        </div>
		</div>
		</div>
	</form>
</div>

   <script type="text/javascript">
   $(function () {
          $('#searchkey1, #searchkey2').datepicker({
            autoclose: true
          })
          .on('changeDate', function(en) {
            refreshData();
          });
      });

   </script>

@endsection