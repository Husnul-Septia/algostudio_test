@extends('template.index')

@section('content')

<div>
		 <div class="box-header">        
       <h3>1.c - Pengurangan Stok Oleh Distributor</h3>  
  	   </div>
	   
	    <div class="box-body">
	 <div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                       
                      <form action="{{route('distributor.create')}}" method="POST">
                          @csrf
                           
                            <div class="form-group"> <label>Distributor :</label> 
                            
                                <select class="form-control" id="distibutor" name="distibutor">
                                    @foreach($distributor as $distributor)
                                        <option value="{{$distributor->kode_distributor}}">{{$distributor->nama_distributor}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group"> <label>Produk :</label> 
                            <select class="form-control" id="produk" name="produk">
                                @foreach($products as $products)
                                            <option value="{{$products->id}}">{{$products->nama_produk}}</option>
                                @endforeach
                             </select>
                            </div>
                            <div class="form-group"> <label>Stok :</label> 
                            <input class="form-control" id="stok" name="stok" style="text-align: right;" required> </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-default">Simpan</button> &nbsp &nbsp
                                <a href="javascript:void(0)" class="" data-dismiss="modal">Close</a>
                        </div>

                        </form>
                    </div>
                </div>
                <!--form mask ends-->
            </div>
        </div>
    </div>
    <!--form mask ends-->
</div>
		</div>
	<!-- </form> -->
</div>
<style type="text/css">
  .stretch-card>.card {
    width: 100%;
    min-width: 100%
}

body {
    background-color: #f9f9fa
}

.flex {
    -webkit-box-flex: 1;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto
}

@media (max-width:991.98px) {
    .padding {
        padding: 1.5rem
    }
}

@media (max-width:767.98px) {
    .padding {
        padding: 1rem
    }
}

.padding {
    padding: 3rem
}

.card {
    box-shadow: none;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    -ms-box-shadow: none
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid #3da5f;
    border-radius: 0
}

.card .card-body {
    padding: 1.25rem 1.75rem
}

.card .card-title {
    color: #000000;
    margin-bottom: 0.625rem;
    text-transform: capitalize;
    font-size: 1.5rem;
    font-weight: 500
}

.card .card-description {
    margin-bottom: .875rem;
    font-weight: 400;
    color: #76838f
}

.form-group label {
    font-size: 1.5rem;
    line-height: 1.4rem;
    vertical-align: top;
    margin-bottom: .5rem
}

.form-control {
    border: 1px solid #f3f3f3;
    font-weight: 400;
    font-size: 1.5rem
}
</style>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script type='text/javascript' src='https://code.jquery.com/jquery-1.11.0.js'></script>
<script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>

@endsection