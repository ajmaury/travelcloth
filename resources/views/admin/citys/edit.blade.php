@extends('admin.layouts.master')

@section('page_title')
    City Page Edit
@endsection

@push('css')
	<style>
		#output{
			width: 100%;
		}
	</style>
@endpush

@section('content')
	<form method="POST" action="{{ route('citys.update', $city->id) }}" enctype="multipart/form-data">
		@csrf()

		<!-- Page Header -->
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
								<a href="{{ route('citys.index') }}">City</a>
							</li>
							<li class="breadcrumb-item active-breadcrumb">
								<a href="{{ route('citys.edit', $city->id) }}">@yield('page_title') </a>
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
												<option value="{{$state->id}}" {{ $state->id == $city->state_id ? 'selected' : '' }}>{{$state->state_name}}</option>
											@endforeach	

										</select>

										@error('state_id')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
									
									<div class="form-group">
										<label for="city_name" class="required">City Name:</label>
										<input type="text" name="city_name" id="city_name" class="form-control @error('city_name') form-control-error @enderror" required="required" value="{{$city->city_name}}">

										@error('city_name')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
								</div>
							</div>
						</div>

					</div> <!-- /card -->
				</div>
			</div>				
		</section>
		
	</form>
@endsection


@push('scripts')
<script type="text/javascript">
	$("#title").keyup(function(){
		var name = this.value;
		name = name.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-').toLowerCase();
		$("#slug").val(name);
	})
</script>

<script> 
	tinymce.init({
		selector: '#description',
		browser_spellcheck : true,
		paste_data_images: false,
		responsive: true,
		plugins: [
			"advlist autolink lists link image charmap print preview anchor",
			"searchreplace visualblocks code fullscreen",
			"insertdatetime media table contextmenu paste imagetools",
			"autosave codesample directionality wordcount"
		],

		toolbar: "restoredraft insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image imagetools media| fullscreen preview code | codesample charmap ltr rtl",
		content_style: 'body { font-family:Poppins",sans-serif;}',
		imagetools_toolbar: "imageoptions",

		file_picker_callback (callback, value, meta) {
		let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
		let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight

		tinymce.activeEditor.windowManager.openUrl({
			url : '/file-manager/tinymce5',
			title : 'File manager',
			width : x * 0.8,
			height : y * 0.8,
			onMessage: (api, message) => {
			callback(message.content, { text: message.text })
			}
		})
		}
	});
</script>
@endpush