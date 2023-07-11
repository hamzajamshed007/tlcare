<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserDetail;
use App\Models\BabySitterCertificate;
use App\Models\BabySitterDetail;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function imageFunction($image,$user_id)
    {
        if($image)
        {
            $imgExtension = date('YmdHi').'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imgExtension);

            $UserDetail = User::where('id',$user_id)->update([
                'images' => 'images/'.$imgExtension,
            ]);
            return $imgExtension;
        }
    }

    public function Registration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users',
            'user_type' => 'required'
        ]);

        if ($validator->fails()) {
            $responseArr['status'] = 0;
            $responseArr['message'] = $validator->messages()->first();
            $responseArr['access_token'] = null;
            $responseArr['user_id'] = null; 
            $responseArr['social_log'] = null;
            $responseArr['user_type'] = null;
            return response()->json($responseArr);
        }

        $access_token = Str::random(50);
        $otp = random_int(100000, 999999);

        $users = User::create([
            'email' => $request->email,
            'social_login' => "0",
            'access_token' => $access_token,
            'otp' => "123456",
            'user_type' => $request->user_type
        ]);
    
        $access_token = User::select('access_token','id','social_login','user_type')->where('id',$users->id)->first();
    
        return response()->json(
            [
                'status' => 1,
                'message' => 'Your are registered and OTP sent successfully please check your email now!',
                'access_token' => $access_token->access_token,
                'user_id' => $access_token->id,
                'social_log' => $access_token->social_login,
                'user_type' => $access_token->user_type,
            ]
        );
    }

    public function OTPVerification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'otp'   => 'required',
        ]);

        if ($validator->fails()) 
        {
            $responseArr['status'] = 0;
            $responseArr['message'] = $validator->messages()->first();
            $responseArr['access_token'] = '';
            $responseArr['user_id'] = NULL;
            $responseArr['user_type'] = NULL;
            $responseArr['user'] = NULL;
            return response()->json($responseArr);
        }
        
        $user = User::with('UserDetail','BabySitterDetail','BabySitterCertificate')->where('email',$request->email)->where('otp',$request->otp)->first();

        if($user)
        {
            if($user->user_type == 'user')
            {
                if($user->UserDetail == NULL)
                {
                    return response()->json(
                        [
                            'status' => 2,
                            'message' => 'OTP Verified successfully Please complete your details',
                            'access_token' => $user->access_token,
                            'user_id' => $user->id,
                            'user_type' => $user->user_type,
                            'user' => NULL,
                        ]
                    );
                }
                elseif($user->UserDetail != NULL)
                {
                    return response()->json(
                        [
                            'status' => 1,
                            'message' => 'OTP Verified successfully your are logging successfully',
                            'access_token' => $user->access_token,
                            'user_id' => $user->id,
                            'user_type' => $user->user_type,
                            'user' => $user,
                        ]
                    );
                }
            }
            elseif($user->user_type == 'babysitter')
            {
                if($user->BabySitterDetail == NULL && $user->BabySitterCertificate->isEmpty())
                {
                    return response()->json(
                        [
                            'status' => 2,
                            'message' => 'OTP Verified successfully Please complete your details',
                            'access_token' => $user->access_token,
                            'user_id' => $user->id,
                            'user_type' => $user->user_type,
                            'user' => NULL,
                        ]
                    );
                }
                elseif($user->BabySitterCertificate != NULL && !$user->BabySitterCertificate->isEmpty())
                {
                    return response()->json(
                        [
                            'status' => 1,
                            'message' => 'OTP Verified successfully your are logging successfully',
                            'access_token' => $user->access_token,
                            'user_id' => $user->id,
                            'user_type' => $user->user_type,
                            'user' => $user,
                        ]
                    );
                }
            }
        }
        else
        {
            return response()->json(
                [
                    'status' => 0,
                    'message' => 'User not found!',
                    'access_token' => NULL,
                    'user_id' => NULL,
                    'user_type' => NULL,
                    'user' => NULL,
                ]
            );
        }
    }

    public function Login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            $responseArr['status'] = 0;
            $responseArr['message'] = $validator->messages()->first();
            $responseArr['user_id'] = null; 
            $responseArr['social_log'] = null;
            $responseArr['user_type'] = null;
            return response()->json($responseArr);
        }

        $user = User::with('UserDetail','BabySitterDetail','BabySitterCertificate')->where('email',$request->email)->first();

        if($user)
        {
            $otp = random_int(100000, 999999);

            $update_otp = User::where('email',$request->email)->update([
                'otp' => "123456",
            ]);
            
            return response()->json(
                [
                    'status' => 1,
                    'message' => 'OTP sent successfully please check your email now!',
                    'access_token' => $user->access_token,
                    'user_id' => $user->id,
                    'social_log' => $user->social_login,
                    'user_type' => $user->user_type,
                ]
            );
        }
        else
        {
            return response()->json(
                [
                    'status' => 0,
                    'message' => 'User not found!',
                    'access_token' => NULL,
                    'user_id' => NULL,
                    'social_log' => NULL,
                    'user_type' => NULL,
                ]
            );
        }
    }

    public function UserDetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'long' => 'required',
            'image' => 'required',
        ]);

        if ($validator->fails()) 
        {
            $responseArr['status'] = 0;
            $responseArr['message'] = $validator->messages()->first();
            $responseArr['access_token'] = null; 
            $responseArr['user'] = null;
            return response()->json($responseArr);
        }

        $user = User::with('UserDetail')->where('id',$request->user_id)->first();

        if($user->UserDetail == null)
        {
            $UserDetail = UserDetail::create([
                'user_id' => $request->user_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'lat' => $request->lat,
                'long' => $request->long,
            ]);
    
            $user = User::where('id',$request->user_id)->update([
                'name' => $request->first_name . " " .$request->last_name,
            ]);
    
            if($request->image)
            {
                $imagename = $this->imageFunction($request->image,$request->user_id);
            }
    
            $user = User::with('UserDetail')->where('id', $request->user_id)->first();
    
            return response()->json(
                [
                    'status' => 1,
                    'message' => 'Profile Created Successfully',
                    'access_token' => $user->access_token,
                    'user' => $user,
                ]
            );
        }
        else
        {
            return response()->json(
                [
                    'status' => 1,
                    'message' => 'you allready completed your profile',
                    'access_token' => $user->access_token,
                    'user' => $user,
                ]
            );
        }
    } 

    public function BabySitterDetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'age' => 'required',
            'hourly_rate' => 'required',
            'lat' => 'required',
            'long' => 'required',
            'experience' => 'required',
            'description' => 'required',
            'certification' => 'required',
            'baby_sitter_id' =>'required',
            'image' => 'required'
        ]);

        if ($validator->fails()) {
            $responseArr['status'] = 0;
            $responseArr['message'] = $validator->messages()->first();
            $responseArr['access_token'] = null; 
            $responseArr['user'] = null;
            return response()->json($responseArr);
        }

        $user = User::with('BabySitterDetail','BabySitterCertificate')->where('id',$request->baby_sitter_id)->first();

        if($user->BabySitterDetail == null && $user->BabySitterCertificate->isEmpty())
        {
            if($request->hasFile('certification'))
            {
                foreach($request->file('certification') as $file)
                {
                    $certificationExtension = random_int(100000, 999999).'.'.$file->getClientOriginalExtension();
                    $file->move(public_path('certification'), $certificationExtension);
                    $BabySitterCertificate = BabySitterCertificate::create([
                        'baby_sitter_id' => $request->baby_sitter_id,
                        'certificates' => 'certification/'.$certificationExtension,
                    ]);
                    sleep(1);
                }
            }
    
            $BabySitterDetail = BabySitterDetail::create([
                'baby_sitter_id' => $request->baby_sitter_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'age' => $request->age,
                'hourly_rate' => $request->hourly_rate,
                'lat' => $request->lat,
                'long' => $request->long,
                'experience' => $request->experience,
                'description' => $request->description,
            ]);
    
            $user = User::where('id',$request->baby_sitter_id)->update([
                'name' => $request->first_name . " " .$request->last_name,
            ]);
    
            if($request->image)
            {
                $imagename = $this->imageFunction($request->image,$request->baby_sitter_id);
            }
    
            $user = User::with('BabySitterDetail','BabySitterCertificate')->where('id', $request->baby_sitter_id)->first();
    
            return response()->json(
                [
                    'status' => 1,
                    'message' => 'Profile Updated Successfully',
                    'access_token' => $user->access_token,
                    'user' => $user,
                ]
            );
        }
        else
        {
            return response()->json(
                [
                    'status' => 1,
                    'message' => 'you allready completed your profile',
                    'access_token' => $user->access_token,
                    'user' => $user,
                ]
            );
        }
        // dd($user);
    }

    public function UpdateUserDetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            $responseArr['status'] = 0;
            $responseArr['message'] = $validator->messages()->first();
            return response()->json($responseArr);
        }

        if($request->first_name)
        {
            $data['first_name']=$request->first_name;
        }
        if($request->last_name)
        {
            $data['last_name']=$request->last_name;
        }
        if($request->phone_number)
        {
            $data['phone_number']=$request->phone_number;
        }
        if($request->lat)
        {
            $data['lat']=$request->lat;
        }
        if($request->long)
        {
            $data['long']=$request->long;
        }

        $UserDetail = UserDetail::where('user_id',$request->user_id)->update($data);
        
        $user = User::where('id',$request->user_id)->update([
            'name' => $request->first_name . " " .$request->last_name,
        ]);
        
        $user = User::with('UserDetail')->where('id',$request->user_id)->first();
        
        if($request->image)
        {
            $imagename = $this->imageFunction($request->image,$request->user_id);
        }

        return response()->json(
            [
                'status' => 1,
                'message' => 'Profile Updated Successfully',
                'user' => $user,
            ]
        );
    }

    public function UpdateBabySitterDetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'baby_sitter_id' => 'required',
        ]);

        if ($validator->fails()) {
            $responseArr['status'] = 0;
            $responseArr['message'] = $validator->messages()->first();
            return response()->json($responseArr);
        }

        if($request->hasFile('certification'))
        {
            if($request->old_certificate)
            {
                $BabySitterCertificate = BabySitterCertificate::where('baby_sitter_id',$request->baby_sitter_id)->whereNotIn('certificates', $request->old_certificate)->get();
                foreach($BabySitterCertificate as $item)
                {
                    $deleteItem = $item->delete();
                }      
            }
            else
            {
                $BabySitterCertificate = BabySitterCertificate::where('baby_sitter_id',$request->baby_sitter_id)->get();
    
                foreach($BabySitterCertificate as $item)
                {
                    $deleteItem = $item->delete();
                }    
            }
            
            foreach($request->file('certification') as $file)
            {
                $certificationExtension = random_int(100000, 999999).'.'.$file->getClientOriginalExtension();
                $file->move(public_path('certification'), $certificationExtension);
                $BabySitterCertificate = BabySitterCertificate::create([
                    'baby_sitter_id' => $request->baby_sitter_id,
                    'certificates' => 'certification/'.$certificationExtension,
                ]);
                sleep(1);
            }
        }
        else
        {
            if($request->old_certificate)
            {
                $BabySitterCertificate = BabySitterCertificate::where('baby_sitter_id',$request->baby_sitter_id)->whereNotIn('certificates', $request->old_certificate)->get();
                
                foreach($BabySitterCertificate as $item)
                {
                    $deleteItem = $item->delete();
                }      
            }
        }
        if($request->first_name)
        {
            $data['first_name']=$request->first_name;
        }
        if($request->last_name)
        {
            $data['last_name']=$request->last_name;
        }
        if($request->age)
        {
            $data['age']=$request->age;
        }
        if($request->hourly_rate)
        {
            $data['hourly_rate']=$request->hourly_rate;
        }
        if($request->long)
        {
            $data['long']=$request->long;
        }
        if($request->lat)
        {
            $data['lat']=$request->lat;
        }
        if($request->experience)
        {
            $data['experience']=$request->experience;
        }
        if($request->description)
        {
            $data['description']=$request->description;
        }

        $BabySitterDetail = BabySitterDetail::where('baby_sitter_id',$request->baby_sitter_id)->update($data);

        $user = User::where('id',$request->baby_sitter_id)->update([
            'name' => $data['first_name'] . " " .$data['last_name'],
        ]);

        $user = User::with('BabySitterDetail','BabySitterCertificate')->where('id',$request->baby_sitter_id)->first();

        if($request->image)
        {
            $imagename = $this->imageFunction($request->image,$request->baby_sitter_id);
        }

        return response()->json(
            [
                'status' => 1,
                'message' => 'Profile Updated Successfully',
                'user' => $user
            ]
        );
    }
    
    public function SocialLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'user_type' => 'required'
        ]);

        if ($validator->fails()) {
            $responseArr['status'] = 0;
            $responseArr['message'] = $validator->messages()->first();
            $responseArr['access_token'] = null;
            $responseArr['user_id'] = null; 
            $responseArr['social_log'] = null;
            $responseArr['user_type'] = null;
            return response()->json($responseArr);
        }

        $user = User::where('email',$request->email)->first();

        if($user)
        {
            if($user->user_type == 'user')
            {
                if($user->UserDetail == NULL)
                {
                    return response()->json(
                        [
                            'status' => 2,
                            'message' => 'Please complete your details',
                            'access_token' => $user->access_token,
                            'user_id' => $user->id,
                            'user_type' => $user->user_type,
                            'user' => NULL,
                        ]
                    );
                }
                elseif($user->UserDetail != NULL)
                {
                    return response()->json(
                        [
                            'status' => 1,
                            'message' => 'logging successfully',
                            'access_token' => $user->access_token,
                            'user_id' => $user->id,
                            'user_type' => $user->user_type,
                            'user' => $user,
                        ]
                    );
                }
            }
            elseif($user->user_type == 'babysitter')
            {
                if($user->BabySitterDetail == NULL && $user->BabySitterCertificate->isEmpty())
                {
                    return response()->json(
                        [
                            'status' => 2,
                            'message' => 'Please complete your details',
                            'access_token' => $user->access_token,
                            'user_id' => $user->id,
                            'user_type' => $user->user_type,
                            'user' => NULL,
                        ]
                    );
                }
                elseif($user->BabySitterCertificate != NULL && !$user->BabySitterCertificate->isEmpty())
                {
                    return response()->json(
                        [
                            'status' => 1,
                            'message' => 'logging successfully',
                            'access_token' => $user->access_token,
                            'user_id' => $user->id,
                            'user_type' => $user->user_type,
                            'user' => $user,
                        ]
                    );
                }
            }
        }
        else
        {
            $access_token = Str::random(50);
            $otp = random_int(100000, 999999);
    
            $users = User::create([
                'email' => $request->email,
                'social_login' => "1",
                'access_token' => $access_token,
                'otp' => "123456",
                'user_type' => $request->user_type
            ]);
        
            if($request->image)
            {
                $imagename = $this->imageFunction($request->image,$users->user_id);
            }
    
            $access_token = User::select('access_token','id','social_login','user_type')->where('id',$users->id)->first();
    
            return response()->json(
                [
                    'status' => 1,
                    'message' => 'Please complete your details',
                    'access_token' => $access_token->access_token,
                    'user_id' => $access_token->id,
                    'social_log' => $access_token->social_login,
                    'user_type' => $access_token->user_type,
                ]
            );
        }
    }
}
// EsWTS&83!PCQ