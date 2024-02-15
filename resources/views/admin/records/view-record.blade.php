@extends('admin.layouts.app')

<x-assets.datatables />

@push('page-css')
@endpush

@push('page-header')
    <div class="col-sm-7 col-auto">
        <h3 class="page-title">Records</h3>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Record Details</li>
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
                    <h1 class="text-center">HOSPITAL<span class="text-primary">ASSISTANT</span></h1>
                    <h2 class="text-success text-center fw-bold"> Record</h2>
                    <h3 class="text-center">  <span class="text-primary"></span></h3><br>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>PATIENT DETAILS</th>
                                    <th>RECORD DETAILS</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> 
                                        <p>Name: <span> {{ ucfirst($record->user->name) }}</span></p>
                                        <p>Phone Number: <span> {{ $record->user->phone }}</span></p>
                                        <p>Email: <span> {{ $record->user->email }}</span></p>
                                        
                                    </td>
                                    <td>
                                        <p>Symptoms: <span> {{ $record->symptoms }}</span></p>
                                        <p>Diagnosis: <span> {{ $record->diagnosis }}</span></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Test Result: <span> {{ $record->test_result }}</span></p>
                                        <p>Treatment Plan: <span> {{ $record->treatment_plan }}</span></p>
                                    </td>

                                    <td>
                                        <p>Prescription: <span> {{ $record->prescription }}</span></p>
                                        <p>Follow-Up: <span> {{ $record->follow_up }}</span></p>
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
