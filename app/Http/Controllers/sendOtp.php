<?php
namespace App\Http\Controllers;




use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Auth;
use \App\User;
use \App\MSG91;


class sendOtp extends Controller
{
    
public function sendOtp(Request $request){

    $response = array();
    $userId = Auth::user()->id;

    $users = User::where('id', $userId)->first();

    if ( isset($users['mobile_no']) && $users['mobile_no'] =="" ) {
        $response['error'] = 1;
        $response['message'] = 'Invalid mobile number';
        $response['loggedIn'] = 1;
    } else {

        $otp = rand(100000, 999999);
        $MSG91 = new MSG91();

        $msg91Response = $MSG91->sendSMS($otp,$users['mobile_no']);

        if($msg91Response['error']){
            $response['error'] = 1;
            $response['message'] = $msg91Response['message'];
            $response['loggedIn'] = 1;
        }else{

            Session::put('OTP', $otp);

            $response['error'] = 0;
            $response['message'] = 'Your OTP is created.';
            $response['OTP'] = $otp;
            $response['loggedIn'] = 1;
        }
    }
    echo json_encode($response);
}


public function verifyOtp(Request $request){

    $response = array();

    $enteredOtp = $request->input('otp');
    $userId = Auth::user()->id;  //Getting UserID.

    if($userId == "" || $userId == null){
        $response['error'] = 1;
        $response['message'] = 'You are logged out, Login again.';
        $response['loggedIn'] = 0;
    }else{
        $OTP = $request->session()->get('OTP');
        if($OTP === $enteredOtp){

            // Updating user's status "isVerified" as 1.

            User::where('id', $userId)->update(['isVerified' => 1]);

            //Removing Session variable
            Session::forget('OTP');

            $response['error'] = 0;
            $response['isVerified'] = 1;
            $response['loggedIn'] = 1;
            $response['message'] = "Your Number is Verified.";
        }else{
            $response['error'] = 1;
            $response['isVerified'] = 0;
            $response['loggedIn'] = 1;
            $response['message'] = "OTP does not match.";
        }
    }
    echo json_encode($response);
}
}
