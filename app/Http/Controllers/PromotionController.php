<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Promotion;
use Redirect;
use File;
class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $promotions = Promotion::paginate(5);
        $promotions->setPath('promotion');
        return view('promotion.index',['promotions'=>$promotions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('promotion.newpromotion');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Requests\PromotionRequest $request)
    {
        $promotion = new Promotion;
        $arrayimage = [];
         if ($request->hasFile('image'))
         {
             $images = $request->file('image');
             foreach($images as $image){
             $destinationPath = public_path().'/uploads/promotion/';
             $filename = time().'_'.$image->getClientOriginalName();
             $uploaded = $image->move($destinationPath, $filename);
             $image = 'uploads/promotion/'. $filename;
             array_push($arrayimage,$image);
            }
            $value = ['url'=>$arrayimage];
            $value = json_encode($value, JSON_UNESCAPED_SLASHES);
        }
        else{
            $value = 'null';
        }
        $promotion->service_code = $request->input('servicecode');
        $promotion->service_name = $request->input('servicename');
        $promotion->image = $request->input('image');
        $promotion->option_name = $request->input('optionname');
        $promotion->value = $value;
        $promotion->description = $request->input('description');
        $promotion->save();
        return Redirect::route('promotion');   
           
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $promotion = Promotion::findOrFail($id);
        return view('promotion.editpromotion',['promotion'=>$promotion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Requests\PromotionRequest $request, $id)
    {
        $promotion = Promotion::findOrFail($id);
        $arrayimages = json_decode($promotion->value);

         if ($request->hasFile('image'))
         {
            if($promotion->value != 'null'){
                $arrayimages = json_decode($promotion->value);
                foreach ($arrayimages as $image)
                    for($i=0;$i<count($image);$i++){
                    $filename = public_path().'/'.$image[$i];
                    if (File::exists($filename)) {
                    File::delete($filename);
                    } 
                }
           }
             $arrayimage = [];
             $images = $request->file('image');
             foreach($images as $image){
             $destinationPath = public_path().'/uploads/promotion/';
             $filename = time().'_'.$image->getClientOriginalName();
             $uploaded = $image->move($destinationPath, $filename);
             $image = 'uploads/promotion/'. $filename;
             array_push($arrayimage,$image);
            }
            $value = ['url'=>$arrayimage];
            $value = json_encode($value, JSON_UNESCAPED_SLASHES);

        }
         else{
            $value = $promotion->value;
        }
           
       
        $promotion->service_code = $request->input('servicecode');
        $promotion->service_name = $request->input('servicename');
        $promotion->image = $request->input('image');
        $promotion->option_name = $request->input('optionname');
        $promotion->value = $value;
        $promotion->description = $request->input('description');
        $promotion->save();
        return Redirect::route('promotion');
   
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $promotion = Promotion::findOrFail($id);
        $arrayimages = json_decode($promotion->value);
        foreach ($arrayimages as $image)
        for($i=0;$i<count($image);$i++){
             $filename = public_path().'/'.$image[$i];
            if (File::exists($filename)) {
                File::delete($filename);
            } 
        }
        $promotion->delete();
        return Redirect::back();
    }
}
