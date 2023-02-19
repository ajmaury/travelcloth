<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Quote,City};
use Brian2694\Toastr\Facades\Toastr;
use Validator; 
use Session;
use Auth;
class QuoteController extends Controller
{
    function quote_gen(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:50',
            'pickup_destination' => 'required|max:50',
            'pickup_pincode' => 'required',
            'drop_destination' => 'required',
            'drop_pincode' => 'required',
            'no_of_bag' => 'required',
            'mobile' => 'required|numeric',
        ],[],
        [
            'name' => 'Name',
            'pickup_destination' => 'Pickup Destination',
            'pickup_pincode' => 'Pickup Pincode',
            'drop_destination' => 'Drop Destination',
            'drop_pincode' => 'Drop Pincode',
            'no_of_bag' => 'No. Of Bag',
            'mobile' => 'Mobile',
        ]
        );
        if($validator->fails()){
            Toastr::error($validator->errors());
		    return redirect()->route('quote');
        }else{
            $input = request()->all();
            if($input['pickup_destination'] == $input['drop_destination'] AND $input['pickup_pincode'] == $input['drop_pincode']){
                Toastr::error('Pickup and Drop Destination should be not same..<br>Pickup and Drop Pincode should be not same');
		        return redirect()->route('quote');
            }elseif($input['pickup_pincode'] == $input['drop_pincode']){
                Toastr::error('Pickup and Drop Pincode should be not same');
		        return redirect()->route('quote');
            }elseif($input['pickup_destination'] == $input['drop_destination']){
                Toastr::error('Pickup and Drop Destination should be not same..');
		        return redirect()->route('quote');
            }else{
                $input['total'] = $input['no_of_bag']*20*75;
                $input['tax'] = $input['total']*18/100;
                $input['grand_total'] = $input['total']+$input['tax'];
                if(Auth::guard('customer')->user()){
                    $input['user_id'] = Auth::guard('customer')->user()->id;
                    $input['account_type'] = 0;
                }elseif(Auth::guard('associate')->user())
                {
                    $input['user_id'] = Auth::guard('associate')->user()->id;
                    $input['account_type'] = 4;
                }elseif(Auth::guard('partneragent')->user())
                {
                    $input['user_id'] = Auth::guard('partneragent')->user()->id;
                    $input['account_type'] = 2;
                }elseif(Auth::guard('hotelpartner')->user())
                {
                    $input['user_id'] = Auth::guard('hotelpartner')->user()->id;
                    $input['account_type'] = 3;
                }else{
                    $input['account_type'] = 5;
                }
                unset($input['_token']);
                Quote::insert($input);
                Session::flash('quote',$input);
                return redirect()->route('quote_result');
            }
            //Toastr::success('Created Successfully');
		    //return redirect()->route('quote');
        }
    }
    public function quote_result()
    {
        $quote = Session::get('quote');
        if($quote){
            $pickup_destination = City::find($quote['pickup_destination'])->city_name;
            $drop_destination = City::find($quote['drop_destination'])->city_name;
            return view('frontend.quote_result',compact('quote','pickup_destination','drop_destination'));
        }else{
            return redirect()->route('quote');
        }
    }
}
