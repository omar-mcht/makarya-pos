@extends('layouts.admin')
@section('header')
    Home
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Dashboard') }}
                </div>
                <a class="ml-2 mr-2 mt2" href="{{ url('transactions') }}">Create new transaction</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
