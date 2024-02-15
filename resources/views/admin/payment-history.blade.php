@extends('admin.layouts.app')

<x-assets.datatables />

@push('page-css')
@endpush

@push('page-header')
    <div class="col-sm-7 col-auto">
        <h3 class="page-title">Payment History</h3>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Payment History</li>
        </ul>
    </div>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">

            <!--  Sales -->
            <div class="card">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="sales-table" class="datatable table table-hover table-striped table-center mb-0">
                            <thead>
                                <tr>
                                    <th>Transaction Ref</th>
                                    <th>Amount</th>
                                    <th>Transaction Type</th>
                                    <th>Transaction Date</th>
                        
                                </tr>
                            </thead>
                            @php
                                $i = 1;
                            @endphp
                            <tbody>
                                @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ $payment->reference_number }}</td>
                                    <td>{{ $payment->amount }}</td>
                                    <td>{{ $payment->payment_for }}</td>
                                    <td>{{ $payment->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- / sales -->

        </div>
    </div>
@endsection

@push('page-js')
    
@endpush
