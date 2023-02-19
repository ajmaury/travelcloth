@extends('admin.layouts.master')

@section('page_title')
    User
@endsection

@push('css')
    <style>
        #output {
            height: 300px;
            width: 300px;
        }
    </style>
@endpush

@section('content')
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="page-header">
            <div class="card breadcrumb-card">
                <div class="row justify-content-between align-content-between" style="height: 100%;">
                    <div class="col-md-6">
                        <h3 class="page-title">@yield('page_title')</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('users.index') }}">@yield('page_title')</a></li>
                            <li class="breadcrumb-item active-breadcrumb"><a
                                    href="{{ route('users.create') }}">@yield('page_title')</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <div class="create-btn pull-right">
                            <button type="submit"
                                class="btn custom-create-btn">Save</button>
                        </div>
                    </div>
                </div>
            </div><!-- /card finish -->	
        </div><!-- /Page Header -->


        <div class="card-body">

            <div class="row">
                <div class="col-md-4 col-sm-12" style="margin: auto;">
                    <div class="input-group mb-5">
                        <img src="" alt="..." id="output" class="img-thumbnail rounded mx-auto d-block mb-3" onerror="this.src='{{ asset('assets/admin/img/default-user.png') }}';">
                        <input type="file" accept="image/*" id="image1" class="form-control" name="image" onchange="loadFileImageFront(event)">
                    </div>
                </div>
            </div>  <!-- /row end -->

            <div class="row">

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                Personal Information
                            </h5>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="name" class="required">Name:</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') form-control-error @enderror" required="required" value="{{ old('name') }}">

                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="mobile" class="required">Mobile:</label>
                                <input type="number" name="mobile" id="mobile" class="form-control @error('mobile') form-control-error @enderror"  required="required" value="{{ old('mobile') }}">

                                @error('mobile')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> <!-- card-body-end -->
                    </div><!-- card-end -->
                </div> <!-- col-md-4-end -->

                <div class="col-md-4">
                    <div class="card">
                        <h5 class="card-header">
                            Authentication
                        </h5>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="email" class="required">Email:</label>
                                <input type="email" name="email" id="email" class="form-control @error('email') form-control-error @enderror" required="required" value="{{ old('email') }}">

                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password" class="required">Password:</label>
                                <input type="password" name="password" id="password" class="form-control @error('password') form-control-error @enderror" required="required">

                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="required">Confirm Password:</label>
                                <input type="password" name="confirm-password" id="password-confirm" class="form-control @error('password-confirm') form-control-error @enderror" required="required">

                                @error('confirm-password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> <!-- card-body-end -->
                    </div> <!-- card-end -->
                </div> <!-- col-md-4-end -->

                <div class="col-md-4">
                    <div class="card">
                        <h5 class="card-header">
                            Role & Permission
                        </h5>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="roles" class="required">Role</label>
                                <select name="roles[]" id="roles" class="select2" multiple="multiple">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>

                                @error('roles')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> <!-- card-body-end -->
                    </div> <!-- card-end -->
                </div> <!-- col-md-4-end -->

            </div> <!-- row-end -->

        </div> <!-- card-body-end -->

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
