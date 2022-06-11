@extends('layouts.admin')
@section('header')
    Transaction
@endsection

@section('css')

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
            
            <form action="{{ url('transactions') }}" method="post">
              @csrf
              <table class="table table-bordered mr-2 ml-2" id="tabel1">
                <div class="row">
                  <div class="ml-auto mb-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
                <thead>
                  <tr>
                    <th style="width: 10px">No</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                      <td>1</td>
                      <td>
                        <div class="form-group">
                          <select id="product" name="product_id[]" class="form-control product" style="width: 100%;">
                            @foreach ($products as $product)
                            <option data-merk="{{ $product->merk }}" data-price="{{ $product->sell_price }}" value="{{ $product->id }}">{{ $product->name }}</option>    
                            @endforeach
                          </select>
                        </div>
                      </td>
                      <td><input type="text" id="qty" name="qty[]"><input type="hidden" name="member_id" value="1"></td>                   
                    </tr>
                </tbody> 
                <tfoot>
                <tr>
                  <td colspan="6" align="right">
                   
                    
                  </td>
                </tr>
                </tfoot>             
              </table>              
            </form>            
            <br>
            <div class="row">
              <div class="ml-auto">
                <button class="btn btn-success" id="tambah">Add Transaction</button>
              </div>
              
            </div>
          </div>
          <!-- /.card-body -->
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
    
    $(document).ready(function() {
      let baris = 1
      $(document).on('click', '#tambah', function (){
        baris = baris + 1
        var html = "<tr id='baris"+baris+"'>"
            html+= "<td>"+baris+"</td>"            
            html+= "<td><select id='product' name='product_id[]' class='form-control' style='width: 100%;'> @foreach ($products as $product) <option data-price='{{ $product->sell_price }}' data-merk='{{ $product->merk }}' value='{{ $product->id }}'>{{ $product->name }}</option> @endforeach </select></td>"
            html+= "<td><input type='text' name='qty[]'></td>"
            html+= "<td> <button class='btn-sm btn-danger' data-row='baris"+baris+"' id='hapus'> - </button></td>"
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
  $('[name=merk]').val(merk); 
  });

 
  const jumlah = $('#qty').val();
  const harga = $('#product option:selected').data('price');
  const total = (harga*jumlah);

  $('#total').text(`Rp ${total}`);
      
  </script>
  <script src="{{asset('js/data.js')}}"></script>
  <script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
@endsection