@extends('admin.layouts.master')

@section('page_title')
    Logistic
@endsection

@push('css')
	<style>
		#output{
			height: 300px;
			width: 300px;
		}

	</style>
@endpush

@section('content')
	<form method="post" action="{{ route('logistic.update', $logistic->id) }}" enctype="multipart/form-data">
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
								<a href="{{ route('logistic.index') }}">@yield('page_title')</a>
							</li>
							<li class="breadcrumb-item active-breadcrumb">
								<a href="{{ route('logistic.edit', $logistic->id) }}">@yield('page_title') </a>
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
		<div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            Logistic Information
                        </h5>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="fname" class="required">First Name:</label>
                                    <input type="text" name="fname" id="fname" class="form-control @error('fname') form-control-error @enderror" required="required" value="{{$logistic->fname}}">
                                    @error('fname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="lname" class="required">Last Name:</label>
                                    <input type="text" name="lname" id="lname" class="form-control @error('lname') form-control-error @enderror" required="required" value="{{$logistic->lname}}">
                                    @error('lname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email" class="required">Email:</label>
                                    <input type="email" name="email" id="email" class="form-control @error('email') form-control-error @enderror" required="required" value="{{$logistic->email}}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="mobile" class="required">Mobile:</label>
                                    <input type="tel" name="mobile" id="mobile" class="form-control @error('mobile') form-control-error @enderror" required="required" value="{{$logistic->mobile}}">
                                    @error('mobile')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div> <!-- card-body-end -->
                </div><!-- card-end -->
            </div> <!-- col-md-4-end -->
        </div>
	</form>
@endsection


@push('scripts')
<script>
	var loadFileImageFront = function(event) {
		var output = document.getElementById('output');
		output.src = URL.createObjectURL(event.target.files[0]);
	};
</script>
@endpush
