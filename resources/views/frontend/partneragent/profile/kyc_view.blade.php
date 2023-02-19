@extends('frontend.layouts.partneragent.dashboard_master')
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
                @include('frontend.partneragent.profile.menu')
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
                @isset($kyc->gst_certificate)
                <div class="row mt-50">
                    <div class="col-sm-6">
                        <div class="col-auto">
                            <!--voterid_front-->
                            @if (pathinfo($kyc->gst_certificate, PATHINFO_EXTENSION) == "pdf")
                            <iframe style="width: 100%;min-height: 400px !important;"
                                src="{{ url('/storage/gst_certificate/'.$kyc->gst_certificate) }}"></iframe>
                            @else
                            <div class="d-flex ratio ratio-1:1" style="max-height: 345px;">
                                <img src="{{ url('/storage/gst_certificate/'.$kyc->gst_certificate) }}" style="max-height: 400px !important;
                                    position: inherit;" class="img-ratio rounded-4">
                            </div>
                            @endif
                            <!--End voterid_front-->
                        </div>
                    </div>
                </div>
                @endisset
                @isset($kyc->c_incorporation)
                <div class="row mt-50">
                    <div class="col-sm-6">
                        <div class="col-auto">
                            <!--voterid_front-->
                            @if (pathinfo($kyc->c_incorporation, PATHINFO_EXTENSION) == "pdf")
                            <iframe style="width: 100%;min-height: 400px !important;"
                                src="{{ url('/storage/c_incorporation/'.$kyc->c_incorporation) }}"></iframe>
                            @else
                            <div class="d-flex ratio ratio-1:1" style="max-height: 345px;">
                                <img src="{{ url('/storage/c_incorporation/'.$kyc->c_incorporation) }}" style="max-height: 400px !important;
                                    position: inherit;" class="img-ratio rounded-4">
                            </div>
                            @endif
                            <!--End voterid_front-->
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
    url: '{{ route('partneragent.verifyno') }}',
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
        url: '{{ route('partneragent.verify_kyc_mobile_otp') }}',
        method: 'post',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(res){
            console.log(res);
            if($.isEmptyObject(res.error)){
                toastr.success(res.message);
                location.href = "{{ route('partneragent.kyc.update') }}";
            }else{
                toastr.error(res.error['otp']);
            }
        }
      });
    });
});
</script>
@endpush