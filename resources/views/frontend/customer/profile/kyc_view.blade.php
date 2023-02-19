@extends('frontend.layouts.dashboard_master')
@section('page_title')
KYC
@endsection
@section('content')

<div class="dashboard__main">
    <div class="dashboard__content bg-light-2">
        <div class="row y-gap-20 justify-between items-end pb-20 lg:pb-20 md:pb-12">
            <div class="col-auto">
                <h1 class="text-30 lh-14 fw-600">KYC View</h1>
            </div>
            <div class="col-auto"> </div>
        </div>
        <div class="py-30 px-30 rounded-4 bg-white shadow-3">
            <div class="tabs -underline-2 js-tabs">
                @include('frontend.customer.profile.menu')
                <div class="row mt-50">
                    <div class="col-sm-12">
                        <table class="table-3 -border-bottom col-12">
                            <thead>
                                <tr>
                                    <td style="border-right: 1px solid lightgray;"><h5>Document Type - <span style="font-weight: 100;font-size: 15px;">{{ $kyc->customer->kyc_type }}</span></h5></td>
                                    <td><h5>Kyc Status - 
                                        @if ($kyc->customer->kyc_status== 1)
                                        @php
                                            $status_style = 'background-color: rgba(53,84,209,.05);border-radius: 20px;color: #0baae2;padding:4px 10px;'
                                        @endphp
                                        @elseif($kyc->customer->kyc_status==2)
                                        @php
                                            $status_style = 'background-color: #fff5f8;border-radius: 20px;color: #f1416c;padding:4px 10px;'
                                        @endphp
                                        @else
                                        @php
                                            $status_style = 'background-color: #fff8dd;border-radius: 20px;color: #ffc700;padding:4px 10px;'
                                        @endphp
                                        @endif
                                        @foreach ($kyc_status as $kyc_sta)
                                            @if ($kyc->customer->kyc_status== $kyc_sta->status_code)
                                            <span style="{{ $status_style }}">{{ $kyc_sta->status_name }}</span>
                                            @endif
                                        @endforeach
                                        
                                    </h5></td>
                                </tr>
                                </thead>
                        </table>
                    </div>
                </div>
                @isset($kyc->aadhar_front,$kyc->aadhar_back)
                <div class="row mt-50">
                    <div class="col-sm-6">
                        <div class="col-auto">
                            <!--Aadhar front-->
                            @if (pathinfo($kyc->aadhar_front, PATHINFO_EXTENSION) == "pdf")
                            <iframe style="width: 100%;min-height: 400px !important;"
                                src="{{ url('/storage/aadhar_front/'.$kyc->aadhar_front) }}"></iframe>
                            @else
                            <div class="d-flex ratio ratio-1:1" style="max-height: 345px;">
                                <img src="{{ url('/storage/aadhar_front/'.$kyc->aadhar_front) }}" style="max-height: 400px !important;
                                    position: inherit;" class="img-ratio rounded-4">
                            </div>
                            @endif
                            <!--End Aadhar front-->
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="col-auto">
                            <!--Aadhar back-->
                            @if (pathinfo($kyc->aadhar_back, PATHINFO_EXTENSION) == "pdf")
                            <iframe style="width: 100%;min-height: 400px !important;"
                                src="{{ url('/storage/aadhar_back/'.$kyc->aadhar_back) }}"></iframe>
                            @else
                            <div class="d-flex ratio ratio-1:1" style="max-height: 345px;">
                                <img src="{{ url('/storage/aadhar_back/'.$kyc->aadhar_back) }}" style="max-height: 400px !important;
                                    position: inherit;" class="img-ratio rounded-4">
                            </div>
                            @endif
                            <!--End Aadhar back-->
                        </div>
                    </div>
                </div>
                @endisset
                @isset($kyc->passport_1,$kyc->passport_2)
                <div class="row mt-50">
                    <div class="col-sm-6">
                        <div class="col-auto">
                            <!--passport_1-->
                            @if (pathinfo($kyc->passport_1, PATHINFO_EXTENSION) == "pdf")
                            <iframe style="width: 100%;min-height: 400px !important;"
                                src="{{ url('/storage/passport_1/'.$kyc->passport_1) }}"></iframe>
                            @else
                            <div class="d-flex ratio ratio-1:1" style="max-height: 345px;">
                                <img src="{{ url('/storage/passport_1/'.$kyc->passport_1) }}" style="max-height: 400px !important;
                                    position: inherit;" class="img-ratio rounded-4">
                            </div>
                            @endif
                            <!--End passport_1-->
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="col-auto">
                            <!--passport_2-->
                            @if (pathinfo($kyc->passport_2, PATHINFO_EXTENSION) == "pdf")
                            <iframe style="width: 100%;min-height: 400px !important;"
                                src="{{ url('/storage/passport_2/'.$kyc->passport_2) }}"></iframe>
                            @else
                            <div class="d-flex ratio ratio-1:1" style="max-height: 345px;">
                                <img src="{{ url('/storage/passport_2/'.$kyc->passport_2) }}" style="max-height: 400px !important;
                                    position: inherit;" class="img-ratio rounded-4">
                            </div>
                            @endif
                            <!--End passport_2-->
                        </div>
                    </div>
                </div>
                @endisset
                @isset($kyc->voterid_front,$kyc->voterid_back)
                <div class="row mt-50">
                    <div class="col-sm-6">
                        <div class="col-auto">
                            <!--voterid_front-->
                            @if (pathinfo($kyc->voterid_front, PATHINFO_EXTENSION) == "pdf")
                            <iframe style="width: 100%;min-height: 400px !important;"
                                src="{{ url('/storage/voterid_front/'.$kyc->voterid_front) }}"></iframe>
                            @else
                            <div class="d-flex ratio ratio-1:1" style="max-height: 345px;">
                                <img src="{{ url('/storage/voterid_front/'.$kyc->voterid_front) }}" style="max-height: 400px !important;
                                    position: inherit;" class="img-ratio rounded-4">
                            </div>
                            @endif
                            <!--End voterid_front-->
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="col-auto">
                            <!--voterid_back-->
                            @if (pathinfo($kyc->voterid_back, PATHINFO_EXTENSION) == "pdf")
                            <iframe style="width: 100%;min-height: 400px !important;"
                                src="{{ url('/storage/voterid_back/'.$kyc->voterid_back) }}"></iframe>
                            @else
                            <div class="d-flex ratio ratio-1:1" style="max-height: 345px;">
                                <img src="{{ url('/storage/voterid_back/'.$kyc->voterid_back) }}" style="max-height: 400px !important;
                                    position: inherit;" class="img-ratio rounded-4">
                            </div>
                            @endif
                            <!--End voterid_back-->
                        </div>
                    </div>
                </div>
                @endisset
                
                @if ($kyc->customer->kyc_status == 1 OR $kyc->customer->kyc_status == 2)
                <div class="border-top-light mt-30 mb-0"></div>
                <form method="POST" action="#" id="verifymobileotp">
                    @csrf
                    <div class="row pt-30">
                        <div class="col-sm-12 kyc_update_output" style="display: flex;">
                            <a href="javascript:void(0)" class="kyc_update button h-50 px-24 -dark-1 bg-blue-1 text-white" style="width: 232px;
                            margin: auto;">Update Kyc Document
                                <div class="icon-arrow-top-right ml-15"></div>
                            </a>
                        </div>
                    </div>
                </form>
                @endif
            </div>
        </div>
        <footer class="footer -dashboard mt-60">
            <div class="footer__row row y-gap-10 items-center justify-between">
                <div class="col-auto">
                    <div class="row y-gap-20 items-center">
                        <div class="col-auto">
                            <div class="text-14 lh-14 mr-30">© 2022 Travel Cloth All rights reserved.</div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection
@push('scripts')
<script>

$(document).delegate(".kyc_update", "click", function(e) {
    e.preventDefault();
    $.ajax({
    url: '{{ route('customer.verifyno') }}',
    dataType: 'json',
    success: function(res){
        $(".kyc_update_output").html(res);
    }
    });
});
$(function(){
    $("#verifymobileotp").submit(function(e){
      e.preventDefault();
      $.ajax({
        url: '{{ route('customer.verify_kyc_mobile_otp') }}',
        method: 'post',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(res){
            console.log(res);
            if($.isEmptyObject(res.error)){
                toastr.success(res.message);
                location.href = "{{ route('customer.kyc.update') }}";
            }else{
                toastr.error(res.error['otp']);
            }
        }
      });
    });
});
</script>
@endpush