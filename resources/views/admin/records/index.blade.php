@extends('admin.layouts.app')

<x-assets.datatables />

@push('page-css')
@endpush

@push('page-header')
    <div class="col-sm-7 col-auto">
        <h3 class="page-title">Record</h3>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Record</li>
        </ul>
    </div>
    @can('edit-records')
    <div class="col-sm-5 col">
        <a href="{{ route('records.edit') }}" class="btn btn-primary float-right mt-2">Edit Record</a>
    </div>
@endcan
@can('create-records')
<div class="col-sm-5 col">
    <a href="{{ route('records.create') }}" class="btn btn-primary float-right mt-2">Create Record</a>
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
                    <div>
                        @if (auth()->user()->hasRole('patient'))
                        <form action="{{route('records.getPatient')}}" method="GET">
                            @csrf
                            <label for="">Patient Email</label>
                            <input type="text" class="form-control mb-2" value="{{auth()->user()->email}}" name="email" readonly>
                            <button class="btn btn-primary text-light">Submit</button>
                        </form>
                        @else
                        <form action="{{route('records.getPatient', ['email' => old('email')])}}" method="GET">
                            @csrf
                            <label for="">Patient Email</label>
                            <input type="text" class="form-control mb-2" value="{{old('email')}}" name="email" placeholder="Enter email">
                            <button class="btn btn-primary text-light">Submit</button>
                        </form>
                        @endif
                        
                    </div>
                </div>

                @if (isset($records) && $records->isNotEmpty() && \App\Models\User::where('email', $request->email)->exists())

                <div class="card-body">
                    <h2>Medical Record</h2>
                    <div class="table-responsive">
                        <table id="sales-table" class="datatable table table-hover table-striped table-center mb-0">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Diagnosis</th>
                                    <th>Prescription</th>
                                    <th>Treatment</th>
                                    <th>Test Result</th>
                                    <th>Symptoms</th>
                                    <th>Follow-Up</th>
                                    <th>Date</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($records as $record)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $record->diagnosis }}</td>
                                        <td>{{ $record->prescription }}</td>
                                        <td>{{ $record->treatment }}</td>
                                        <td>{{ $record->test_result }}</td>
                                        <td>{{ $record->symptoms }}</td>
                                        <td>{{ $record->follow_up }}</td>
                                        <td>{{ $record->created_at }}</td>
                                        <td><a href="{{ route('records.viewRecord', $record->id) }}"
                                            class="btn btn-success btn-sm text-light">View</a></td>
                                        @if (auth()->user()->hasRole('patient'))
                                            <td></td>
                                        @else
                                            <td>
                                                <a href="{{ route('records.edit', $record->id) }}">Edit</a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            {{-- @elseif (!isset($records))
                <!-- Display a message if records are not fetched yet -->
                <p>Please submit the patient email to view records.</p> --}}
            @else
                <!-- Display a message if no records found for the provided email -->
                <p>No provided email.</p>
            @endif

            
                    
                </div>
            </div>
            <!-- / sales -->

        </div>
    </div>
@endsection

@push('page-js')
    
@endpush
