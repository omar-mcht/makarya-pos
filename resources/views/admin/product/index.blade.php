@extends('layouts.admin')
@section('header')
    Product
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

@section('content')
<div id="controller">
    <div class="container">
      <div class="card">
        <div class="card-header">
          <a href="#" @click="addData()" class="btn btn-sm btn-primary pull-right">Add New Product</a> 
        </div>
        
        <!-- /.card-header -->
        <div class="card-body pl-3 mt-2 mb-2">
            <table id="datatable" class="table table-bordered mr-2">
            <thead>
              <tr class="text-center">
                <th style="width: 10px">No</th>
                <th>Product Name</th>
                <th>Merk</th>
                <th>Sell Price</th>
                <th>Buy Price</th>
                <th>Stock</th>
                <th>category</th>
                <th>supplier</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
    <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <form method="post" :action="actionUrl" autocomplete="off" @submit="submitForm($event, data.id)">
            <div class="modal-header">
              <h4 class="modal-title">Product</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
    
            <div class="modal-body">
  
              @csrf          
              
              <input type="hidden" name="_method" value="PUT" v-if="editStatus">
              <div class="form-group">
                <label>Product Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Product Name" :value="data.name" required="">
              </div>
              <div class="form-group">
                <label>Merk</label>
                <input type="text" name="merk" class="form-control" placeholder="Enter Merk" :value="data.merk" required="">
              </div>
              <div class="form-group">
                <label>Sell Price</label>
                <input type="text" name="sell_price" class="form-control" placeholder="Enter Sell Price" :value="data.sell_price" required="">
              </div>
              <div class="form-group">
                <label>Buy Price</label>
                <input type="text" name="buy_price" class="form-control" placeholder="Enter Buy Price" :value="data.buy_price" required="">
              </div>
              <div class="form-group">
                <label>Stock</label>
                <input type="text" name="stock" class="form-control" placeholder="Enter Stock" :value="data.stock" required="">
              </div>
              <div class="form-group">
                <label>Category</label>
                <select name="category_id" class="form-control">
                    @foreach ($categories as $category)
                    <option :selected="data.category_id == {{ $category->id }}" value="{{ $category->id }}">{{ $category->name }}</option>    
                    @endforeach                            
                </select>
              </div>
              <div class="form-group">
                <label>Supplier</label>
                <select name="supplier_id" class="form-control">
                    @foreach ($suppliers as $supplier)
                    <option :selected="data.supplier_id == {{ $supplier->id }}" value="{{ $supplier->id }}">{{ $supplier->name }}</option>    
                    @endforeach                            
                </select>
              </div>          
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Enter</button>
            </div>
          </form>        
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </div>
  
  
  @endsection
  
  @section('js')
  <!-- DataTables  & Plugins -->
  <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
  
  <script type="text/javascript">
    var actionUrl = '{{ url('products') }}';
    var apiUrl = '{{ url('api/products') }}';
  
    var columns = [
      {data: 'DT_RowIndex', class: 'text-center', orderable: true},
      {data: 'name', class: 'text-center', orderable: true},
      {data: 'merk', class: 'text-center', orderable: false},
      {data: 'sell_price', class: 'text-center', orderable: false},
      {data: 'buy_price', class: 'text-center', orderable: false},
      {data: 'stock', class: 'text-center', orderable: false},
      {data: 'category', class: 'text-center', orderable: false},
      {data: 'supplier', class: 'text-center', orderable: false},
      {render: function (index, row, data, meta) {
        return `
          <a href="#" class="btn btn-warning btn-sm" onclick="controller.editData(event, ${meta.row})">
            Edit
          </a>
          <a class="btn btn-danger btn-sm" onclick="controller.deleteData(event, ${data.id})">
            Delete
          </a>`;
      }, orderable: false, width:'200px', class:'text-center'},
    ];
  
  </script>
  <script src="{{asset('js/data.js')}}"></script>
@endsection