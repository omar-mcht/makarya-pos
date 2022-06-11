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
              <table class="table table-bordered mr-2 ml-2" >
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
                <tbody id="tbody2">
                    <tr>
                      <td><input name="chk_a[]" type="checkbox" class="checkall_a" value=""/></td>
                      <td>
                        <div class="form-group">
                          <select id="product" name="product_id[]" class="form-control product" style="width: 100%;">
                            
                            @foreach ($products as $product)
                            <option data-merk="{{ $product->merk }}" data-price="{{ $product->sell_price }}" value="{{ $product->id }}">{{ $product->name }}</option>    
                            @endforeach
                          </select>
                        </div>
                      </td>
                      {{-- <td contenteditable="true" class="product" required></td> --}}
                      <td> <input type="text" id="merk" name="merk" readonly></td>
                      <td><input type="text" name="qty[]"><input type="hidden" name="member_id" value="1"></td>
                      <td class="price"> <input type="text" id="price" name="price" readonly></td>
                      {{-- <td contenteditable="false" class="total"><span id="total"></span></td> --}}
                      
                    </tr>
                </tbody>
                <td><input type="hidden" name="member_id" value="1"></td>            
              </table>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>            
            <br>
            <tfoot>
              <tr>
                <td colspan="3" align="center">
                <button type="button" class="btn btn-primary" onclick="addRow('tbody2')">Tambah Baris</button>
                <button type="button" class="btn btn-danger" onclick="deleteRow('tbody2')">Delete Baris</button>
                </td>
              </tr>
        </tfoot>
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

    $('.product').on('change', function(){
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


  function addRow(tableID) {
    var table = document.getElementById(tableID);
    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
    var colCount = table.rows[0].cells.length;
    var classProduct = document.getElementById('product');
    for(var i=0; i<colCount; i++) {
        var newcell = row.insertCell(i);
        newcell.innerHTML = table.rows[0].cells[i].innerHTML;
        var child = newcell.children;
        for(var i2=0; i2<child.length; i2++) {
            var test = newcell.children[i2].tagName;
            switch(test) {
                case "INPUT":
                    if(newcell.children[i2].type=='checkbox'){
                        newcell.children[i2].value = "";
                        newcell.children[i2].checked = false;
                    }else{
                        newcell.children[i2].value = "";
                    }
                break;
                case "SELECT":
                    newcell.children[i2].value = "";
                break;
                default:
                break;
            }
        }
    }
}
    
function deleteRow(tableID)
{
    try
         {
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;
            for(var i=0; i<rowCount; i++)
                {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if (null != chkbox && true == chkbox.checked)
                    {
                    if (rowCount <= 1)
                        {
                        alert("Tidak dapat menghapus semua baris.");
                        break;
                        }
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                    }
                }
            } catch(e)
    {
    alert(e);
    }
 }
  </script>
  <script src="{{asset('js/data.js')}}"></script>
  <script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
@endsection