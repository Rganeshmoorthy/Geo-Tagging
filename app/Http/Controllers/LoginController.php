<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\geoRegModel; 
use Illuminate\Support\Facades\Auth; 
use Validator;


class LoginController extends Controller
{
    
    public $successStatus = 200;
    
        public function login(){ 
            if(Auth::attempt(['mobile_no' => request('mobile_no'), 'password' => request('password')])){ 
                $user = Auth::geoRegModel(); 
                $success['token'] =  $user->createToken('MyApp')-> accessToken; 
                return response()->json(['success' => $success], $this-> successStatus); 
            } 
            else{ 
                //return response()->json(['error'=>'Unauthorised'], 401); 
            } 
        }
    
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
            $user = geoRegModel::create($input); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            $success['name'] =  $user->name;
    return response()->json(['success'=>$success], $this-> successStatus); 
        }
}
