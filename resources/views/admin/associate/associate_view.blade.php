<div class="modal-header">
    <h4 class="modal-title">Associate Information</h4>
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-sm-3">
            <img src="{{ url('/storage/customer_profile/'.$associate->image) }}" alt="image" id="display_img" style="max-height: 135px !important;max-width:170px !important;
                            position: inherit;" class="img-ratio rounded-4"
                onerror="this.src='{{ asset('assets/fronted/img/dummy.png') }}';">
        </div>
        <div class="col-sm-9">
            <p> <strong>Associate ID - </strong> {{ $associate->accountId }}</p>
            <p> <strong>Name - </strong> {{ $associate->fname." ".$associate->lname }}</p>
            <p> <strong>Mobile - </strong> {{ $associate->mobile }}
                @if ($associate->mobile_verification_status)
                <span
                    style="color: #fff;background-color: green;font-size: 11px;padding: 5px 10px;border-radius: 20px;">Verified</span>
                @else
                <span
                    style="color: #fff;background-color: red;font-size: 11px;padding: 5px 10px;border-radius: 20px;">Pending</span>
                @endif
            </p>
            <p> <strong>Email - </strong> {{ $associate->email }}</p>

        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h4>Address - </h4>
        </div>
    </div>
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>Country</th>
                <td>{{ $associate->country }}</td>
                <th>State</th>
                <td>{{ $associate->state }} </td>
            </tr>
            <tr>
                <th>City</th>
                <td>{{ $associate->city }}</td>
                <th>Pincode</th>
                <td>{{ $associate->pincode_id }}</td>
            </tr>
            <tr>
                <th>Address Line 1</th>
                <td>{{ $associate->address_line1 }}</td>
                <th>Address Line 2</th>
                <td>{{ $associate->address_line2 }}</td>
            </tr>

        </tbody>
    </table>
    
    @if (trim($associate->kyc_status) !="" AND trim($associate->kyc_status) != NULL)
    <div class="row">
        <div class="col-sm-12">
            <h4 style="padding-top: 20px;">Kyc Detail - 
                <input type="hidden" value="{{ $associate->id }}" id="customerid">
                <span id="kycoption">
                    @if ($associate->kyc_status != 1)
                    <select id="change_kyc_status">
                        @foreach ($kyc_status as $kyc_sta)
                        <option value="{{ $kyc_sta->status_code }}" {{ $associate->kyc_status == $kyc_sta->status_code ? 'selected':'' }}>{{$kyc_sta->status_name  }}</option>
                        @endforeach
                    </select>
                    @endif
                </span>
            </h4>
        </div>
    </div>
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>Document Type</th>
                <td>{{ $associate->kyc_type }}</td>
                <th>Kyc Status</th>
                <td id="kyc_status_output">
                    @if ($associate->kyc_status== 1)
                    @php
                        $status_style = 'background-color: rgba(53,84,209,.05);border-radius: 20px;color: #0baae2;padding:4px 10px;'
                    @endphp
                    @elseif($associate->kyc_status==2)
                    @php
                        $status_style = 'background-color: #fff5f8;border-radius: 20px;color: #f1416c;padding:4px 10px;'
                    @endphp
                    @else
                    @php
                        $status_style = 'background-color: #fff8dd;border-radius: 20px;color: #ffc700;padding:4px 10px;'
                    @endphp
                    @endif
                    @foreach ($kyc_status as $kyc_sta)
                        @if ($associate->kyc_status== $kyc_sta->status_code)
                        <span style="{{ $status_style }}">{{ $kyc_sta->status_name }}</span>
                        @endif
                    @endforeach
                    
                </td>
            </tr>
        </tbody>
    </table>
    @isset($kyc->aadhar_front,$kyc->aadhar_back)
    <div class="row" style="margin-top: 50px;">
        <div class="col-sm-6">
            <div class="col-auto">
                <!--Aadhar front-->
                @if (pathinfo($kyc->aadhar_front, PATHINFO_EXTENSION) == "pdf")
                <iframe style="width: 100%;min-height: 400px !important;"
                    src="{{ url('/storage/aadhar_front/'.$kyc->aadhar_front) }}"></iframe>
                @else
                <img src="{{ url('/storage/aadhar_front/'.$kyc->aadhar_front) }}" style="max-width:320px">
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
                <img src="{{ url('/storage/aadhar_back/'.$kyc->aadhar_back) }}" style="max-width:320px">
                @endif
                <!--End Aadhar back-->
            </div>
        </div>
    </div>
    @endisset
    @isset($kyc->passport_1,$kyc->passport_2)
    <div class="row" style="margin-top: 50px;">
        <div class="col-sm-6">
            <div class="col-auto">
                <!--passport_1-->
                @if (pathinfo($kyc->passport_1, PATHINFO_EXTENSION) == "pdf")
                <iframe style="width: 100%;min-height: 400px !important;"
                    src="{{ url('/storage/passport_1/'.$kyc->passport_1) }}"></iframe>
                @else
                <img src="{{ url('/storage/passport_1/'.$kyc->passport_1) }}" style="max-width:320px">
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
                <img src="{{ url('/storage/passport_2/'.$kyc->passport_2) }}" style="max-width:320px">
                @endif
                <!--End passport_2-->
            </div>
        </div>
    </div>
    @endisset
    @isset($kyc->voterid_front,$kyc->voterid_back)
    <div class="row" style="margin-top: 50px;">
        <div class="col-sm-6">
            <div class="col-auto">
                <!--voterid_front-->
                @if (pathinfo($kyc->voterid_front, PATHINFO_EXTENSION) == "pdf")
                <iframe style="width: 100%;min-height: 400px !important;"
                    src="{{ url('/storage/voterid_front/'.$kyc->voterid_front) }}"></iframe>
                @else
                <img src="{{ url('/storage/voterid_front/'.$kyc->voterid_front) }}" style="max-width:320px">
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
                <img src="{{ url('/storage/voterid_back/'.$kyc->voterid_back) }}" style="max-width:320px">
                @endif
                <!--End voterid_back-->
            </div>
        </div>
    </div>
    @endisset
    @if(!$allkyc->isEmpty())
    <div class="row">
        <div class="col-sm-12">
            <h4 style="padding-top: 20px;">Kyc History - </h4>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Document Type</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($allkyc as $key=>$kyclist)
            <tr data-toggle="collapse" data-target=".order{{ $key }}">
                <td>{{ $kyclist->kyc_type }}</td>
                <td>{{ $kyclist->updated_at }}</td>
            </tr>
            <tr class="collapse order{{ $key }}">
                <td>
                    <div class="col-auto">
                    @isset($kyclist->aadhar_front)
                    <!--Aadhar front-->
                    @if (pathinfo($kyclist->aadhar_front, PATHINFO_EXTENSION) == "pdf")
                    <iframe style="width: 100%;min-height: 400px !important;"
                        src="{{ url('/storage/aadhar_front/'.$kyclist->aadhar_front) }}"></iframe>
                    @else
                    <img src="{{ url('/storage/aadhar_front/'.$kyclist->aadhar_front) }}" style="max-width:320px">
                    @endif
                    <!--End Aadhar front-->
                    @endisset
                    @isset($kyclist->passport_1)
                    <!--passport_1-->
                    @if (pathinfo($kyclist->passport_1, PATHINFO_EXTENSION) == "pdf")
                    <iframe style="width: 100%;min-height: 400px !important;"
                        src="{{ url('/storage/passport_1/'.$kyclist->passport_1) }}"></iframe>
                    @else
                    <img src="{{ url('/storage/passport_1/'.$kyclist->passport_1) }}" style="max-width:320px">
                    @endif
                    <!--End passport_1-->
                    @endisset
                    @isset($kyclist->voterid_front)
                    <!--voterid_front-->
                    @if (pathinfo($kyclist->voterid_front, PATHINFO_EXTENSION) == "pdf")
                    <iframe style="width: 100%;min-height: 400px !important;"
                        src="{{ url('/storage/voterid_front/'.$kyclist->voterid_front) }}"></iframe>
                    @else
                    <img src="{{ url('/storage/voterid_front/'.$kyclist->voterid_front) }}" style="max-width:320px">
                    @endif
                    <!--End voterid_front-->
                    @endisset
                    </div>
                </td>
                <td>
                    <div class="col-auto">
                    @isset($kyclist->aadhar_back)
                    <!--Aadhar back-->
                    @if (pathinfo($kyclist->aadhar_back, PATHINFO_EXTENSION) == "pdf")
                    <iframe style="width: 100%;min-height: 400px !important;"
                        src="{{ url('/storage/aadhar_back/'.$kyclist->aadhar_back) }}"></iframe>
                    @else
                    <img src="{{ url('/storage/aadhar_back/'.$kyclist->aadhar_back) }}" style="max-width:320px">
                    @endif
                    <!--End Aadhar back-->
                    @endisset
                    @isset($kyclist->passport_2)
                    <!--passport_2-->
                    @if (pathinfo($kyclist->passport_2, PATHINFO_EXTENSION) == "pdf")
                    <iframe style="width: 100%;min-height: 400px !important;"
                        src="{{ url('/storage/passport_2/'.$kyclist->passport_2) }}"></iframe>
                    @else
                    <img src="{{ url('/storage/passport_2/'.$kyclist->passport_2) }}" style="max-width:320px">
                    @endif
                    <!--End passport_2-->
                    @endisset
                    @isset($kyclist->voterid_back)
                    <!--voterid_back-->
                    @if (pathinfo($kyclist->voterid_back, PATHINFO_EXTENSION) == "pdf")
                    <iframe style="width: 100%;min-height: 400px !important;"
                        src="{{ url('/storage/voterid_back/'.$kyclist->voterid_back) }}"></iframe>
                    @else
                    <img src="{{ url('/storage/voterid_back/'.$kyclist->voterid_back) }}" style="max-width:320px">
                    @endif
                    <!--End voterid_back-->
                    @endisset
                    </div>
                </td>
            </tr>
            @endforeach            
        </tbody>
    </table>
    @endif
    @endif
</div>
<style>
    tr.collapse.in {
        display: table-row;
    }
    select:has(option[selected][value="0"]) {
        background-color: #fff8dd;border-radius: 20px;color: #ffc700;padding:4px 10px;font-size: 18px;
    }
    select:has(option[selected][value="1"]) {
        background-color: rgba(53,84,209,.05);border-radius: 20px;color: #0baae2;padding:4px 10px;font-size: 18px;
    }
    select:has(option[selected][value="2"]) {
        background-color: #fff5f8;border-radius: 20px;color: #f1416c;padding:4px 10px;font-size: 18px;
    }
</style>
<script>
    $(document).delegate("#change_kyc_status", "change", function(e) {
        e.preventDefault();
        var status = $("#change_kyc_status").val();
        var id = $("#customerid").val();
        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: `{{ route('associate.change_kyc_status') }}`,
            type: 'GET',
            data: {
                _token: _token,
                id: id,
                status: status
            },
            success: function(result) {
                $("#kyc_status_output").html(result.kycstatus);
                $("#kycoption").html(result.kycoption);
                if(status == 1){
                    toastr.success(result.message);
                }else{
                    toastr.error(result.message);
                } 
            }
        });
    });
</script>