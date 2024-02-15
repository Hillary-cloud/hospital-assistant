@extends('admin.layouts.app')

<x-assets.datatables />

@push('page-css')
@endpush

@push('page-header')
    <div class="col-sm-7 col-auto">
        <h3 class="page-title">Consultations</h3>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Consultations Details</li>
        </ul>
    </div>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">

            <!--  Sales -->
            <div class="card">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="card-body" id="sectionToPrint">
                    <h1 class="text-center">HOSPITAL ASSISTANT</h1>
                    <h2 class="text-success text-center fw-bold">{{$payment->payment_for}} Payment</h2>
                    <h3 class="text-center"> {{ $consultation->status }} <span class="text-primary">{{$payment->reference_number}}</span></h3><br>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>PATIENT DETAILS</th>
                                    <th>CONSULTATION DETAILS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> 
                                        <p>Patient: <span> {{ ucfirst($consultation->user->name) }}</span></p>
                                        <p>Phone Number: <span> {{ $consultation->symptoms }}</span></p>
                                        
                                    </td>
                                    <td>
                                        <p>Consultation Date and Time: <span> {{ $consultation->consultation_date }}</span></p>
                                        <p>Consultation Status: <span> {{ $consultation->status }}</span></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Reference Number: <span> {{ $payment->reference_number }}</span></p>
                                        <p>Consultation Fee: <span> {{ $payment->amount }}</span></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
            <button class="btn btn-primary" onclick="printSection('sectionToPrint')">Print</button>
            <!-- / sales -->

        </div>
    </div>
@endsection

@push('page-js')
<script>
    function printSection(sectionId) {
        var originalContents = document.body.innerHTML;
        var printContents = document.getElementById(sectionId).innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>


@endpush
