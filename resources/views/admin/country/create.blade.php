@extends('admin.layouts.master')
@section('page_title')
    Create
@endsection

@section('content')
	<form action="{{ route('country.store') }}" method="POST" enctype="multipart/form-data">
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
								<a href="{{ route('country.index') }}">@yield('page_title')</a>
							</li>
							<li class="breadcrumb-item active-breadcrumb">
								<a href="{{ route('country.create') }}">@yield('page_title')</a>
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
				<div class="col-md-12">

					<div class="form-group">
						<label for="name">Name:</label>
						<input type="text" name="country_name" id="country_name" class="form-control @error('country_name') form-control-error @enderror" required="required" value="{{old('country_name')}}">

						@error('country_name')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>

				</div>
			</div> <!-- /row -->
		</div> <!-- /card-body -->
			
	</form>
@endsection