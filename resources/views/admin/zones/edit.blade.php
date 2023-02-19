@extends('admin.layouts.master')
@section('page_title')
    Zone Edit
@endsection
@section('content')
	<form method="POST" action="{{ route('zones.update', $zones->id) }}">
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
								<a href="{{ route('zones.index') }}">@yield('page_title')</a>
							</li>
							<li class="breadcrumb-item active-breadcrumb">
								<a href="{{ route('zones.edit', $zones->id) }}">@yield('page_title') - ({{ $zones->state_name }})</a>
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
				<div class="col-md-12">

					<div class="form-group">
						<label for="name">Name:</label>
						<input type="text" name="zone_name" id="zone_name" class="form-control @error('zone_name') form-control-error @enderror" required="required" value="{{$zones->zone_name}}">

						@error('zone_name')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>

				</div>
			</div> <!-- /row -->
		</div> <!-- /card-body -->

	</form>
@endsection