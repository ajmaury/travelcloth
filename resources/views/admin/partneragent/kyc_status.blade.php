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