<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pushnotificationcontroller extends Controller
{

    
public function push_notification(Request $request)
{
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
