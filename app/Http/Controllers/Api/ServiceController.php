<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\TimeSchedules;
use App\Models\Childrens;
use App\Models\User;
use App\Models\Applicants;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\AllServicesForBabySitter;

class ServiceController extends Controller
{
    public function AddService(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'service_name' => 'required',
            'child_name' => 'required',
            'child_age' => 'required',
            'description' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'schedule' => 'required',
        ]);

        if ($validator->fails()) {
            $responseArr['status'] = 0;
            $responseArr['message'] = $validator->messages()->first();
            return response()->json($responseArr);
        }

        $Services = Services::create([
            'user_id' => $request->user_id,
            'status' => 'pending',
            'service_name' => $request->service_name,
            'description' => $request->description
        ]);

        $child_name = $request->child_name;
        $child_age = $request->child_age;
        $rowCount = count($request->child_name);

        for($i = 0; $i < $rowCount; $i++)
        {
            $Childrens = Childrens::create([
                'service_id' => $Services->id,
                'user_id' => $request->user_id,
                'child_name' => $child_name[$i],
                'child_age' => $child_age[$i],
            ]);
        }

        $date = $request->date;
        $start_time = $request->start_time;
        $end_time = $request->end_time;
        $rowCountDate = count($request->date);

        for($i = 0; $i < $rowCountDate; $i++)
        {
            $TimeSchedules = TimeSchedules::create([
                'service_id' => $Services->id,
                'user_id' => $request->user_id,
                'date' => $date[$i],
                'start_time' => $start_time[$i],
                'end_time' => $end_time[$i],
                'schedule' => $request->schedule,
            ]);
        }

        return response()->json([
            'status' => 1,
            'message' => 'service add successfully'
        ]);
    }
    
    public function GetAllServices(Request $request)
    {
        if($request->user_id)
        {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
            ]);

            if ($validator->fails()) {
                $responseArr['status'] = 0;
                $responseArr['message'] = $validator->messages()->first();
                $responseArr['services'] = NULL;
                return response()->json($responseArr);
            }

            $Services = Services::select('id','user_id','service_name','status','description','created_at')->where('user_id',$request->user_id)->with(
                [
                    'User.UserDetail' => function($query)
                    {
                        $query->select('user_id','phone_number','lat','long');
                    },
                    'User' => function($query)
                    {
                        $query->select('id','name','images');
                    },
                    'Children' => function($query)
                    {
                        $query->select('service_id','child_name','child_age');
                    },
                    'TimeSchedules' => function($query)
                    {
                        $query->select('service_id','date','start_time','end_time','schedule');
                    }
                ]
            )->get();
    
            return response()->json([
                'status' => 1,
                'message' => 'you get services successfully',
                'services' => AllServicesForBabySitter::collection($Services)
            ]); 
        }
        else if($request->baby_sitter_id)
        {
            $validator = Validator::make($request->all(), [
                'baby_sitter_id' => 'required',
            ]);

            if ($validator->fails()) {
                $responseArr['status'] = 0;
                $responseArr['message'] = $validator->messages()->first();
                $responseArr['services'] = NULL;
                return response()->json($responseArr);
            }
            
            $Services = Services::select('id','user_id','service_name','status','description','created_at')->where('status','pending')->with(
                [
                    'User.UserDetail' => function($query)
                    {
                        $query->select('user_id','phone_number','lat','long');
                    },
                    'User' => function($query)
                    {
                        $query->select('id','name','images');
                    },
                    'Children' => function($query)
                    {
                        $query->select('service_id','child_name','child_age');
                    },
                    'TimeSchedules' => function($query)
                    {
                        $query->select('service_id','date','start_time','end_time','schedule');
                    },
                    'Applicants' => function($query)
                    {
                        $query->select('service_id','baby_sitter_id','user_id','message','status');
                    }
                    
                ]
            )->get();
            
            return response()->json([
                'status' => 1,
                'message' => 'you get services successfully',
                'services' => AllServicesForBabySitter::collection($Services),
            ]);
        }
        else
        {
            return response()->json([
                'status' => 0,
                'message' => 'Please give user_id or baby_sitter_id to get data',
                'services' => NULL,
            ]);
        }
    }
    
    public function ApplyOnService(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'baby_sitter_id' => 'required',
            'user_id' => 'required',
            'service_id' => 'required',
            'message' => 'required',
        ]);
        if ($validator->fails()) {
            $responseArr['status'] = 0;
            $responseArr['message'] = $validator->messages()->first();
            return response()->json($responseArr);
        }
        $Applicants = Applicants::create([
            'baby_sitter_id' => $request->baby_sitter_id,
            'user_id' => $request->user_id,
            'service_id' => $request->service_id,
            'message' => $request->message,
            'status' => 'pending',
        ]);

        return response()->json([
            'status' => 1,
            'message' => "appliced successfully"
        ]);

    }
    
    public function GetAllApplicantsForUserJob(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            $responseArr['status'] = 0;
            $responseArr['message'] = $validator->messages()->first();
            return response()->json($responseArr);
        }

        $User = User::where('id',$request->user_id)->first();
        
        if($User)
        {
            $Applicants = Applicants::with(
                                            [
                                                'BabySitter' => function($Q)
                                                {
                                                    $Q->select('id','name','images');
                                                },
                                                'BabySitter.BabySitterDetail' => function($Q)
                                                {
                                                    $Q->select('baby_sitter_id','hourly_rate','description','age','experience','lat','long');
                                                },
                                                'BabySitter.BabySitterCertificate' => function($Q)
                                                {
                                                    $Q->select('baby_sitter_id','certificates');
                                                },
                                                'Service' => function($Q)
                                                {
                                                    $Q->select('id','service_name','description','created_at','status');
                                                },
                                                'Service.TimeSchedules' => function($Q)
                                                {
                                                    $Q->select('service_id','date','start_time','end_time','schedule');
                                                },
                                            ]
                                        )->where('user_id',$request->user_id)->where('assign',null)->get();

            return response()->json([
                'status' => 1,
                'message' => "All Applicants",
                'Applicants' => $Applicants
            ]);

        }
        else
        {
            return response()->json([
                'status' => 0,
                'message' => 'User not found!',
                'Applicants' => NULL
            ]);
        }
    }
    
    public function ServiceAssignToBabySitter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'appliced_id' => 'required',
            'baby_sitter_id' => 'required',
            'service_id' => 'required',
            'accept_or_reject' => 'required'
        ]);

        if ($validator->fails()) {
            $responseArr['status'] = 0;
            $responseArr['message'] = $validator->messages()->first();
            return response()->json($responseArr);
        }
        
        $Applicants = Applicants::where(['id'=>$request->appliced_id, 'baby_sitter_id'=>$request->baby_sitter_id, 'service_id'=>$request->service_id])->first();
       
        if($Applicants)
        {
            if($Applicants->assign == null)
            {
                $Rejection_Of_Applicants = Applicants::where('service_id',$request->service_id)->where('baby_sitter_id','!=' ,$request->baby_sitter_id)->count();
                
                for($i = 0;$i < $Rejection_Of_Applicants;$i++)
                {
                    $Rejection_Of_Applicants = Applicants::where('service_id',$request->service_id)->where('baby_sitter_id','!=' ,$request->baby_sitter_id)->update([
                        'assign' => 'not_assigned',
                        'status' => 'not_assigned'
                    ]);
                }

                Applicants::where(['id'=>$request->appliced_id, 'baby_sitter_id'=>$request->baby_sitter_id, 'service_id'=>$request->service_id])->update([
                    'assign' => $request->accept_or_reject == 1 ? 'is_assigned':'not_assigned',
                    'status' => $request->accept_or_reject == 1 ? 'is_assigned':'not_assigned',
                ]);
    
                Services::where('id',$request->service_id)->update([
                    'status' => $request->accept_or_reject == 1 ? 'assigned' : 'not_assigned',
                ]);
    
                return response()->json([
                    'status' => 1,
                    'message' => $request->accept_or_reject == 1 ? 'you assign service successfully' : 'your reject request successfully',
                ]);
            }
            else if($Applicants->assign == "is_assigned")
            {
                return response()->json([
                    'status' => 0,
                    'message' => 'you have allready assign this service to someone!',
                ]);
            }
            // else if($Applicants->assign == "not_assigned")
            // {
            //   return response()->json([
            //         'status' => 0,
            //         'message' => 'you rejected baby sitter request successfully',
            //     ]); 
            // }
        }
        else
        {
            return response()->json([
                'status' => 0,
                'message' => 'your id`s is worng please correct your id`s!',
            ]);
        }
    }
    
    public function OngoingService(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'user_id' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     $responseArr['status'] = 0;
        //     $responseArr['message'] = $validator->messages()->first();
        //     $responseArr['services'] = NULL;
        //     return response()->json($responseArr);
        // }
        
        if($request->user_id)
        {
            $Services = Services::select('id','user_id','service_name','status','description','created_at')->where(['user_id'=>$request->user_id,'status'=>'assigned'])->with(
                [
                    'User.UserDetail' => function($query)
                    {
                        $query->select('user_id','phone_number','lat','long');
                    },
                    'User' => function($query)
                    {
                        $query->select('id','name','images');
                    },
                    'Children' => function($query)
                    {
                        $query->select('service_id','child_name','child_age');
                    },
                    'TimeSchedules' => function($query)
                    {
                        $query->select('service_id','date','start_time','end_time','schedule');
                    },
                    'Applicants' => function($query)
                    {
                        $query->select('service_id','baby_sitter_id','user_id','message','status')->where('assign','is_assigned');
                    },
                    'Applicants.BabySitter' => function($query)
                    {
                        $query->select('id','name','images');
                    },
                    'Applicants.BabySitter.BabySitterDetail' => function($query)
                    {
                        $query->select('baby_sitter_id','first_name','last_name','age','lat','long','experience','hourly_rate','description');
                    },
                    'Applicants.BabySitter.BabySitterCertificate' => function($query)
                    {
                        $query->select('baby_sitter_id','certificates');
                    }
                ]
            )->get();
        
            return response()->json([
                'status' => 1,
                'message' => 'get all ongoing services successfully',
                'services' => $Services
            ]); 
        }
        else if($request->baby_sitter_id)
        {
            $Applicants = Applicants::select('service_id')->where(['baby_sitter_id'=>$request->baby_sitter_id,'status'=>'is_assigned','assign'=>'is_assigned'])
                                      ->get();
                                      
                                      
            $Services = Services::select('id','user_id','service_name','status','description','created_at')->whereIn('id',$Applicants)->with(
                [
                    'User' => function($Query)
                    {
                        $Query->select('id','name','images');
                    },
                    'User.UserDetail' => function($Query)
                    {
                        $Query->select('user_id','phone_number','lat','long');
                    },
                    'Children' => function($query)
                    {
                        $query->select('service_id','child_name','child_age');
                    },
                    'TimeSchedules' => function($query)
                    {
                        $query->select('service_id','date','start_time','end_time','schedule');
                    },
                    'Applicants.BabySitter' => function($Query)
                    {
                        $Query->select('id','name','images');
                    },
                    'Applicants.BabySitter.BabySitterDetail' => function($Query)
                    {
                        $Query->select('baby_sitter_id','first_name','last_name','age','lat','long','experience','hourly_rate','description');
                    },
                    'Applicants.BabySitter.BabySitterCertificate' => function($Query)
                    {
                        $Query->select('baby_sitter_id','certificates');
                    }
                ]
            )->get();

            return response()->json([
                'status' => 1,
                'message' => 'get all ongoing services successfully',
                'services' => $Services
            ]);
        }
    }


}
