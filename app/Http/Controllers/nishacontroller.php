<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\nishamodel;
use Response;

class nishacontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       echo $data=nishamodel::all(); 
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
        nishamodel::create([
            'name'=>$formdata['name'],
            'email'=>$formdata['email'],
            'phno'=>$formdata['phno'],
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
        $va=nishamodel::select('name')->where('id',$id)->first();
        $vaarray=[
            "name"=>$va->name,

        ];
        return Response::json(["Result"=>$vaarray]);
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
        $va1 = nishamodel::where('id', $id)->update(['deleted_at' => date('y-m-d')]);
        return response::json(['error' => false, 'message' =>" Deleted successfully"], 200);
    }
}
