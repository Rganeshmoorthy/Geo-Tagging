<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\geotagModel;
use Response;
use Validator;
use Auth;
use DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller; 
// use Illuminate\Support\Facades\Auth; 
use Laravel\Passport\HasApiTokens;

class GeotagsController extends Controller
{
     public function store(Request $request)
     {

        $formdata=$request->all();
        if(isset($formdata['upload_image']) && isset($formdata['upload_video']) && isset($formdata['title']) 
        && isset($formdata['tag_keyword']) && isset($formdata['hours']))
        {
        $user = Auth::user();
        //echo"<pre>";print_r($user);exit();
        // $email = $user->name;
        $image = $formdata["upload_image"];
        $name = $image->getClientOriginalName();
        $image->move(public_path() . '/images/', $name);
        $upload_image = url('/') . '/images/' . $name;
        $video = $formdata["upload_video"];
        $vname = $video->getClientOriginalName();
        $video->move(public_path() . '/videos/', $vname);
        $upload_video = url('/') . '/videos/' . $vname;
        geotagModel::create([
            'user_id' => $user->id,
            'title'=>$formdata['title'],
            'description'=>$formdata['description'],
            'upload_image'=>$upload_image,
            'upload_video'=>$upload_video,
            'tag_keyword'=>$formdata['tag_keyword'], 
               'hours'=>$formdata['hours']
              
        ]);
        }
        else
                {
                    return Response::json(['message'=>"required"]);
                }
  

        return Response::json(['message'=>"stored successfully"]);

  
     }
     public function show($tag_id)
     {
        $user = Auth::user();
 
         $tag=geotagModel::select('tag_id','user_id','title','description','upload_image','upload_video','tag_keyword','hours')->where('tag_id',$tag_id)->first();
         $tagarray=[
             "tag_id"=>$tag->tag_id,
             "user_id" => $user->id,
             "title"=>$tag->title,
             "description" => $tag->description,
           "upload_image" => $tag->upload_image,
           "upload_video"=>$tag->upload_video,
           "tag_keyword" => $tag->tag_keyword,
           "hours" => $tag->hours,
         ];
         return Response::json(["Result"=>$tagarray]);
     }
     public function update(Request $request, $tag_id)
    {
        $formdata = $request->all();
        $user = Auth::user();
        $image = geotagModel::where('tag_id', $tag_id)->first();
        $geoimg = $image->upload_image;
        
        if ($formdata['upload_image'] != "") {
            $image = $formdata['upload_image'];
            $name = $image->getClientOriginalName();
            $size = $image-> getSize();
            $image->move(public_path() . '/images/', $name);
            $tagimage = url('/') . '/images/' . $name;
        } else {
            $tagimage = $geoimg;
        }
        //echo "<pre>";print_r($taxCounts);exit;
        $video = geotagModel::where('tag_id', $tag_id)->first();
        $geovideo = $video->upload_video;
        
        if ($formdata['upload_video'] != "") {
            $video = $formdata['upload_video'];
            $vname = $video->getClientOriginalName();
            $size = $video-> getSize();
            $video->move(public_path() . '/videos/', $vname);
            $tagvideo = url('/') . '/videos/' . $name;
        } else {
            $tagvideo = $geovideo;
        }

    $formdata = [
      'user_id' => $user->id,
      'title' => $request->input('title'),
      'description' => $request->input('description'),
      'upload_image' =>$tagimage,
      'upload_video'=>$tagvideo,
      'tag_keyword' => $request->input('tag_keyword'),
       'hours' => $request->input('hours'),
             ];
      $tag = geotagModel::where('tag_id', $tag_id)->update($formdata);
      return Response::json(['message'=>"updated successfully"]);
    }
    public function destroy($tag_id)
    {
        $tag = geotagModel::where('tag_id', $tag_id)->update(['deleted_at' => date('y-m-d')]);
        return response::json(['error' => false, 'message' =>"geotagModel Deleted successfully"], 200); 
    }
    public function index()
    {
        $user = Auth::user();
        $tag = DB::select("SELECT tag_id, user_id, title, description, upload_image, upload_video, tag_keyword, hours, created_at FROM geotag
        where geotag.deleted_at IS NULL 
      and geotag.created_at > DATE_SUB(NOW(), INTERVAL geotag.hours HOUR) 
                                  ");
                                 
                                  
        $tagArray = array();
        foreach($tag as $value){
          $tagArray[] = [
            "tag_id" => $value->tag_id,
            'user_id' => $user->id,
            // "user_id" => $value->user_id,
            "title" => $value->title,
            'description' => $value->description,
            "upload_image" => $value->upload_image,
            "upload_video"=>$value->upload_video,
            "tag_keyword" => $value->tag_keyword,
            "hours"=>$value->hours 
          ];
        }
    
        return response::json(['error' => false, 'message' =>"success", "RegisterDetails" => $tagArray], 200);
    }

 
}
