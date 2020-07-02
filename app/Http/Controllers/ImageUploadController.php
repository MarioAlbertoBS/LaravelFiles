<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;

class ImageUploadController extends Controller
{
    /**
     * Display a listing of the resource
     * 
     * @return \Illuminate\Http\Response
     */
    public function image_upload()
    {
        //Getting images
        $files = Storage::disk('images')->files();
        $images = array();
        //echo dd($files);
        foreach($files as $file) {
            $images[] = $file;
        }
        //var_dump($images);
        return view('image_upload')->with('images', $images);
    }

    /**
     * Display a listing of the resource
     * 
     * @return \Illuminate\Http\Response
     */
    public function upload_post_image(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();
    
        //$request->image->move(public_path('images'), $imageName);
        Storage::disk('images')->put($imageName, file_get_contents($request->image));

        return back()->with('success', 'Image Uploaded');
    }
}
