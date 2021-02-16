@extends('template.index')

@section('content')

<form action="{{route('products.store')}}" method="POST">
@csrf

 <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-header">
                <h3 class="box-title">Create Products</h3>
            </div>
            <div class="box-body">
                <form role="form">
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input id="nama_product" name="nama_product" type="text" class="form-control" placeholder="Nama"/>
                    </div>

                    <div class="dropdown">
                    <label>Kategori Produk</label><br>
                      <select id="category" name="category">
                          <option value="1">Kayu</option>
                          <option value="2">Plastik</option>
                      </select>
                    </div>

                    <div class="form-group">
                        <label>Harga</label>
                        <input id="harga" name="harga" type="text" class="form-control" placeholder="Rp. "/>
                    </div>                                      

                      <br>
                  <input type="submit" value="Create" class="btn btn-primary">
                </form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!--/.col (right) -->

@endsection