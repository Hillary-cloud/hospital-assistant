@extends('admin.layouts.app')

@push('page-css')
    
@endpush    

@push('page-header')
<div class="col-sm-12">
	<h3 class="page-title">Edit Record</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
		<li class="breadcrumb-item active">Edit Record</li>
	</ul>
</div>
@endpush


@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body custom-edit-service">
                
                <!-- Add Product -->
                <form method="post" class="mt-4" id="update_service" action="{{route('records.update', $record->id)}}">
                    @csrf
                    @method("PUT")
                    <h2>Edit Patient Record</h2>

                    <div class="service-fields mb-3">
                        <input type="text" name="user_id" value="{{$record->user_id}}" class="form-control" hidden readonly>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Diagnosis<span class="text-danger">*</span></label>
                                   <textarea name="diagnosis" class="form-control" id="" cols="30" rows="10">{{$record->diagnosis}}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Prescription<span class="text-danger">*</span></label>
                                   <textarea name="prescription" class="form-control" id="" cols="30" rows="10">{{$record->prescription}}</textarea>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="service-fields mb-3">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label> Treatment Plan<span class="text-danger">*</span></label>
                                    <textarea class="form-control service-desc" name="treatment_plan">{{$record->treatment_plan}}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label> Test Result<span class="text-danger">*</span></label>
                                    <textarea class="form-control service-desc" name="test_result">{{$record->test_result}}</textarea>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="service-fields mb-3">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label> Symptoms</label>
                                    <textarea class="form-control service-desc" name="symptoms">{{$record->symptoms}}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label> Follow-Up</label>
                                    <textarea class="form-control service-desc" name="follow_up">{{$record->follow_up}}</textarea>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                    
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn" type="submit" name="form_submit" value="submit">Update</button>
                    </div>
                </form>
                <!-- /Add Product -->
			</div>
		</div>
	</div>			
</div>
@endsection

@push('page-js')
	
@endpush