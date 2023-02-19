@extends('admin.layouts.master')
@section('page_title')
    State Edit
@endsection
@section('content')
	<form method="POST" action="{{ route('states.update', $states->id) }}">
		@csrf()

		<div class="page-header">
			<div class="card breadcrumb-card">
				<div class="row justify-content-between align-content-between" style="height: 100%;">
					<div class="col-md-6">
						<h3 class="page-title">@yield('page_title')</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
							</li>
							<li class="breadcrumb-item">
								<a href="{{ route('states.index') }}">@yield('page_title')</a>
							</li>
							<li class="breadcrumb-item active-breadcrumb">
								<a href="{{ route('states.edit', $states->id) }}">@yield('page_title') - ({{ $states->state_name }})</a>
							</li>
						</ul>
					</div>
					<div class="col-md-3">
						<div class="create-btn pull-right">
							<button type="submit" class="btn custom-create-btn">Update</button>
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
							<option value="0" {{ $states->country_type == 0 ? 'selected' : '' }} >Domestic</option>
							<option value="1" {{ $states->country_type == 1 ? 'selected' : '' }}>International</option>
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
								<option value="{{ $country->id }}" {{ $states->country_id == $country->id ? 'selected' : '' }}>{{ $country->country_name }}</option>
							@endforeach
						</select>

						@error('country_id')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="name">Name:</label>
						<input type="text" name="state_name" id="state_name" class="form-control @error('state_name') form-control-error @enderror" required="required" value="{{$states->state_name}}">
						@error('state_name')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
				</div>
			</div> <!-- /row -->
		</div> <!-- /card-body -->

	</form>
@endsection