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
          <div class="card-heading">Form Tambah Data Dinamis</div>
          <div class="card-body">
            <div class="card-body p-0 mt-2 mb-2 mr-3">
              <table class="table table-bordered mr-2 ml-2">
                <thead>
                  <tr class="text-center">
                    <th style="width: 10px">No</th>
                    <th>Product Name</th>
                    <th>Merk</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <form action="">
                    <tr class="after-add-more">
                      <td>1</td>
                      <td><select id="product"  name="product_id" class="form-control select2bs4" style="width: 100%;">
                        @foreach ($products as $product)
                        <option :selected="transaction_detail.product_id == {{ $product->id }}" data-a="{{ $product->merk }}" value="{{ $product->id }}">{{ $product->name }}</option>    
                        @endforeach
                      </td>
                      <td id="merk"></td>
                      <td>10</td>
                      <td>Rp</td>
                      <td><button class="btn btn-success add-more" type="button">
                        <i class="glyphicon glyphicon-plus"></i> Add
                      </button></td>
                    </tr>
                    {{-- copy --}}
                  </form>
                  <tr class="copy invisible">
                    <div class="control-group">
                      <td>1</td>
                      <td><select id="product" name="product_id" class="form-control select2bs4" style="width: 100%;">
                        @foreach ($products as $product)
                        <option :selected="transaction_detail.product_id == {{ $product->id }}" value="{{ $product->id }}">{{ $product->name }}</option>    
                        @endforeach
                      </td>
                      <td></td>
                      <td>10</td>
                      <td>Rp</td>
                      <td><button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button></td>
                    </div>
                    
                  </tr>
                </tbody>                
              </table>
            </div>
            <!-- /.card-body -->
          </div>
            <!-- membuat form  -->
            <!-- gunakan tanda [] untuk menampung array  -->
              {{-- <form action="proses.php" method="POST">
                <div class="control-group after-add-more">
                  <label>Nama</label>
                  <input type="text" name="nama[]" class="form-control">
                  <label>Jenis Kelamin</label>
                  <input type="text" name="jk[]" class="form-control">
                  <label>Alamat</label>
                  <input type="text" name="alamat[]" class="form-control">
                  <label>Jurusan</label>
                  <select class="form-control" name="jurusan[]">
                      <option>Sistem Informasi</option>
                      <option>Informatika</option>
                      <option>Akuntansi</option>
                      <option>DKV</option>
                    </select>
                  <br>
                  <button class="btn btn-success add-more" type="button">
                    <i class="glyphicon glyphicon-plus"></i> Add
                  </button>
                  <hr>
                </div>
                <button class="btn btn-success" type="submit">Submit</button>
              </form> --}}
      
              <!-- class hide membuat form disembunyikan  -->
              <!-- hide adalah fungsi bootstrap 3, klo bootstrap 4 pake invisible  -->
              {{-- <div class="copy invisible">
                  <div class="control-group">
                    <label>Nama</label>
                    <input type="text" name="nama[]" class="form-control">
                    <label>Jenis Kelamin</label>
                    <input type="text" name="jk[]" class="form-control">
                    <label>Alamat</label>
                    <input type="text" name="alamat[]" class="form-control">
                    <label>Jurusan</label>
                    <select class="form-control" name="jurusan">
                      <option>Sistem Informasi</option>
                      <option>Informatika</option>
                      <option>Akuntansi</option>
                      <option>DKV</option>
                    </select>
                    <br>
                    <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                    <hr>
                  </div>
                </div> --}}
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
    $( function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
  })
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      $(".add-more").click(function(){ 
          var html = $(".copy").html();
          $(".after-add-more").after(html);
      });

      // saat tombol remove dklik control group akan dihapus 
      $("body").on("click",".remove",function(){ 
          $(this).parents(".control-group").remove();
      });
    });

    $('#product').on('change', function(){
    let selectedProduct = $('#product').data('a');
    $('#merk').text(selectedProduct);
});
</script>
  <script src="{{asset('js/data.js')}}"></script>
  <script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
@endsection