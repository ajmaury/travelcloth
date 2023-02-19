<?php
namespace App\Http\Controllers\Frontend\HotelPartnerAuth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\smsApi;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;
use Session, Validator, Auth;

class HotelPartnerRegistrationController extends Controller
{
    public function index()
    {
        return view('frontend.hotelpartner.signup');
    }   
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'fname' => 'required|max:50',
            'lname' => 'required|max:50',
            'hotelName' => 'required',
            'email' => 'required|email|unique:customers',
            'mobile' => 'required|numeric|unique:customers',
            'password' => 'required|min:6|max:50', 
            ]
        );
        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()
            ]);
        }else{
            $request['otp'] = mt_rand(1000,9999);
            Session::put('userdata', $request->input());
            $otp=Session::get('userdata')['otp'];
            $sms = new smsApi();
            $sms->registerApi($request->mobile,$otp);
            $otp_page = view('frontend.hotelpartner.register_otp')->render();
            return response()->json([
                'status' => 200,
                'message' => $otp_page
            ]);
        }
    }
    public function verify_otp(Request $request)
    {
        $validator1 = Validator::make($request->all(),[
            'otp' => 'required|numeric'
            ]
        );
        if($validator1->fails()){
            return response()->json([
                'status' => 400,
                'error' => $validator1->errors()
            ]);
        }else{
            $session_data=Session::get('userdata');
            if($request->otp == $session_data['otp']){
                $data = ['accountId'=>'TCH'.mt_rand(1000,9999)];
                $output = array_merge($session_data,$data);
                unset($output['_token']);
                unset($output['otp']);
                $output['password'] = Hash::make($session_data['password']);
                $output['account_type'] = 3;
                Customer::insert($output);
                Session::forget('userdata');
                return response()->json([
                    'status' => 200,
                    'message' => 'Registered Successfully...'
                ]);
            }else{
                return response()->json([
                    'status' => 400,
                    'error' => ['otp'=>'OTP does not match']
                ]);
            }
        }
    }
    public function resend_otp()
    {
        Session::put('userdata.otp', mt_rand(1000,9999));
        $session_data=Session::get('userdata');
        $sms = new smsApi();
        $res = $sms->registerApi($session_data['mobile'],$session_data['otp']);
        if($res = 200){
            return response()->json([
                'status' => 200,
                'message' => 'OTP Sent Successfully'
            ]);
        }else{
            return response()->json([
                'status' => 400,
                'error' => ['otp'=>'OTP not Sent']
            ]);
        }
    }    
}
