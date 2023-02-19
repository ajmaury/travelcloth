<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\{Customer, Country, State, City,Kyc,Kyc_status,Quote};
use App\Models\smsApi;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;
use Session, Validator, Auth;
use App\Models\FileManagement;

class CustomerControler extends Controller
{
    public function index()
    {
        return view('frontend.customer.signup');
    }
    public function sign_in()
    {
        return view('frontend.customer.signin');
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
        $customer = Auth::guard('customer')->user()->id;
        $quotes = Quote::latest()->where('user_id',$customer)->paginate(1);
        return view('frontend.customer.quote',compact('quotes'));
    }
    public function profile()
    {
        $customer = Customer::find(Auth::guard('customer')->user()->id);
        return view('frontend.customer.profile.personal', compact('customer'));
    }
    public function address()
    {
        $customer = Customer::find(Auth::guard('customer')->user()->id);
        $countrys = Country::all();
        if (isset($customer->state_id)) {
            $states = State::where('id', $customer->state_id)->get();
        } else {
            $states = [];
        }

        return view('frontend.customer.profile.address', compact('customer', 'countrys', 'states'));
    }
    public function kyc()
    {
        if(trim(Auth::guard('customer')->user()->kyc_status) =="" OR trim(Auth::guard('customer')->user()->kyc_status) == NULL){
            return view('frontend.customer.profile.kyc_form');
        }else{
            $kyc_status = Kyc_status::get();
            $kyc = Kyc::with('customer')->where(['kyc.active_status'=>1,'kyc.customer_id'=>Auth::guard('customer')->user()->id])->first();
           // dd($kyc);
            return view('frontend.customer.profile.kyc_view', compact('kyc','kyc_status'));
        }
    }
    
