@if ($partneragent->kyc_status != 1)
<select id="change_kyc_status">
    @foreach ($kyc_status as $kyc_sta)
    <option value="{{ $kyc_sta->status_code }}" {{ $partneragent->kyc_status == $kyc_sta->status_code ? 'selected':'' }}>{{$kyc_sta->status_name  }}</option>
    @endforeach
</select>
@endif