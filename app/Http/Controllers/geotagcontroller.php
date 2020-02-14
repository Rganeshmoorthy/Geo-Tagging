<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\geotagModel;
use Response;
class geotagcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tag = geotagModel::select('tag_id','title','description','upload_image','upload_video','tag_keyword')->where('deleted_at', '=', NULL)->get(); 
        $tagArray = array();
        foreach($tag as $value){
          $tagArray[] = [
            "tag_id" => $value->tag_id,
            "title" => $value->title,
            'description' => $value->description,
            "upload_image" => $value->upload_image,
            "upload_video"=>$value->upload_video,
            "tag_keyword" => $value->tag_keyword
          ];
        }
    
        return response::json(['error' => false, 'message' =>"success", "RegisterDetails" => $tagArray], 200);
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
       //echo"<pre>";print_r($formdata);exit();
        $image = $formdata["upload_image"];
        $name = $image->getClientOriginalName();
        $image->move(public_path() . '/images/', $name);
        $upload_image = url('/') . '/images/' . $name;

        $video = $formdata["upload_video"];
        $vname = $video->getClientOriginalName();
        $video->move(public_path() . '/videos/', $vname);
        $upload_video = url('/') . '/videos/' . $vname;
        

        geotagModel::create([
            
            'title'=>$formdata['title'],
            'description'=>$formdata['description'],
            'upload_image'=>$upload_image,
            'upload_video'=>$upload_video,
            'tag_keyword'=>$formdata['tag_keyword'],               
        ]);
        return Response::json(['message'=>"stored successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($tag_id)
    {
        $tag=geotagModel::select('tag_id','title','description','upload_image','upload_video','tag_keyword')->where('tag_id',$tag_id)->first();
        $tagarray=[
            "tag_id"=>$tag->tag_id,
            "title"=>$tag->title,
            "description" => $tag->description,
          "upload_image" => $tag->upload_image,
          "upload_video"=>$tag->upload_video,
          "tag_keyword" => $tag->tag_keyword,
        ];
        return Response::json(["Result"=>$tagarray]);
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
    public function update(Request $request, $tag_id)
    {
        $formdata = $request->all();
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
      'title' => $request->input('title'),
      'description' => $request->input('description'),
      'upload_image' =>$tagimage,
      'upload_video'=>$tagvideo,
      'tag_keyword' => $request->input('tag_keyword'),
];
      $tag = geotagModel::where('tag_id', $tag_id)->update($formdata);
      return Response::json(['message'=>"updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($tag_id)
    {
        $tag = geotagModel::where('tag_id', $tag_id)->update(['deleted_at' => date('y-m-d')]);
        return response::json(['error' => false, 'message' =>"geotagModel Deleted successfully"], 200); 
    }
}
