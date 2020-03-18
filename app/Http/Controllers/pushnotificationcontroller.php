<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pushnotificationcontroller extends Controller
{

    
public function push_notification(Request $request)
{
<<<<<<< HEAD

function push_fcm_notify($data)
{
    // echo "<pre>";print_R($data);exit;
    $apiKey = Config('config.CUSTOMER_FCM_KEY');
    $fcm_url = Config('config.https://fcm.googleapis.com/fcm/send');
    $curly = array();
    $result = array();
    $headers = array(
        'Content-Type:application/json',
        'Authorization:key=' . $apiKey,
    );
    
    $data = [

	'user_id' => 'id',
	'user_name' => 'name',
	'device_name' => 'device_name', 
	'fcm_id' => 'fcm_id',
    'udid' => 'udid',
    'os_name' => 'os_name',
	'os_version' => '.0',
    ];
    
$mh = curl_multi_init();
    foreach ($data as $fcm_id => $value) {
        foreach ($value as $os_name => $value1) 

{
            foreach ($value1 as $subject => 

$comments) {
                if ($os_name == 'Android') {
                    $fields = array(
                        'to' => $fcm_id,
                        'priority' => "high",
                        'data' => array("title" 

=> $subject, "tag" => 'Key10', 'type' => 

"webpush", "body" => $comments, 'vibrate' => 1, 

'sound' => 1),
                    );
                } else {
                    $fields = array(
                        'to' => $fcm_id,
                        'priority' => "high",
                        'notification' => array

("title" => $subject, "click_action" => 'Key10', 

'type' => "webpush", "body" => $comments, 

'vibrate' => 1, 'sound' => 1),
                    );
                }
                $user = \App\Models

\UserProfile::where('FCM_ID', $fcm_id)->first();
                $notify = \App\Models

\Notification::where('subject', $subject)->first();
                $user_id = @$user->user_id;
                $notify_id = @$notify->id;
                $data = array(
                    'user_id' => $user_id,
                    // 'notification_id' => 

$notify_id,
                    // 'comments' => 

utf8_encode($comments),
                    'is_read' => 0,
                );
                // echo utf8_encode($message);
                $notification = \App\Models

\TrackNotificationUser::create($data);
                $finalresult['notification'] = 

utf8_decode($comments); //utf8_decode

($notification->description);
                $curly[$fcm_id] = curl_init();
                curl_setopt($curly[$fcm_id], 

CURLOPT_URL, $fcm_url);
                curl_setopt($curly[$fcm_id], 

CURLOPT_POST, true);
                curl_setopt($curly[$fcm_id], 

CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curly[$fcm_id], 

CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curly[$fcm_id], 

CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curly[$fcm_id], 

CURLOPT_POSTFIELDS, json_encode($fields));
                curl_multi_add_handle($mh, 

$curly[$fcm_id]);
            }
        }
        $running = null;
        do {
            $data = curl_multi_exec($mh, 

$running);
        } while ($running > 0);
        foreach ($curly as $id => $c) {
            $data = $result[$fcm_id] = 

curl_multi_getcontent($c);
            curl_multi_remove_handle($mh, $c);
        }
        curl_multi_close($mh);
        return $data;
    }
}
   $this->push_fcm_notify($registrationIds, $description, $image_url, $title);
=======
    $inputs = $request->all();
    $id = $inputs['id'];
    $res = PushNotification::find($id);
    $start_date = $res->start_date;
    $current_date = date("Y-m-d");
    $end_date = $res->end_date;
    if($current_date < $start_date)
    {
        return response()->json(['status' => 0, 'message' => trans('lang.NOTIFICATION_NOT_ENABLED')], 200);
        exit;
    }
    if($current_date > $end_date)
    {
        return response()->json(['status' => 0, 'message' => trans('lang.NOTIFICATION_SENT_EXPIRED')], 200);
        exit;
    }
    $title = $res->title;
    $description = $res->description;
    $notification_type = $res->push_type;
    $image = $res->image;
    $ios_flag = 1;

    if ($notification_type == '2' && $image != '') 
    {
        $ios_flag = 0;
        $image_url = ImageDisplay($this->image_path_folder_name, $image);
    } else 
    {
        $image_url = '';
    }

    $get_customers = get_customer_fcmid($id);
    // echo "<pre>";print_r($get_customers);exit;
    $registrationIds = array();
    foreach ($get_customers as $val) 
    {
        $fcm_id = $val['fcm_id'];
        $os_name = $val['os_name'];
        $registrationIds[$os_name][] = $fcm_id;
    }

    push_fcm_notify($registrationIds, $description, $image_url, $title);
>>>>>>> c5db54318414db1992463a847a962bcda4ebc4d0
    return response()->json(['status' => 1, 'message' => trans('lang.NOTIFICATION_SENT_SUCCESS')], 200);
}



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}