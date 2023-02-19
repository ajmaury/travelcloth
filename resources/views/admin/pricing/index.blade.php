@extends('admin.layouts.master')

@section('page_title')
Prices
@endsection


@section('content')
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
                    <li class="breadcrumb-item active-breadcrumb">
                        <a href="{{ route('price.index') }}">@yield('page_title')</a>
                    </li>
                </ul>
            </div>
            @if (Gate::check('pricing-create'))
            <div class="col-md-3">
                <div class="create-btn pull-right">
                    <a href="{{ route('price.create') }}" class="btn custom-create-btn"><i class="fa fa-plus"></i>
                        Add</a>
                </div>
            </div>
            @endif
        </div>
    </div><!-- /card finish -->
</div><!-- /Page Header -->

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-hover table-center mb-0">
                    <thead>
                        <tr>
                            <th>Service Type</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($prices as $price)
                        <tr>
                            <td> 
                                @if ($price->services == 1)
                                Standard
                                @elseif ($price->services == 2)
                                Express
                                @else
                                Super Express
                                @endif 
                            </td>
                            <td>{{ $price->from == 1 ? 'True':'False' }}</td>
                            <td>{{ $price->to == 1 ? 'True':'False' }}</td>
                            <td>₹ {{ $price->amount }}</td>
                            <td>
                                <a href="{{ route('price.edit', 'id='.$price->id) }}" class="custom-edit-btn mr-1">
                                    <i class="fe fe-pencil"></i> Edit
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>
</div>
@endsection

