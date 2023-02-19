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
	<form method="POST" action="{{ route('citys.store') }}">
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
								<a href="{{ route('citys.index') }}">City</a>
							</li>
                            <li class="breadcrumb-item active-breadcrumb">
								<a href="{{ route('citys.create') }}">@yield('page_title')</a>
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
								City Information
							</h5>
						</div>
						
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="state_id" class="required">State:</label>

										<select type="text" name="state_id" id="state_id" class="form-control @error('state_id') form-control-error @enderror" required="required">

											<option value="">Choose State</option>
											@foreach ($states as $state)
												<option value="{{$state->id}}">{{$state->state_name}}</option>
											@endforeach	

										</select>

										@error('state_id')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
									<div class="form-group">
										<label for="city_name" class="required">City Name:</label>
										<input type="text" name="city_name" id="city_name" class="form-control @error('city_name') form-control-error @enderror" required="required" value="{{old('city_name')}}">

										@error('city_name')
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
