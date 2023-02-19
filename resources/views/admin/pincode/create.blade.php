@extends('admin.layouts.master')

@section('page_title')
    Create
@endsection

@push('css')
	<style>
		#output{
			width: 100%;
		}
	</style>
@endpush

@section('content')
	<form method="POST" action="{{ route('pincode.store') }}">
		@csrf()

		<div class="page-header">
            <div class="card breadcrumb-card">
                <div class="row justify-content-between align-content-between" style="height: 100%;">
                    <div class="col-md-6">
                        <h3 class="page-title">Create</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
								<a href="{{ route('dashboard') }}">Dashboard</a>
							</li>
                            <li class="breadcrumb-item">
								<a href="{{ route('pincode.index') }}">Pincode</a>
							</li>
                            <li class="breadcrumb-item active-breadcrumb">
								<a href="{{ route('pincode.create') }}">@yield('page_title')</a>
							</li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <div class="create-btn pull-right">
                            <button type="submit" class="btn custom-create-btn">Save</button>
                        </div>
                    </div>
                </div>
            </div><!-- /card finish -->	
        </div><!-- /Page Header -->

		<section class="crud-body">
			<div class="row">
				<div class="col-md-12">

					<div class="card">

						<div class="card-header">
							<h5 class="card-title">
								Pincode Information
							</h5>
						</div>
						
						<div class="card-body">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label for="city_id" class="required">City</label>

										<select type="text" name="city_id" id="city_id" class="form-control @error('city_id') form-control-error @enderror" required="required">

											<option value="">Choose City</option>
											@foreach ($citys as $city)
												<option value="{{$city->id}}">{{$city->city_name}}</option>
											@endforeach	

										</select>

										@error('city_id')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="oda" class="required">ODA</label>

										<select type="text" name="oda" id="oda" class="form-control @error('oda') form-control-error @enderror" required="required">
											<option value="">Choose ODA</option>
											<option value="1">True</option>	
											<option value="0">False</option>	
										</select>

										@error('oda')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
								</div>
								<div class="col-md-12">
									
									<div class="form-group">
										<label for="pincode" class="required">Pincode</label>
										<input type="text" name="pincode" id="pincode" class="form-control @error('pincode') form-control-error @enderror" required="required" value="{{old('pincode')}}">

										@error('pincode')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
								</div>
							</div>
						</div>
					</div>  <!-- end card -->
				</div>
			</div>	
		</section>
		
	</form>
@endsection
