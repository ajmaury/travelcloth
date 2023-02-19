@extends('admin.layouts.master')
@section('page_title')
    Create
@endsection

@section('content')
	<form action="{{ route('states.store') }}" method="POST" enctype="multipart/form-data">
		@csrf()
			
		<div class="page-header">
			<div class="card breadcrumb-card">
				<div class="row justify-content-between align-content-between" style="height: 100%;">
					<div class="col-md-6">
						<h3 class="page-title">@yield('page_title')</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item">
								<a href="{{ route('dashboard') }}">Dashboard</a>
							</li>
							<li class="breadcrumb-item">
								<a href="{{ route('states.index') }}">State</a>
							</li>
							<li class="breadcrumb-item active-breadcrumb">
								<a href="{{ route('states.create') }}">@yield('page_title')</a>
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

		<div class="card-body">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="country_type" class="required">Country Type</label>
						<select name="country_type" id="country_type" class="select2">
							<option value="0">Domestic</option>
							<option value="1">International</option>
						</select>
						@error('country_type')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="country_id" class="required">Country</label>
						<select name="country_id" id="country_id" class="select2">
							@foreach ($countrys as $country)
								<option value="{{ $country->id }}">{{ $country->country_name }}</option>
							@endforeach
						</select>

						@error('country_id')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="name">State Name</label>
						<input type="text" name="state_name" id="state_name" class="form-control @error('state_name') form-control-error @enderror" required="required" value="{{old('state_name')}}">

						@error('state_name')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
				</div>
			</div> <!-- /row -->
		</div> <!-- /card-body -->
			
	</form>
@endsection