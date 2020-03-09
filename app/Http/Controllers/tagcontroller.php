<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mastermodel;
use Response;
use Validator;
use Auth;

class tagcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tag = mastermodel::select('id','value','status')->where('deleted_at', '=', NULL)->get(); 
        $tagArray = array();
        foreach($tag as $val)
        {
          $tagArray[] = 
          [
            "id" => $val->id,
            "value" => $val->value,
            "status" => $val->status,       
           ];
        }
    
        return response::json(['error' => false, 'message' =>"success", "tagdetails" => $tagArray], 200);

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
        $formdata=$request->all();
        //  echo"<pre>";print_r($formdata);exit();
        $tags = explode(",", $request->value);
        foreach($tags as $tag)
        {
            mastermodel::create(['value'=>$tag]);
        }
    //    if(mastermodel::where('value', '=', Input::get('value'))->exists());
         // echo"<pre>";print_r($request->value);
       // $str_arr = preg_split ("/\,/", $formdata);
        //echo"<pre>";print_r($formdata);exit();
        // echo"<pre>";print_r($str_arr);exit;
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
        $formData = $request->all();

        //echo "<pre>";print_r($taxCounts);exit;
    $form = [
      'id' => $request->input('id'),
      'value' => $request->input('value'),
      'status' => $request->input('status'),
             ];
      $Reg = mastermodel::where('id', $id)->update($formData);
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
        $reg = mastermodel::where('id', $id)->update(['deleted_at' => date('y-m-d')]);
        return response::json(['error' => false, 'message' =>"TagDeleted successfully"], 200);
    
    }
    public function autoComplete(Request $request)
  {
    $data = $request->value;
    $client = mastermodel::where('value', 'like', '%' . $data . '%')->where('status', '=', 1)->get();
    $filterQuoteArray = array();
    foreach ($client as $key => $value1) 
    {
      $filterQuoteArray[] =  $value1->value;
    }
    //echo "<pre>IN_NO";($filterQuoteArray);exit;
    return response()->json(['error' => false, 'message' => "success", "autocomplete" => $filterQuoteArray], 200);
  }
  public function tagupdatestatus(Request $request,$id)
  {
      $user = mastermodel::find($request->id);
      // echo "<pre>";print_r($id . 'ID' .$request->id);exit;
      // echo "<pre>";print_r($user->status);
      // $user->status = $request->status;
      $status = $user->status;
      $successMessage = "";
      // echo "<pre>";print_r($status == 1);exit; 
      if($status == 1)
      {
          $Reg = mastermodel::where('id', $id)->update(['status'=> 0]);
          $successMessage = 'tag Inactived successfully.';    
      }
      else
      {
          $Reg = mastermodel::where('id', $id)->update(['status'=> 1]);
          $successMessage =  'tag Active successfully.';    
     
      }
      return response()->json(['success' => 1,'message'=> $successMessage]);

     

  }
}
