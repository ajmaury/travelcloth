<style>
    #gst,
    #company_ic{
        display: none;
    }
</style>
@extends('frontend.layouts.hotelpartner.dashboard_master')
@section('page_title')
KYC
@endsection
@section('content')

<div class="dashboard__main">
    <div class="dashboard__content bg-light-2">
        <div class="row y-gap-20 justify-between items-end pb-20 lg:pb-20 md:pb-12">
            <div class="col-auto">
                <h1 class="text-30 lh-14 fw-600">Kyc </h1>
            </div>
            <div class="col-auto"> </div>
        </div>
        <div class="py-30 px-30 rounded-4 bg-white shadow-3">
            <div class="tabs -underline-2 js-tabs">
                @include('frontend.hotelpartner.profile.menu')
                <form action="{{ route('hotelpartner.kyc.post') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row y-gap-30 pt-50">
                        <div class="col-md-12">
                            <h4 class="pb-30">Document Type</h4>
                            <div class="row">
                                <div class="col-md-1 pt-10">
                                    <input type="radio" id="gst_certificate" name="kyc_type" value="GST Certificate" required {{ old('kyc_type') ? 'checked' : ''}}>
                                </div>
                                <div class="col-md-10">
                                    <label class="text-16 fw-500" for="gst_certificate">GST Certificate</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1 pt-10">
                                    <input type="radio" id="company_inco_certificate" name="kyc_type" value="Company Incorporation Certificate" required {{ old('kyc_type') ? 'checked' : ''}}>
                                </div>
                                <div class="col-md-10">
                                    <label class="text-16 fw-500" for="company_inco_certificate">Company Incorporation Certificate</label>
                                </div>
                            </div>
                            <div class="col-auto pt-40" id="gst">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h4 class="text-16 fw-500">GST Certificate</h4>
                                        <div class="text-14 mt-5">PNG, JPG or PDF no bigger than 800px wide and tall.
                                        </div>
                                        <div class="d-inline-block mt-15">
                                            <label class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                                                <input type="file" name="gst_certificate" />
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto pt-40" id="company_ic">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h4 class="text-16 fw-500">Company Incorporation Certificate</h4>
                                        <div class="text-14 mt-5">PNG, JPG or PDF no bigger than 800px wide and tall.
                                        </div>
                                        <div class="d-inline-block mt-15">
                                            <label class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                                                <input type="file" name="c_incorporation" />
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="border-top-light mt-30 mb-0"></div>

                            <div class="d-inline-block pt-30">
                                <button type="submit" class="button h-50 px-24 -dark-1 bg-blue-1 text-white">Save
                                    Changes
                                    <div class="icon-arrow-top-right ml-15"></div>
                                </button>
                            </div>
                        </div>
                    </div>

                </form>
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
    $("input[name='kyc_type']").on("change", function(){
        
        if(document.getElementById('gst_certificate').checked){
            $("#gst").show();
            $("#company_ic").hide();
        }else{
            $("#gst").hide();
            $("#company_ic").show();
        }
    });
    
</script>
@endpush