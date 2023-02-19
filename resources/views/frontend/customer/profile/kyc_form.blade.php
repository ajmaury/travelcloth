<style>
    #aadhar_card,
    #passport,
    #voter_id {
        display: none;
    }
</style>
@extends('frontend.layouts.dashboard_master')
@section('page_title')
KYC
@endsection
@section('content')

<div class="dashboard__main">
    <div class="dashboard__content bg-light-2">
        <div class="row y-gap-20 justify-between items-end pb-20 lg:pb-20 md:pb-12">
            <div class="col-auto">
                <h1 class="text-30 lh-14 fw-600">Kyc Update</h1>
            </div>
            <div class="col-auto"> </div>
        </div>
        <div class="py-30 px-30 rounded-4 bg-white shadow-3">
            <div class="tabs -underline-2 js-tabs">
                @include('frontend.customer.profile.menu')
                <form action="{{ route('customer.kyc.post') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row y-gap-30 pt-50">
                        <div class="col-md-12">
                            <h4 class="pb-30">Document Type</h4>
                            <div class="row">
                                <div class="col-md-1 pt-10">
                                    <input type="radio" id="aadhar" name="kyc_type" value="Aadhar Card" required {{ old('kyc_type') ? 'checked' : ''}}>
                                </div>
                                <div class="col-md-10">
                                    <label class="text-16 fw-500" for="aadhar">Aadhar Card</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-1 pt-10">
                                    <input type="radio" id="passport1" name="kyc_type" value="Passport" required {{ old('kyc_type') ? 'checked' : ''}}>
                                </div>
                                <div class="col-md-10">
                                    <label class="text-16 fw-500" for="passport1">Passport</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1 pt-10">
                                    <input type="radio" id="pancard" name="kyc_type" value="Voter ID" required {{ old('kyc_type') ? 'checked' : ''}}>
                                </div>
                                <div class="col-md-10">
                                    <label class="text-16 fw-500" for="pancard">Voter ID</label>
                                </div>
                            </div>
                            <div class="col-auto pt-40" id="aadhar_card">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h4 class="text-16 fw-500">Front Side</h4>
                                        <div class="text-14 mt-5">PNG, JPG or PDF no bigger than 800px wide and tall.
                                        </div>
                                        <div class="d-inline-block mt-15">
                                            <label class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                                                <input type="file" name="aadhar_front" />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4 class="text-16 fw-500">Back Side</h4>
                                        <div class="text-14 mt-5">PNG, JPG or PDF no bigger than 800px wide and tall.
                                        </div>
                                        <div class="d-inline-block mt-15">
                                            <label class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                                                <input type="file" name="aadhar_back" />
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto pt-40" id="passport">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h4 class="text-16 fw-500">First Page</h4>
                                        <div class="text-14 mt-5">PNG, JPG or PDF no bigger than 800px wide and tall.
                                        </div>
                                        <div class="d-inline-block mt-15">
                                            <label class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                                                <input type="file" name="passport_1" />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4 class="text-16 fw-500">Second Page</h4>
                                        <div class="text-14 mt-5">PNG, JPG or PDF no bigger than 800px wide and tall.
                                        </div>
                                        <div class="d-inline-block mt-15">
                                            <label class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                                                <input type="file" name="passport_2" />
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto pt-40" id="voter_id">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h4 class="text-16 fw-500">Front Side</h4>
                                        <div class="text-14 mt-5">PNG, JPG or PDF no bigger than 800px wide and tall.
                                        </div>
                                        <div class="d-inline-block mt-15">
                                            <label class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                                                <input type="file" name="voterid_front" />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4 class="text-16 fw-500">Back Side</h4>
                                        <div class="text-14 mt-5">PNG, JPG or PDF no bigger than 800px wide and tall.
                                        </div>
                                        <div class="d-inline-block mt-15">
                                            <label class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                                                <input type="file" name="voterid_back" />
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
        
        if(document.getElementById('aadhar').checked){
            $("#aadhar_card").show();
            $("#passport").hide();
            $("#voter_id").hide();
        }else if(document.getElementById('passport1').checked){
            $("#aadhar_card").hide();
            $("#passport").show();
            $("#voter_id").hide();
        }else{
            $("#aadhar_card").hide();
            $("#passport").hide();
            $("#voter_id").show();
        }
    });
    
</script>
@endpush