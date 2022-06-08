@extends('layouts.admin')
@section('header')
    Transaction
@endsection

@section('css')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> --}}
<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection

@section('content')
<div id="controller">
    <div class="container">
      <div class="card">        
        <!-- /.card-header -->
        <div class="card card-default">
          <div class="card-header">Transaction</div>
          <div class="card-body">
            <div class="card-body p-0 mt-2 mb-2 mr-3">
              <table class="table table-bordered mr-2 ml-2" id="tabel1">
                <thead>
                  <tr>
                    <th style="width: 10px">No</th>
                    <th>Product Name</th>
                    <th>Merk</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                      <td>1</td>
                      <td class="product">
                        <select id="product" name="product_id" class="form-control select2" style="width: 100%;">
                          @foreach ($products as $product)
                          <option :selected="transaction_detail.product_id == {{ $product->id }}" data-merk="{{ $product->merk }}" value="{{ $product->id }}">{{ $product->name }}</option>    
                          @endforeach
                      </td>
                      <td contenteditable="false" class="merk" ><span id="merk"></span></td>
                      <td contenteditable="true" class="quantity"></td>
                      <td contenteditable="false" class="total"></td>
                      <td><button class="btn-sm btn-success" id="tambah">+</button></td>
                    </tr>
                </tbody>                
              </table>
              <br>
              <button class="btn btn-success" id="tambah">+</button>
              <button class="btn btn-primary" id="simpan">submit</button>
            </div>
            <!-- /.card-body -->
          </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
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
    // var actionUrl = '{{ url('transactions') }}';
    // var apiUrl = '{{ url('api/transactions') }}';
  
    // var columns = [
    //   {data: 'DT_RowIndex', class: 'text-center', orderable: true},
    //   {data: 'a', class: 'text-center', orderable: true},
    //   {data: 'merk', class: 'text-center', orderable: false},
    //   {data: 'quantity', class: 'text-center', orderable: false},
    //   {data: 'total', class: 'text-center', orderable: false},
    //   {render: function (index, row, data, meta) {
    //     return `
    //       <a href="#" class="btn btn-warning btn-sm" onclick="controller.editData(event, ${meta.row})">
    //         Edit
    //       </a>
    //       <a class="btn btn-danger btn-sm" onclick="controller.deleteData(event, ${data.id})">
    //         Delete
    //       </a>`;
    //   }, orderable: false, width:'200px', class:'text-center'},
    // ];


    // $( function () {
    //   //Initialize Select2 Elements
    //   $('.select2').select2()

    //   //Initialize Select2 Elements
    //   $('.select2bs4').select2({
    //     theme: 'bootstrap4'
    //   })
    // })

    $(document).ready(function() {
      let baris = 1
      $(document).on('click', '#tambah', function (){
        baris = baris + 1
        var html = "<tr id='baris'"+baris+">"
            html+= "<td>"+baris+"</td>"
            html+= "<td class='product'><select id='product2' name='product_id' class='form-control select2bs4' style='width: 100%;'> @foreach ($products as $product) <option :selected='transaction_detail.product_id == {{ $product->id }}' data-merk2='{{ $product->merk }}' value='{{ $product->id }}'>{{ $product->name }}</option> @endforeach`</td>"
            html+= "<td contenteditable='false' class='merk'><span id='merk2'></span></td>"
            html+= "<td contenteditable='true' class='quantity'></td>"
            html+= "<td contenteditable='false' class='total'></td>"
            html+= "<td> <button class='btn-sm btn-danger' data-row='baris' "+baris+" id='hapus'> - </button></td>"
            html+= "</tr>"
            
            $('#tabel1').append(html)                      
      })
    })
    $(document).on('click', '#hapus', function (){
      let hapus = $(this).data('row')
      $('#' + hapus).remove()
    })

    $('#product').on('change', function(){
  // ambil data dari elemen option yang dipilih
  const merk = $('#product option:selected').data('merk');  
  // tampilkan data ke element
  $('#merk').text(merk); 
  });

  $('#product2').on('change', function(){
  // ambil data dari elemen option yang dipilih
  const merk2 = $('#product2 option:selected').data('merk2');  
  // tampilkan data ke element
  $('#merk2').text(merk2); 
  });


    
  </script>
  
  <script src="{{asset('js/data.js')}}"></script>
  <script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
@endsection