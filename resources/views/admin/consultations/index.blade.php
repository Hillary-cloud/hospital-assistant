@extends('admin.layouts.app')

<x-assets.datatables />

@push('page-css')
@endpush

@push('page-header')
    <div class="col-sm-7 col-auto">
        <h3 class="page-title">Consultations</h3>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Consultations</li>
        </ul>
    </div>
    @can('create-consultations')
        <div class="col-sm-5 col">
            <a href="{{ route('consultations.create') }}" class="btn btn-primary float-right mt-2">Create Consultation</a>
        </div>
    @endcan
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
                                    <th>S/N</th>
                                    <th>Patient</th>
                                    <th>Consultation Date-Time</th>
                                    <th>Symptoms</th>
                                    <th>Status</th>
                                    <th class="action-btn"></th>
                                    <th></th>
                        
                                </tr>
                            </thead>
                            @php
                                $i = 1;
                            @endphp
                            <tbody>
                                @foreach ($consultations as $consultation)
                                    @if (auth()->user()->hasRole('patient') && $consultation->user_id == auth()->user()->id)
                                        {{-- Display only the patient's consultations --}}
                                        <tr>

                                            <td>{{ $i++ }}</td>
                                            <td>{{ucfirst($consultation->user->name)}}</td>
                                            <td>{{ $consultation->consultation_date }}</td>
                                            <td>{{ $consultation->symptoms }}</td>
                                            @if ($consultation->status == 'Waiting for approval')
                                                <td class="text-warning">Waiting for approval</td>

                                                <td><a href="{{ route('consultations.edit', $consultation->id) }}"
                                                        class="btn btn-success btn-sm text-light">Re-schedule</a></td>
                                                <td><a href="{{ route('consultations.destroy', $consultation->id) }}"
                                                        class="btn btn-danger btn-sm text-light">Cancel</a></td>
                                            @elseif($consultation->status == 'Approved')
                                                <td class="text-primary">Approved</td>

                                                @if (App\Models\Payment::where('consultation_id', $consultation->id)->exists())
                                                <td class="text-success">Paid</td>
                                                <td><a href="{{ route('consultations.viewConsultation', $consultation->id) }}"
                                                    class="btn btn-success btn-sm text-light">View</a></td>
                                            @else
                                                                             
                                                <td>
                                                    <form action="{{ route('consultations.pay', $consultation->id) }}"
                                                        method="POST">
                                                        @csrf

                                                        <button type="submit" class="btn btn-primary w-100">Pay
                                                            Now</button>
                                               
                                                </form>
                                            </td>
                                            <td><a href="{{ route('consultations.edit', $consultation->id) }}"
                                                class="btn btn-success btn-sm text-light">Re-schedule</a></td>
                                        <td><a href="{{ route('consultations.destroy', $consultation->id) }}"
                                                class="btn btn-danger btn-sm text-light">Cancel</a></td>
                                            @endif  
                                                
                                            @else
                                                <td class="text-danger">Declined</td>
                                            @endif
                                            {{-- @endif --}}
                                        @else
                                            <td>{{ $i++ }}</td>
                                            <td>{{ucfirst($consultation->user->name)}}</td>
                                            <td>{{ $consultation->consultation_date }}</td>
                                            <td>{{ $consultation->symptoms }}</td>
                                            @if ($consultation->status == 'Waiting for approval')
                                                <td class="text-warning">Waiting for approval</td>
                                                <td><a href="{{ route('consultations.approve', $consultation->id) }}"
                                                        class="btn btn-primary btn-sm text-light">Approve</a></td>
                                                <td><a href="{{ route('consultations.decline', $consultation->id) }}"
                                                        class="btn btn-success btn-sm text-light">Decline</a></td>
                                            @elseif($consultation->status == 'Approved')
                                                <td class="text-primary">Approved</td>
                                                @if (App\Models\Payment::where('consultation_id', $consultation->id)->exists())
                                                <td class="text-success">Paid</td>
                                                <td><a href="{{ route('consultations.viewConsultation', $consultation->id) }}"
                                                    class="btn btn-success btn-sm text-light">View</a></td>
                                            @else
                                                <td class="text-warning">Not Paid</td>
                                            @endif                                            
                                                
                                            @else
                                                <td class="text-danger">Declined</td>
                                            @endif
                                    @endif

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
    <script>
        $(document).ready(function() {
            var table = $('#consultations-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('consultations.index') }}",
                columns: [{
                        data: 'product',
                        name: 'product'
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
                    },
                    {
                        data: 'total_price',
                        name: 'total_price'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

        });
    </script>
@endpush
