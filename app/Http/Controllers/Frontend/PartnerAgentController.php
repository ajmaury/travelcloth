<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\{Customer, Country, State, City,Kyc,Kyc_status};
use App\Models\smsApi;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;
use Session, Validator, Auth;
use App\Models\FileManagement;

class PartnerAgentController extends Controller
{
    public function my_account()
    {
        return view('frontend.partneragent.my_account');
    }
    public function order()
    {
        return view('frontend.partneragent.order');
    }
    public function refer()
    {
        return view('frontend.partneragent.refer');
    }
    public function add_refer()
    {
        return view('frontend.partneragent.add_refer');
    }
    public function profile()
    {
        $customer = Customer::find(Auth::guard('partneragent')->user()->id);
        return view('frontend.partneragent.profile.personal', compact('customer'));
    }
    public function address()
    {
        $customer = Customer::find(Auth::guard('partneragent')->user()->id);
        $countrys = Country::all();
        if (isset($customer->state_id)) {
            $states = State::where('id', $customer->state_id)->get();
        } else {
            $states = [];
        }

        return view('frontend.partneragent.profile.address', compact('customer', 'countrys', 'states'));
    }
    public function kyc()
    {
        if(trim(Auth::guard('partneragent')->user()->kyc_status) =="" OR trim(Auth::guard('partneragent')->user()->kyc_status) == NULL){
            return view('frontend.partneragent.profile.kyc_form');
        }else{
            $kyc_status = Kyc_status::get();
            $kyc = Kyc::with('customer')->where(['kyc.active_status'=>1,'kyc.customer_id'=>Auth::guard('partneragent')->user()->id])->first();
            return view('frontend.partneragent.profile.kyc_view', compact('kyc','kyc_status'));
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
            return redirect()->route('partneragent.profile');
        } else {
            $input = ['fname' => $request->input('fname'), 'lname' => $request->input('lname'),'hotelName'=>$request->input('hotelName')];
            $id = Auth::guard('partneragent')->user()->id;
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
            return redirect()->route('partneragent.profile');
        }
    }
    public function deleteImage()
    {
        $id = Auth::guard('partneragent')->user()->id;
        $customer = Customer::find($id);
        $image_path = public_path('storage/customer_profile/' . $customer->image);
        if (File::exists($image_path)) {
            File::delete($image_path);
            $input['image'] = NULL;
            $customer->update($input);
            Toastr::success('File deleted successfully');
            return redirect()->route('partneragent.profile');
        } else {
            Toastr::success('File deleted successfully');
            return redirect()->route('partneragent.profile');
        }
    }
    public function deleteKycDoc()
    {
        $id = Auth::guard('partneragent')->user()->id;
        $customer = Customer::find($id);
        $image_path = public_path('storage/customer_kyc/' . $customer->kyc_document);
        if (File::exists($image_path)) {
            File::delete($image_path);
            $input['kyc_document'] = NULL;
            $customer->update($input);
            Toastr::success('File deleted successfully');
            return redirect()->route('partneragent.kyc');
        } else {
            Toastr::success('File deleted successfully');
            return redirect()->route('partneragent.kyc');
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
            return redirect()->route('partneragent.address');
        } else {
            $input = $request->all();
            $id = Auth::guard('partneragent')->user()->id;
            $customer = Customer::find($id);
            $customer->update($input);
            Toastr::success('Updated Successfully');
            return redirect()->route('partneragent.address');
        }
    }
    public function postkyc(Request $request)
    {
        $id = Auth::guard('partneragent')->user()->id;
        $customer = Customer::find($id);
        if ($request->input('kyc_type')) {
            $input = ['kyc_type' => $request->input('kyc_type'),'kyc_status'=>0];
            $kyc = ['customer_id'=>$id,'kyc_type' => $request->input('kyc_type')];
            if($request->input('kyc_type') == 'GST Certificate'){
                if ($request->hasFile('gst_certificate')) {
                    $gst_certificate = $request->file('gst_certificate');
                    if ($gst_certificate->extension() == 'pdf') {
                        $destination = 'gst_certificate';
                        $fileName = $destination . time() . rand(1, 100) . '.' . $gst_certificate->extension();
                        $gst_certificate->move(storage_path('app/public/' . $destination), $fileName);
                        $kyc['gst_certificate'] = $fileName;
                    } else {
                        $kyc['gst_certificate'] = FileManagement::upload_single_file($request, 'gst_certificate', 'gst_certificate', 'no', '', '');
                    }
                    Kyc::insert($kyc);
                    $customer->update($input);
                    Toastr::success('Updated Successfully');
                    return redirect()->route('partneragent.kyc');
                } else {
                    Toastr::error('Please Select GST Certificate.');
                    return redirect()->route('partneragent.kyc');
                }
            }else{
                if ($request->hasFile('c_incorporation')) {
                    $c_incorporation = $request->file('c_incorporation');
                    if ($c_incorporation->extension() == 'pdf') {
                        $destination = 'c_incorporation';
                        $fileName = $destination . time() . rand(1, 100) . '.' . $c_incorporation->extension();
                        $c_incorporation->move(storage_path('app/public/' . $destination), $fileName);
                        $kyc['c_incorporation'] = $fileName;
                    } else {
                        $kyc['c_incorporation'] = FileManagement::upload_single_file($request, 'c_incorporation', 'c_incorporation', 'no', '', '');
                    }
                    Kyc::insert($kyc);
                    $customer->update($input);
                    Toastr::success('Updated Successfully');
                    return redirect()->route('partneragent.kyc');
                } else {
                    Toastr::error('Please Select Company Incorporation Certificate.');
                    return redirect()->route('partneragent.kyc');
                }
            }
            
        } else {
            Toastr::error('Please Select Document Type');
            return redirect()->route('partneragent.kyc');
        }
    }
    public function changemobile()
    {
        $id = Auth::guard('partneragent')->user()->id;
        $customer = Customer::find($id);
        return view('frontend.partneragent.profile.changemobile.index', compact('customer'));
    }
    public function verifyno()
    {
        $mobile = Auth::guard('partneragent')->user()->mobile;
        $otp_page = view('frontend.partneragent.profile.verifynumber')->render();
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
                $id = Auth::guard('partneragent')->user()->id;
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
            return view('frontend.partneragent.profile.kyc_update');
        }else{
            Toastr::error('not Allow');
            return redirect()->route('partneragent.kyc');
        }
    }
    public function postkycupdate(Request $request)
    {
        if(Session::get('otp')){
            $id = Auth::guard('partneragent')->user()->id;
            $customer = Customer::find($id);
            $kyc_detail = Kyc::where(['customer_id'=>$id,'active_status'=>1])->first();
            if ($request->input('kyc_type')) {
                $input = ['kyc_type' => $request->input('kyc_type'),'kyc_status'=>0];
                $kyc = ['customer_id'=>$id,'kyc_type' => $request->input('kyc_type')];
                if($request->input('kyc_type') == 'GST Certificate'){
                    if ($request->hasFile('gst_certificate')) {
                        $gst_certificate = $request->file('gst_certificate');
                        if ($gst_certificate->extension() == 'pdf') {
                            $destination = 'gst_certificate';
                            $fileName = $destination . time() . rand(1, 100) . '.' . $gst_certificate->extension();
                            $gst_certificate->move(storage_path('app/public/' . $destination), $fileName);
                            $kyc['gst_certificate'] = $fileName;
                        } else {
                            $kyc['gst_certificate'] = FileManagement::upload_single_file($request, 'gst_certificate', 'gst_certificate', 'no', '', '');
                        }
                        $kyc_detail->update(['active_status'=>0]);
                        Kyc::insert($kyc);
                        $customer->update($input);
                        session()->forget(['otp']);
                        Toastr::success('Updated Successfully');
                        return redirect()->route('partneragent.kyc');
                    } else {
                        Toastr::error('Please Select GST Certificate.');
                        return redirect()->route('partneragent.kyc.update');
                    }
                }else{
                    if ($request->hasFile('c_incorporation')) {
                        $c_incorporation = $request->file('c_incorporation');
                        if ($c_incorporation->extension() == 'pdf') {
                            $destination = 'c_incorporation';
                            $fileName = $destination . time() . rand(1, 100) . '.' . $c_incorporation->extension();
                            $c_incorporation->move(storage_path('app/public/' . $destination), $fileName);
                            $kyc['c_incorporation'] = $fileName;
                        } else {
                            $kyc['c_incorporation'] = FileManagement::upload_single_file($request, 'c_incorporation', 'c_incorporation', 'no', '', '');
                        }
                        $kyc_detail->update(['active_status'=>0]);
                        Kyc::insert($kyc);
                        $customer->update($input);
                        session()->forget(['otp']);
                        Toastr::success('Updated Successfully');
                        return redirect()->route('partneragent.kyc');
                    } else {
                        Toastr::error('Please Select Company Incorporation Certificate.');
                        return redirect()->route('partneragent.kyc.update');
                    }
                }
            } else {
                Toastr::error('Please Select Document Type');
                return redirect()->route('partneragent.kyc.update');
            }
        }else{
            Toastr::error('not Allow');
            return redirect()->route('partneragent.kyc.update');
        }
    }
}
