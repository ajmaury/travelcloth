<div class="modal-header">
    <h4 class="modal-title">Partner Agent Information</h4>
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-sm-3">
            <img src="{{ url('/storage/customer_profile/'.$partneragent->image) }}" alt="image" id="display_img" style="max-height: 135px !important;
                            position: inherit;" class="img-ratio rounded-4"
                onerror="this.src='{{ asset('assets/fronted/img/dummy.png') }}';">
        </div>
        <div class="col-sm-9">
            <p> <strong>Partner Agent ID - </strong> {{ $partneragent->accountId }}</p>
            <p> <strong>Name - </strong> {{ $partneragent->fname." ".$partneragent->lname }}</p>
            <p> <strong>Mobile - </strong> {{ $partneragent->mobile }}
                @if ($partneragent->mobile_verification_status)
                <span
                    style="color: #fff;background-color: green;font-size: 11px;padding: 5px 10px;border-radius: 20px;">Verified</span>
                @else
                <span
                    style="color: #fff;background-color: red;font-size: 11px;padding: 5px 10px;border-radius: 20px;">Pending</span>
                @endif
            </p>
            <p> <strong>Email - </strong> {{ $partneragent->email }}</p>
            <p> <strong>Company Name - </strong> {{ $partneragent->companyName }}</p>

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
                <td>{{ $partneragent->country }}</td>
                <th>State</th>
                <td>{{ $partneragent->state }} </td>
            </tr>
            <tr>
                <th>City</th>
                <td>{{ $partneragent->city }}</td>
                <th>Pincode</th>
                <td>{{ $partneragent->pincode_id }}</td>
            </tr>
            <tr>
                <th>Address Line 1</th>
                <td>{{ $partneragent->address_line1 }}</td>
                <th>Address Line 2</th>
                <td>{{ $partneragent->address_line2 }}</td>
            </tr>

        </tbody>
    </table>
    @if (trim($partneragent->kyc_status) !="" AND trim($partneragent->kyc_status) != NULL)
    <div class="row">
        <div class="col-sm-12">
            <h4 style="padding-top: 20px;">Kyc Detail - 
                <input type="hidden" value="{{ $partneragent->id }}" id="customerid">
                <span id="kycoption">
                    @if ($partneragent->kyc_status != 1)
                    <select id="change_kyc_status">
                        @foreach ($kyc_status as $kyc_sta)
                        <option value="{{ $kyc_sta->status_code }}" {{ $partneragent->kyc_status == $kyc_sta->status_code ? 'selected':'' }}>{{$kyc_sta->status_name  }}</option>
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
                <td>{{ $partneragent->kyc_type }}</td>
                <th>Kyc Status</th>
                <td id="kyc_status_output">
                    @if ($partneragent->kyc_status== 1)
                    @php
                        $status_style = 'background-color: rgba(53,84,209,.05);border-radius: 20px;color: #0baae2;padding:4px 10px;'
                    @endphp
                    @elseif($partneragent->kyc_status==2)
                    @php
                        $status_style = 'background-color: #fff5f8;border-radius: 20px;color: #f1416c;padding:4px 10px;'
                    @endphp
                    @else
                    @php
                        $status_style = 'background-color: #fff8dd;border-radius: 20px;color: #ffc700;padding:4px 10px;'
                    @endphp
                    @endif
                    @foreach ($kyc_status as $kyc_sta)
                        @if ($partneragent->kyc_status== $kyc_sta->status_code)
                        <span style="{{ $status_style }}">{{ $kyc_sta->status_name }}</span>
                        @endif
                    @endforeach
                    
                </td>
            </tr>
        </tbody>
    </table>
    @isset($kyc->gst_certificate)
    <div class="row" style="margin-top: 50px;">
        <div class="col-sm-12">
            <div class="col-auto">
                <!--gst_certificate-->
                @if (pathinfo($kyc->gst_certificate, PATHINFO_EXTENSION) == "pdf")
                <iframe style="width: 100%;min-height: 400px !important;"
                    src="{{ url('/storage/gst_certificate/'.$kyc->gst_certificate) }}"></iframe>
                @else
                <img src="{{ url('/storage/gst_certificate/'.$kyc->gst_certificate) }}" style="max-width:320px">
                @endif
                <!--End gst_certificate-->
            </div>
        </div>
    </div>
    @endisset
    @isset($kyc->c_incorporation)
    <div class="row" style="margin-top: 50px;">
        <div class="col-sm-12">
            <div class="col-auto">
                <!--c_incorporation-->
                @if (pathinfo($kyc->c_incorporation, PATHINFO_EXTENSION) == "pdf")
                <iframe style="width: 100%;min-height: 400px !important;"
                    src="{{ url('/storage/c_incorporation/'.$kyc->c_incorporation) }}"></iframe>
                @else
                <img src="{{ url('/storage/c_incorporation/'.$kyc->c_incorporation) }}" style="max-width:320px">
                @endif
                <!--End c_incorporation-->
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
                    @isset($kyclist->gst_certificate)
                    <!--gst_certificate-->
                    @if (pathinfo($kyclist->gst_certificate, PATHINFO_EXTENSION) == "pdf")
                    <iframe style="width: 100%;min-height: 400px !important;"
                        src="{{ url('/storage/gst_certificate/'.$kyclist->gst_certificate) }}"></iframe>
                    @else
                    <img src="{{ url('/storage/gst_certificate/'.$kyclist->gst_certificate) }}" style="max-width:320px">
                    @endif
                    <!--End gst_certificate-->
                    @endisset
                    @isset($kyclist->c_incorporation)
                    <!--c_incorporation-->
                    @if (pathinfo($kyclist->c_incorporation, PATHINFO_EXTENSION) == "pdf")
                    <iframe style="width: 100%;min-height: 400px !important;"
                        src="{{ url('/storage/c_incorporation/'.$kyclist->c_incorporation) }}"></iframe>
                    @else
                    <img src="{{ url('/storage/c_incorporation/'.$kyclist->c_incorporation) }}" style="max-width:320px">
                    @endif
                    <!--End c_incorporation-->
                    @endisset
                    
                    </div>
                </td>
                <td></td>
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
            url: `{{ route('partneragent.change_kyc_status') }}`,
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