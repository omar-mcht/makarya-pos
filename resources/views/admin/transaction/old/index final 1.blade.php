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
            <table class="table table-bordered mr-2 ml-2" id="tabel1">
              <thead>
                <tr>
                  <th style="width: 10px">No</th>
                  <th>Product Name</th>
                  <th>Merk</th>
                  <th>Quantity</th>
                  <th>Total(price)</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  <tr>
                    <td>1</td>
                    <td>
                      <select id="product" name="product_id" class="form-control product" style="width: 100%;">
                        @foreach ($products as $product)
                        <option data-merk="{{ $product->merk }}" data-price="{{ $product->sell_price }}" value="{{ $product->id }}">{{ $product->name }}</option>    
                        @endforeach
                      </select>
                    </td>
                    {{-- <td contenteditable="true" class="product" required></td> --}}
                    <td class="merk"> <input type="text" id="merk" name="merk" readonly></td>
                    <td contenteditable="true" class="qty" required></td>
                    <td class="price"> <input type="text" id="price" name="price" readonly></td>
                    {{-- <td contenteditable="false" class="total"><span id="total"></span></td> --}}
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
        let html = "<tr id='baris"+baris+"'>"
            html+= "<td>"+baris+"</td>"            
            html+= "<td><select id='product2' name='product_id' class='form-control' style='width: 100%;'> @foreach ($products as $product) <option  data-merk='{{ $product->merk }}' value='{{ $product->id }}'>{{ $product->name }}</option> @endforeach </select></td>"
            html+= "<td class='merk' ><input type='text' id='merk' name='merk2' readonly></td>"
            html+= "<td contenteditable='true' class='qty'></td>"
            html+= "<td contenteditable='false' class='total'></td>"
            html+= "<td> <button class='btn-sm btn-danger' data-row='baris"+baris+"' id='hapus'> - </button></td>"
            html+= "</tr>"
            
            $('#tabel1').append(html)                      
      })
    })
    $(document).on('click', '#hapus', function (){
      let hapus = $(this).data('row')
      $('#' + hapus).remove()
    })

    
    $(document).on('click', '#simpan', function(){
      let product_id = []
      let qty = []
      let member_id = "1"
      

      $('#product').each(function(){
        product_id.push($(this).val())
      })
      $('.qty').each(function(){
        qty.push($(this).text())
      })

      $.ajax({
        url : "{{ url('transactions') }}",
        type : 'post',
        data :{
          product_id : product_id,
          qty : qty,
          member_id : member_id,
          "_token" : "{{ csrf_token() }}"
        },success: function (res) {
          console.log(res);
        },error: function(xhr) {
          console.error(xhr);
        }
      })
    })
    



    $('#product').on('change', function(){
  // ambil data dari elemen option yang dipilih
  const merk = $('#product option:selected').data('merk');  
  // tampilkan data ke element
  $('[name=merk]').val(merk); 
  });

  $('#product').on('change', function(){
  // ambil data dari elemen option yang dipilih
  const merk2 = $('#product option:selected').data('price');  
  // tampilkan data ke element
  $('[name=price]').val(merk2); 
  });

  // const jumlah = $('qty').text();
  // const harga = $('#product option:selected').data('sell_price');
  // const total = (harga*jumlah);

  // $('#total').text(`Rp ${total}`);



  $('#product1').on('change', function(){
  // ambil data dari elemen option yang dipilih
  const merk = $('#product1 option:selected').data('merk');  
  // tampilkan data ke element
  $('#merk').val(merk); 
  });

  $('#product2').on('change', function(){
  // ambil data dari elemen option yang dipilih
  const merk = $('#product2 option:selected').data('merk2');  
  // tampilkan data ke element
  $('[name=merk2]').val(merk); 
  });
      
  </script>

  <script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
@endsection