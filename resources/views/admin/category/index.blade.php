@extends('layouts.admin')
@section('header')
    Category
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
          <a href="#" @click="addData()" class="btn btn-sm btn-primary pull-right">Add New Category</a> 
        </div>
        
        <!-- /.card-header -->
        <div class="card-body pl-3 mt-2 mb-2">
            <table id="datatable" class="table table-bordered mr-2">
            <thead>
              <tr class="text-center">
                <th style="width: 10px">No</th>
                <th>Category</th>
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
              <h4 class="modal-title">Supplier</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
    
            <div class="modal-body">
  
              @csrf          
              
              <input type="hidden" name="_method" value="PUT" v-if="editStatus">
              <div class="form-group">
                <label>Category</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Name" :value="data.name" required="">
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
    var actionUrl = '{{ url('categories') }}';
    var apiUrl = '{{ url('api/categories') }}';
  
    var columns = [
      {data: 'DT_RowIndex', class: 'text-center', orderable: true},
      {data: 'name', class: 'text-center', orderable: true},
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