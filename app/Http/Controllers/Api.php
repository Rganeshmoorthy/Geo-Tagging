<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use App\sammodel;
use Response;
class Api extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        echo $data=Test::all();
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
        sammodel::create([
         'sam_id'=>$formdata['sam_id'],
         'name'=>$formdata['name'],
         'email'=>$formdata['email'],
     ]);
    
     return Respose::json(['message'=>"stored successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $api = Test::select('name')->where('id', $id)->first();
        //echo "<pre>";print_r($api);exit;
        $apiArray = [
              "name" => $api->name,
        ];
        return Response::json(["Result"=>$apiArray]);
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
