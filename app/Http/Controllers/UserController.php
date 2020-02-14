<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller; 
use App\User; 
// use Illuminate\Support\Facades\Auth; 
use Validator;
use Response;
use Auth;
use Laravel\Passport\HasApiTokens;
class UserController extends Controller
{
   
    public $successStatus = 200;
    /** 
         * login api 
         * 
         * @return \Illuminate\Http\Response 
         */ 
        public function login(Request $request){ 
            $formdata = $request->all();
            $mobile_no= $request->mobile_no;
            $password= $request->password;
                //echo"<pre>";print_r($mobile_no);exit(); 

                //$user = User::where('mobile_no', $mobile_no)->first();
                //echo"<pre>";print_r($formdata);exit();
       
               if(Auth::attempt(['mobile_no' => $mobile_no, 'password' => $password])){
              
                    $user = Auth::User();
                   // echo"<pre>";print_r($user);exit();
                   $token = $user->createToken('MyApp')->accessToken;
                   //  echo"<pre>";print_r($token);exit();
                   $results = array(
                       'mobile_no' => $user->mobile_no,
                       'password' => $user->password,
                       'token' => $token
                   );
             
       
                  // echo"<pre>";print_r($results);exit();
                   return response::json(array('status' => 1, 'message' => 'User LoggedIn successfully..', 'result' => $results), 200)
                               ->header('token', $token);
               }
               else{
                   return response::json(array('status' => 0, 'message' => 'invalid mobile_no or password'));
               }
        }
    /** 
         * Register api 
         * 
         * @return \Illuminate\Http\Response 
         */ 
        public function register(Request $request) 
        { 
            $validator = Validator::make($request->all(), [ 
                'name' => 'required', 
               // 'email' => 'required|email', 
                'password' => 'required', 
                'mobile_no'=>'required',
                //'c_password' => 'required|same:password', 
            ]);
    if ($validator->fails()) { 
                return response()->json(['error'=>$validator->errors()], 401);            
            }
    $input = $request->all(); 
            $input['password'] = bcrypt($input['password']); 
            $user = User::create($input); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            $success['name'] =  $user->name;
    return response()->json(['success'=>$success], $this-> successStatus); 
        }
    /** 
         * details api 
         * 
         * @return \Illuminate\Http\Response 
         */ 
        public function details() 
        { 
            $user = Auth::user(); 
            return response()->json(['success' => $user], $this-> successStatus); 
        } 
        public function store(Request $request)
        {
            $formdata=$request->all();
            User::create([
                'name'=>$formdata['name'],
                'password'=>bcrypt($formdata['password']),
                'mobile_no'=>$formdata['mobile_no'],
            ]);
            return Response::json(['message'=>"stored successfully"]);
        }
    }
