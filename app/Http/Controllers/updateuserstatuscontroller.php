<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class updateuserstatuscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updatestatus(Request $request,$id)
    {
        $user = User::find($request->id);
        // echo "<pre>";print_r($id . 'ID' .$request->id);exit;
        // echo "<pre>";print_r($user->status);
        // $user->status = $request->status;
        $status = $user->status;
        $successMessage = "";
        // echo "<pre>";print_r($status == 1);exit; 
        if($status == 1)
        {
            $Reg = User::where('id', $id)->update(['status'=> 0]);
            $successMessage = 'User Inactived successfully.';    
        }
        else
        {
            $Reg = User::where('id', $id)->update(['status'=> 1]);
            $successMessage =  'User Active successfully.';    
       
        }
        return response()->json(['success' => 1,'message'=> $successMessage]);

       

    }
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
