@extends('admin.layouts.master')

@section('page_title')
    Logistic
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
    <form action="{{ route('logistic.store') }}" method="POST">
        @csrf

        <div class="page-header">
            <div class="card breadcrumb-card">
                <div class="row justify-content-between align-content-between" style="height: 100%;">
                    <div class="col-md-6">
                        <h3 class="page-title">@yield('page_title')</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('logistic.index') }}">@yield('page_title')</a></li>
                            <li class="breadcrumb-item active-breadcrumb"><a
                                    href="{{ route('logistic.create') }}">@yield('page_title')</a></li>
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
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="cname" class="required">Company Name</label>
                                    <input type="text" name="cname" id="cname" class="form-control @error('cname') form-control-error @enderror" required="required" value="{{ old('cname') }}">
                                    @error('cname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="cpname" class="required">Contact Person</label>
                                    <input type="text" name="cpname" id="cpname" class="form-control @error('cpname') form-control-error @enderror" required="required" value="{{ old('cpname') }}">
                                    @error('cpname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="cpdesignation" class="required">Contact Person Designation</label>
                                    <input type="text" name="cpdesignation" id="cpdesignation" class="form-control @error('cpdesignation') form-control-error @enderror" required="required" value="{{ old('cpdesignation') }}">
                                    @error('cpdesignation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="cpmobile" class="required">Contact Person Mobile</label>
                                    <input type="tel" name="cpmobile" id="cpmobile" class="form-control @error('cpmobile') form-control-error @enderror" required="required" value="{{ old('cpmobile') }}">
                                    @error('cpmobile')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="cpmobile" class="required">Company GST No.</label>
                                    <input type="tel" name="gstin" id="gstin" class="form-control @error('gstin') form-control-error @enderror" required="required" value="{{ old('gstin') }}">
                                    @error('gstin')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div> <!-- card-body-end -->
                    <div class="card-header">
                        <h5 class="card-title">
                            Bank Detail
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="bankname" class="required">Bank Name</label>
                                    <input type="text" name="bankname" id="bankname" class="form-control @error('bankname') form-control-error @enderror" required="required" value="{{ old('bankname') }}">
                                    @error('bankname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="accountnumber" class="required">Account Number</label>
                                    <input type="text" name="accountnumber" id="accountnumber" class="form-control @error('accountnumber') form-control-error @enderror" required="required" value="{{ old('accountnumber') }}">
                                    @error('accountnumber')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="ifsccode" class="required">IFSC Code</label>
                                    <input type="text" name="ifsccode" id="ifsccode" class="form-control @error('ifsccode') form-control-error @enderror" required="required" value="{{ old('ifsccode') }}">
                                    @error('ifsccode')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div><!-- card-end -->
            </div> <!-- col-md-4-end -->
        </div>
    </form>
@endsection
