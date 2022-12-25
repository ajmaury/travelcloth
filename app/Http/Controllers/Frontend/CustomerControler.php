<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\smsApi;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;
use Session, Validator, Auth;

class CustomerControler extends Controller
{
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
        //$this->middleware('web');
    }

    public function index()
    {
        return view('frontend.customer.signup');
    }
    public function sign_in()
    {
        //dd(Auth::guard('customer')->check());
        return view('frontend.customer.signin');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'fname' => 'required|max:50',
            'lname' => 'required|max:50',
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
            $otp_page = view('frontend.customer.register_otp')->render();
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
                $data = ['accountId'=>'TCC'.mt_rand(1000,9999)];
                $output = array_merge($session_data,$data);
                unset($output['_token']);
                unset($output['otp']);
                $output['password'] = Hash::make($session_data['password']);
                $output['account_type'] = 0;
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
    public function my_account()
    {
        return view('frontend.customer.my_account');
    }
    public function order()
    {
        return view('frontend.customer.order');
    }
    public function quote()
    {
        return view('frontend.customer.quote');
    }
    public function profile()
    {
        return view('frontend.customer.profile');
    }
    public function login_go(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|min:6|max:50', 
            ]
        );
        if($validator->fails()){
            Toastr::error($validator->errors());
            return redirect()->back();
        }else{
            if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])) {
                //dd(Auth::guard('customer')->user()->account_status);
               
                if (Auth::guard('customer')->user()->account_status == 1) {
                    Toastr::success('Welcome !');
                    return redirect()->route('customer.my_account');
                }else{
                    Auth::guard('customer')->logout();
                    Toastr::error('Your account is Deactivated by Admin!');
                    return redirect()->back();
                }
            }else{
                Toastr::error('Credentials Missmatch!');
            return redirect()->back();
            }
        }
        
    }
    public function logout(Request $request) {
        Auth::guard('customer')->logout();
        return redirect('sign-in');
    }
}
