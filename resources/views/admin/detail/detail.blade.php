@extends('layouts.admin')
@section('header')
    Transaction Details
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

@section('content')
<div id="controller">
    <div class="row justify-content-center">
        <div class="col col-md-6">     
            <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Transaction Detail</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->  
                <div class="card-body">
                    <div class="form-group">
                        <table class="table mr-2">
                            <tr>
                                <th>Cashier</th>
                                <td>
                                <p>{{($cashier)}}</p>
                                </td>
                            </tr>
                            <tr>
                                <th>Transaction Date</th>
                                <td>
                                    <p>{{$date}}</p>
                                </td>
                            </tr>                     
                        </table>               
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="row">
                            <div class="ml-auto mr-auto">
                                <label>Transaction Detail</label>
                            </div>
                        </div>
                            <hr>
                        <div class="row">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            @foreach ($transaction->transactionDetails as $detail)
                                            <li>{{ $detail->products->name }}</li>                          
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($transaction->transactionDetails as $detail)
                                            <li>{{ $detail->quantity }}</li>                          
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($transaction->transactionDetails as $detail)
                                            <li>Rp {{number_format( $detail->sub_total ,'0', ',', '.')}}</li>                          
                                            @endforeach
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>                                        
                                        <th colspan="2">
                                            Total
                                        </th>                                        
                                        <td>
                                           {{ $subtotal }}
                                        </td>
                                    </tr>
                                </tfoot>                                
                            </table>             
                        </div>                                        
                    </div>
                    </div>
                    <hr>                            
                <div class="modal-footer justify-content-between">
                    <a href="{{ url('details') }}" class="btn btn-warning">Cancel</a>  
                </div>
                </div>
            
            </div>
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
  var actionUrl = '{{ url('details') }}';
  var apiUrl = '{{ url('api/transactions') }}';

  var columns = [
    {data: 'DT_RowIndex', class: 'text-center', orderable: true},
    {data: 'product', class: 'text-center', orderable: true},
    // {data: 'quantity', class: 'text-center', orderable: true},
    // {data: 'sub_total', class: 'text-center', orderable: true},
  ];

</script>
<script src="{{asset('js/data.js')}}"></script>
@endsection