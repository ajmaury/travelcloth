@extends('admin.layouts.master')

@section('page_title')
    Price
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
    <form action="{{ route('price.insert') }}" method="POST">
        @csrf
        <div class="page-header">
            <div class="card breadcrumb-card">
                <div class="row justify-content-between align-content-between" style="height: 100%;">
                    <div class="col-md-6">
                        <h3 class="page-title">@yield('page_title')</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('price.index') }}">@yield('page_title')</a></li>
                            <li class="breadcrumb-item active-breadcrumb">Create</li>
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
                            Price Information
                        </h5>
                    </div>

                    <div class="card-body" style="overflow: unset">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="from" class="required">From</label>
                                    <select name="from" id="from" class="select2">
                                        <option value="">Select</option>
                                        <option value="1">True</option>
                                        <option value="0">False</option>
                                    </select>
                                    @error('from')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="to" class="required">To</label>
                                    <select name="to" id="to" class="select2">
                                        <option value="">Select</option>
                                        <option value="1">True</option>
                                        <option value="0">False</option>
                                    </select>
                                    @error('to')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="services" class="required">Service Type</label>
                                    <select name="services" id="services" class="select2">
                                        <option value="">Select</option>
                                        <option value="1">Standard</option>
                                        <option value="2">Express</option>
                                        <option value="3">Super Express</option>
                                    </select>
                                    @error('services')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="amount" class="required">Amount</label>
                                    <input type="tel" name="amount" id="amount" class="form-control @error('amount') form-control-error @enderror" required="required" value="{{ old('amount') }}">
                                    @error('amount')
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
