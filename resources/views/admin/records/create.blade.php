@extends('admin.layouts.app')

@push('page-css')
    
@endpush    

@push('page-header')
<div class="col-sm-12">
	<h3 class="page-title">Add Record</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
		<li class="breadcrumb-item active">Add Record</li>
	</ul>
</div>
@endpush


@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body custom-edit-service">
                <div>
                        
                    <form action="{{route('records.getPatientCreate')}}" method="GET">
                        @csrf
                        <label for="">Patient Email</label>
                        <input type="email" class="form-control mb-2" value="{{ old('email') }}" name="email" placeholder="Enter patient email to create record">
                        <button class="btn btn-primary text-light">Submit</button>
                    </form>
                </div>
                <!-- Add Product -->
                @if(isset($user) && $user->exists())
                <form method="post" class="mt-4" id="update_service" action="{{route('records.store')}}">
                    @csrf
                    <h2>Create Patient Record</h2>
                    <div class="service-fields mb-3">
                        <div class="row">
                            
                            <div class="col-lg-6">
                                <input type="text" name="user_id" value="{{$user->id}}" class="form-control" readonly hidden>
                                <div class="form-group">
                                    <label>Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{$user->name}}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="text" name="email" value="{{$user->email}}" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="service-fields mb-3">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Diagnosis<span class="text-danger">*</span></label>
                                   <textarea name="diagnosis" class="form-control" id="" cols="30" rows="10">{{old('diagnosis')}}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Prescription<span class="text-danger">*</span></label>
                                   <textarea name="prescription" class="form-control" id="" cols="30" rows="10">{{old('prescription')}}</textarea>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                                    
                    
                    <div class="service-fields mb-3">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label> Treatment Plan<span class="text-danger">*</span></label>
                                    <textarea class="form-control service-desc" name="treatment_plan">{{old('treatment_plan')}}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label> Test Result<span class="text-danger">*</span></label>
                                    <textarea class="form-control service-desc" name="test_result">{{old('test_result')}}</textarea>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="service-fields mb-3">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label> Symptoms</label>
                                    <textarea class="form-control service-desc" name="symptoms">{{old('symptoms')}}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label> Follow-Up</label>
                                    <textarea class="form-control service-desc" name="follow_up">{{old('follow_up')}}</textarea>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                    
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn" type="submit" name="form_submit" value="submit">Submit</button>
                    </div>
                </form>
                @else
                <p>No user record available</p>
                @endif
                <!-- /Add Product -->
			</div>
		</div>
	</div>			
</div>
@endsection

@push('page-js')
	
@endpush