    public function postProfile(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'fname' => 'required',
                'lname' => 'required',
                'file' => 'max:10000|mimes:png,jpg,jpeg,JPG'
            ],
            [],
            [
                'fname' => 'First Name',
                'lname' => 'Last Name',
            ]
        );
        if ($validator->fails()) {
            Toastr::error($validator->errors());
            return redirect()->route('customer.profile');
        } else {
            $input = ['fname' => $request->input('fname'), 'lname' => $request->input('lname')];
            $id = Auth::guard('customer')->user()->id;
            $customer = Customer::find($id);
            //    dd($request->all());
            if ($request->hasFile('pro_img')) {
                $image_path = public_path('storage/customer_profile/' . $customer->image);
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
                $input['image'] = FileManagement::upload_single_file($request, 'pro_img', 'customer_profile', 'yes', '200', '');
            } else {
                $input['image'] = $customer->image;
            }
            // dd($input);
            $customer->update($input);
            Toastr::success('Updated Successfully');
            return redirect()->route('customer.profile');
        }
    }
    public function deleteImage()
    {
        $id = Auth::guard('customer')->user()->id;
        $customer = Customer::find($id);
        $image_path = public_path('storage/customer_profile/' . $customer->image);
        if (File::exists($image_path)) {
            File::delete($image_path);
            $input['image'] = NULL;
            $customer->update($input);
            Toastr::success('File deleted successfully');
            return redirect()->route('customer.profile');
        } else {
            Toastr::success('File deleted successfully');
            return redirect()->route('customer.profile');
        }
    }
    public function deleteKycDoc()
    {
        $id = Auth::guard('customer')->user()->id;
        $customer = Customer::find($id);
        $image_path = public_path('storage/customer_kyc/' . $customer->kyc_document);
        if (File::exists($image_path)) {
            File::delete($image_path);
            $input['kyc_document'] = NULL;
            $customer->update($input);
            Toastr::success('File deleted successfully');
            return redirect()->route('customer.kyc');
        } else {
            Toastr::success('File deleted successfully');
            return redirect()->route('customer.kyc');
        }
    }
    public function getstate(Request $request)
    {
        $data['states'] = State::where("country_id", $request->country_id)->get(["state_name", "id"]);
        return response()->json($data);
    }
    public function getcity(Request $request)
    {
        $data['citys'] = City::where("state_id", $request->state_id)->get(["city_name", "id"]);
        return response()->json($data);
    }
    public function postAddress(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'address_line1' => 'required',
                'address_line2' => 'required',
                'country_id' => 'required',
                'state_id' => 'required',
                'city_id' => 'required',
                'pincode_id' => 'required',
            ],
            [],
            [
                'address_line1' => 'Address Line1',
                'address_line2' => 'Address Line2',
                'country_id' => 'Country',
                'state_id' => 'State',
                'city_id' => 'City',
                'pincode_id' => 'Pin Code',
            ]
        );
        if ($validator->fails()) {
            Toastr::error($validator->errors());
            return redirect()->route('customer.address');
        } else {
            $input = $request->all();
            $id = Auth::guard('customer')->user()->id;
            $customer = Customer::find($id);
            $customer->update($input);
            Toastr::success('Updated Successfully');
            return redirect()->route('customer.address');
        }
    }
    public function postkyc(Request $request)
    {
        $id = Auth::guard('customer')->user()->id;
        $customer = Customer::find($id);
        if ($request->input('kyc_type')) {
            $input = ['kyc_type' => $request->input('kyc_type'),'kyc_status'=>0];
            $kyc = ['customer_id'=>$id,'kyc_type' => $request->input('kyc_type')];
            if($request->input('kyc_type') == 'Aadhar Card'){
                if ($request->hasFile('aadhar_front') AND $request->hasFile('aadhar_back')) {
                    $aadhar_front = $request->file('aadhar_front');
                    $aadhar_back = $request->file('aadhar_back');
                    if ($aadhar_front->extension() == 'pdf') {
                        $destination = 'aadhar_front';
                        $fileName = $destination . time() . rand(1, 100) . '.' . $aadhar_front->extension();
                        $aadhar_front->move(storage_path('app/public/' . $destination), $fileName);
                        $kyc['aadhar_front'] = $fileName;
                    } else {
                        $kyc['aadhar_front'] = FileManagement::upload_single_file($request, 'aadhar_front', 'aadhar_front', 'no', '', '');
                    }
                    if ($aadhar_back->extension() == 'pdf') {
                        $destination = 'aadhar_back';
                        $fileName = $destination . time() . rand(1, 100) . '.' . $aadhar_back->extension();
                        $aadhar_back->move(storage_path('app/public/' . $destination), $fileName);
                        $kyc['aadhar_back'] = $fileName;
                    } else {
                        $kyc['aadhar_back'] = FileManagement::upload_single_file($request, 'aadhar_back', 'aadhar_back', 'no', '', '');
                    }
                    Kyc::insert($kyc);
                    $customer->update($input);
                    Toastr::success('Updated Successfully');
                    return redirect()->route('customer.kyc');
                } else {
                    Toastr::error('Please Select Aadhar front and back both side.');
                    return redirect()->route('customer.kyc');
                }
            }elseif($request->input('kyc_type') == 'Passport'){
                if ($request->hasFile('passport_1') AND $request->hasFile('passport_2')) {
                    $passport_1 = $request->file('passport_1');
                    $passport_2 = $request->file('passport_2');
                    if ($passport_1->extension() == 'pdf') {
                        $destination = 'passport_1';
                        $fileName = $destination . time() . rand(1, 100) . '.' . $passport_1->extension();
                        $passport_1->move(storage_path('app/public/' . $destination), $fileName);
                        $kyc['passport_1'] = $fileName;
                    } else {
                        $kyc['passport_1'] = FileManagement::upload_single_file($request, 'passport_1', 'passport_1', 'no', '', '');
                    }
                    if ($passport_2->extension() == 'pdf') {
                        $destination = 'passport_2';
                        $fileName = $destination . time() . rand(1, 100) . '.' . $passport_2->extension();
                        $passport_2->move(storage_path('app/public/' . $destination), $fileName);
                        $kyc['passport_2'] = $fileName;
                    } else {
                        $kyc['passport_2'] = FileManagement::upload_single_file($request, 'passport_2', 'passport_2', 'no', '', '');
                    }
                    Kyc::insert($kyc);
                    $customer->update($input);
                    Toastr::success('Updated Successfully');
                    return redirect()->route('customer.kyc');
                } else {
                    Toastr::error('Please Select passport first page and second page both.');
                    return redirect()->route('customer.kyc');
                }
            }else{
                if ($request->hasFile('voterid_front') AND $request->hasFile('voterid_back')) {
                    $voterid_front = $request->file('voterid_front');
                    $voterid_back = $request->file('voterid_back');
                    if ($voterid_front->extension() == 'pdf') {
                        $destination = 'voterid_front';
                        $fileName = $destination . time() . rand(1, 100) . '.' . $voterid_front->extension();
                        $voterid_front->move(storage_path('app/public/' . $destination), $fileName);
                        $kyc['voterid_front'] = $fileName;
                    } else {
                        $kyc['voterid_front'] = FileManagement::upload_single_file($request, 'voterid_front', 'voterid_front', 'no', '', '');
                    }
                    if ($voterid_back->extension() == 'pdf') {
                        $destination = 'voterid_back';
                        $fileName = $destination . time() . rand(1, 100) . '.' . $voterid_back->extension();
                        $voterid_back->move(storage_path('app/public/' . $destination), $fileName);
                        $kyc['voterid_back'] = $fileName;
                    } else {
                        $kyc['voterid_back'] = FileManagement::upload_single_file($request, 'voterid_back', 'voterid_back', 'no', '', '');
                    }
                    Kyc::insert($kyc);
                    $customer->update($input);
                    Toastr::success('Updated Successfully');
                    return redirect()->route('customer.kyc');
                } else {
                    Toastr::error('Please Select Voter ID front and back both side.');
                    return redirect()->route('customer.kyc');
                }
            }
            
        } else {
            Toastr::error('Please Select Document Type');
            return redirect()->route('customer.kyc');
        }
    }
    public function changemobile()
    {
        $id = Auth::guard('customer')->user()->id;
        $customer = Customer::find($id);
        return view('frontend.customer.profile.changemobile.index',compact('customer'));
    }
    public function verifyno()
    {
        $mobile = Auth::guard('customer')->user()->mobile;
        $otp_page = view('frontend.customer.profile.verifynumber')->render();
        $otpgenerate = mt_rand(1000,9999);
        Session::put('otp', $otpgenerate);
        $otp=Session::get('otp');
        $sms = new smsApi();
        $sms->registerApi($mobile,$otp);
        return response()->json($otp_page);
    }
    public function verifymobileotp(Request $request)
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
            $session_otp=Session::get('otp');
            if($request->input('otp') == $session_otp){
                $id = Auth::guard('customer')->user()->id;
                $customer = Customer::find($id);
                $data = ['mobile_verification_status'=>1];
                $customer->update($data);
                session()->forget(['otp']);
                return response()->json([
                    'status' => 200,
                    'message' => "Mobile Number successfully verified ..."
                ]);
            }else{
                return response()->json([
                    'status' => 400,
                    'error' => ['otp'=>'OTP does not match']
                ]);
            }
        }
    }
    public function verify_kyc_mobile_otp(Request $request)
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
            $session_otp=Session::get('otp');
            if($request->input('otp') == $session_otp){
                return response()->json([
                    'status' => 200,
                    'message' => "Mobile Number successfully verified ..."
                ]);
            }else{
                return response()->json([
                    'status' => 400,
                    'error' => ['otp'=>'OTP does not match']
                ]);
            }
        }
    }
    public function kyc_update()
    {
        if(Session::get('otp')){
            return view('frontend.customer.profile.kyc_update');
        }else{
            Toastr::error('not Allow');
            return redirect()->route('customer.kyc');
        }
    }
    public function postkycupdate(Request $request)
    {
        if(Session::get('otp')){
            $id = Auth::guard('customer')->user()->id;
            $customer = Customer::find($id);
            $kyc_detail = Kyc::where(['customer_id'=>$id,'active_status'=>1])->first();
            if ($request->input('kyc_type')) {
                $input = ['kyc_type' => $request->input('kyc_type'),'kyc_status'=>0];
                $kyc = ['customer_id'=>$id,'kyc_type' => $request->input('kyc_type')];
                if($request->input('kyc_type') == 'Aadhar Card'){
                    if ($request->hasFile('aadhar_front') AND $request->hasFile('aadhar_back')) {
                        $aadhar_front = $request->file('aadhar_front');
                        $aadhar_back = $request->file('aadhar_back');
                        if ($aadhar_front->extension() == 'pdf') {
                            $destination = 'aadhar_front';
                            $fileName = $destination . time() . rand(1, 100) . '.' . $aadhar_front->extension();
                            $aadhar_front->move(storage_path('app/public/' . $destination), $fileName);
                            $kyc['aadhar_front'] = $fileName;
                        } else {
                            $kyc['aadhar_front'] = FileManagement::upload_single_file($request, 'aadhar_front', 'aadhar_front', 'no', '', '');
                        }
                        if ($aadhar_back->extension() == 'pdf') {
                            $destination = 'aadhar_back';
                            $fileName = $destination . time() . rand(1, 100) . '.' . $aadhar_back->extension();
                            $aadhar_back->move(storage_path('app/public/' . $destination), $fileName);
                            $kyc['aadhar_back'] = $fileName;
                        } else {
                            $kyc['aadhar_back'] = FileManagement::upload_single_file($request, 'aadhar_back', 'aadhar_back', 'no', '', '');
                        }
                        $kyc_detail->update(['active_status'=>0]);
                        Kyc::insert($kyc);
                        $customer->update($input);
                        session()->forget(['otp']);
                        Toastr::success('Updated Successfully');
                        return redirect()->route('customer.kyc');
                    } else {
                        Toastr::error('Please Select Aadhar front and back both side.');
                        return redirect()->route('customer.kyc.update');
                    }
                }elseif($request->input('kyc_type') == 'Passport'){
                    if ($request->hasFile('passport_1') AND $request->hasFile('passport_2')) {
                        $passport_1 = $request->file('passport_1');
                        $passport_2 = $request->file('passport_2');
                        if ($passport_1->extension() == 'pdf') {
                            $destination = 'passport_1';
                            $fileName = $destination . time() . rand(1, 100) . '.' . $passport_1->extension();
                            $passport_1->move(storage_path('app/public/' . $destination), $fileName);
                            $kyc['passport_1'] = $fileName;
                        } else {
                            $kyc['passport_1'] = FileManagement::upload_single_file($request, 'passport_1', 'passport_1', 'no', '', '');
                        }
                        if ($passport_2->extension() == 'pdf') {
                            $destination = 'passport_2';
                            $fileName = $destination . time() . rand(1, 100) . '.' . $passport_2->extension();
                            $passport_2->move(storage_path('app/public/' . $destination), $fileName);
                            $kyc['passport_2'] = $fileName;
                        } else {
                            $kyc['passport_2'] = FileManagement::upload_single_file($request, 'passport_2', 'passport_2', 'no', '', '');
                        }
                        $kyc_detail->update(['active_status'=>0]);
                        Kyc::insert($kyc);
                        $customer->update($input);
                        session()->forget(['otp']);
                        Toastr::success('Updated Successfully');
                        return redirect()->route('customer.kyc');
                    } else {
                        Toastr::error('Please Select passport first page and second page both.');
                        return redirect()->route('customer.kyc.update');
                    }
                }else{
                    if ($request->hasFile('voterid_front') AND $request->hasFile('voterid_back')) {
                        $voterid_front = $request->file('voterid_front');
                        $voterid_back = $request->file('voterid_back');
                        if ($voterid_front->extension() == 'pdf') {
                            $destination = 'voterid_front';
                            $fileName = $destination . time() . rand(1, 100) . '.' . $voterid_front->extension();
                            $voterid_front->move(storage_path('app/public/' . $destination), $fileName);
                            $kyc['voterid_front'] = $fileName;
                        } else {
                            $kyc['voterid_front'] = FileManagement::upload_single_file($request, 'voterid_front', 'voterid_front', 'no', '', '');
                        }
                        if ($voterid_back->extension() == 'pdf') {
                            $destination = 'voterid_back';
                            $fileName = $destination . time() . rand(1, 100) . '.' . $voterid_back->extension();
                            $voterid_back->move(storage_path('app/public/' . $destination), $fileName);
                            $kyc['voterid_back'] = $fileName;
                        } else {
                            $kyc['voterid_back'] = FileManagement::upload_single_file($request, 'voterid_back', 'voterid_back', 'no', '', '');
                        }
                        $kyc_detail->update(['active_status'=>0]);
                        Kyc::insert($kyc);
                        $customer->update($input);
                        session()->forget(['otp']);
                        Toastr::success('Updated Successfully');
                        return redirect()->route('customer.kyc');
                    } else {
                        Toastr::error('Please Select Voter ID front and back both side.');
                        return redirect()->route('customer.kyc.update');
                    }
                }
                
            } else {
                Toastr::error('Please Select Document Type');
                return redirect()->route('customer.kyc');
            }
        }else{
            Toastr::error('not Allow');
            return redirect()->route('customer.kyc');
        }
    }
}
