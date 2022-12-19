<?php
namespace App\Http\Controllers\Frontend;
use App\Models\Customer;
use App\Models\smsApi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
use Session;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }
    public function index()
    {
        return view('frontend.employee.signup');
    }
    public function sign_in()
    {
        return view('frontend.employee.signin');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'fname' => 'required|max:50',
            'lname' => 'required|max:50',
            'employeeId' => 'required',
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
            $otp_page = view('frontend.employee.register_otp')->render();
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
                $data = ['accountId'=>'TCE'.mt_rand(1000,9999)];
                $output = array_merge($session_data,$data);
                unset($output['_token']);
                unset($output['otp']);
                $output['password'] = Hash::make($session_data['password']);
                $output['account_type'] = 1;
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
        return view('frontend.employee.my_account');
    }
    public function order()
    {
        return view('frontend.employee.order');
    }
    public function quote()
    {
        return view('frontend.employee.quote');
    }
    public function profile()
    {
        return view('frontend.employee.profile');
    }
}
