<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Response;
use Validator;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller; 
// use Illuminate\Support\Facades\Auth; 
use Laravel\Passport\HasApiTokens;

class geoRegistercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $successStatus = 200;
    /** 
         * login api 
         * 
         * @return \Illuminate\Http\Response 
         */ 
        public function login(Request $request){ 
            $formdata = $request->all();
             $input=file_get_contents("php://input");
             $input=json_decode($input,true);
            $mobile_no= $request->mobile_no;
            $password= $request->password;
                //echo"<pre>";print_r($mobile_no);exit(); 

                //$user = User::where('mobile_no', $mobile_no)->first();
                //echo"<pre>";print_r($formdata);exit();
       
               if(Auth::attempt(['mobile_no' => $mobile_no, 'password' => $password,'status'=>1]))
               {
           
                    $user = Auth::User();
                   // echo"<pre>";print_r($user);exit();
                   $token = $user->createToken('MyApp')->accessToken;
                   //  echo"<pre>";print_r($token);exit();
                   $results = array(
                       'mobile_no' => $user->mobile_no,
                       'password' => $user->password,
                       'token' => $token
                       //'user' =>  $user

                   );
             
       
                  // echo"<pre>";print_r($results);exit();
                   return response::json(array('status' => 1, 'message' => 'User LoggedIn successfully..', 'result' => $results), 200)
                               ->header('token', $token);
               }
               else{
                   return response::json(array('status' => 0, 'message' => 'invalid mobile_no or password'));
               } 
            }
            public function adminLogin(Request $request)
            {
                $formdata = $request->all();
                $input=file_get_contents("php://input");
             $input=json_decode($input,true);
                $mobile_no= $request->mobile_no;
                $password= $request->password;
                // echo"<pre>";print_r($formdata);exit(); 
    
                    //$user = User::where('mobile_no', $mobile_no)->first();
                    //echo"<pre>";print_r($formdata);exit();
           
                   if(Auth::attempt(['mobile_no' => $mobile_no, 'password' => $password]))
                   {
                        $user = Auth::User();
                       //echo"<pre>";print_r($user);exit();
                       $token = $user->createToken('MyApp')->accessToken;
                       //  echo"<pre>";print_r($token);exit();
                       $results = array(
                           'mobile_no' => $user->mobile_no,
                           'password' => $user->password,
                           'isadmin'=>$user->isadmin,
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
                'password' => 'required', 
                'mobile_no' => 'required', 
            ]);
    if ($validator->fails()) { 
                return response()->json(['error'=>$validator->errors()], 401);            
            }
    $input = $request->all(); 
            $input['password'] = bcrypt($input['password']); 
            $user = User::create($input); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            $success['name'] =  $user->name;
 //   return response()->json(['success'=>$success], $this-> successStatus); 
     
 return response::json(array('status' => 1, 'message' => 'User register successfully..', 'result' => $results), 200)
                               ->header('token', $token);
               
 //       return response::json(array('status' => 0, 'message' => 'invalid mobile_no or password'));
                
        }
    /** 
         * details api 
         * 
         * @return \Illuminate\Http\Response 
         */ 
       
    public function index()
    {
        $Reg = User::select('id','name','password','mobile_no')->where('deleted_at', '=', NULL)->get(); 

        $RegArray = array();
        foreach($Reg as $value){
          $RegArray[] = [
            "id" => $value->id,
            "name" => $value->name,
            'password' => $value->password,
            "mobile_no" => $value->mobile_no
          ];
        }
        return response::json(['error' => false, 'message' =>"success", "RegisterDetails" => $RegArray], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
       
    public function store(Request $request)
    {    
        $otp=rand(10000,99999).'';
        $formdata=$request->all();
            User::create([
               'name'=>$formdata['name'],
                'password'=>bcrypt($formdata['password']),
                'mobile_no'=>$formdata['mobile_no'],
                'otp'=>$otp
            ]);
            return Response::json(['message'=>"stored successfully"]);
        }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $reg=User::select('id','name','password','mobile_no')->where('id',$id)->first();
        $regarray=[
            "id"=>$reg->id,
            "name"=>$reg->name,
            "password" => $reg->password,
          "mobile_no" => $reg->mobile_no,
        ];
        return Response::json(["Result"=>$regarray]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $formData = $request->all();

            //echo "<pre>";print_r($taxCounts);exit;
        $formdata = [
          'name' => $request->input('name'),
          'password' => $request->input('password'),
          'mobile_no' => $request->input('mobile_no'),
];
          $Reg = User::where('id', $id)->update($formData);
          return Response::json(['message'=>"updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reg = User::where('id', $id)->update(['deleted_at' => date('y-m-d')]);
        return response::json(['error' => false, 'message' =>"geoRegModel Deleted successfully"], 200);
    }

    public function details() 
    { 
        $user = Auth::User(); 
        //echo"<pre>";print_r($user->id);exit();
       /* $reg=User::select('id','name','mobile_no')->where('id',$id);
        $regarray=[
            "id"=>$reg->id,
            "name"=>$reg->name,
          "mobile_no" => $reg->mobile_no,
        ];
        return Response::json(["Result"=>$regarray]);*/
    
        return response()->json(['success' => $user], $this->successStatus); 
    } 
}
