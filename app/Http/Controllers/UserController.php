<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    function search_img(Request $request){
      $data = $request->input('search');
      
      $imgdata =  DB::table('galleries')->where('filename' , 'like' , '%' . $data . '%')
      ->orWhere('category' , 'like' , '%' . $data . '%')
      ->orderByDesc('created_at')
      ->get();


      return view('home', compact('imgdata'));



    }

    public function welcome()
    {
        return view('welcome');
    }

    public function home()
    {
        $imgdata = Gallery::orderByDesc('created_at')->get();
        
        return view('home',compact('imgdata'));
       
        

        
    }

    public function store_data(Request $request)
    {
        $data = new Gallery();
    
        $data->filename = $request->input('filename');
        $img_name = $request->input('filename');
        $data->category = $request->input('category');
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $image_name = $img_name . "." . $ext;
            $image->move('public/photos', $image_name);
    
            $data->image = $image_name;
    
           
            $data->image_path = 'photos/' . $image_name;
        }
    
        $data->save();
        return back()->with('success', 'Image uploaded successfully');
    }

    public function delete($id){
        $image = Gallery::find($id);
        $image_path = 'public/photos/' .$image->image;

        if(File::exists($image_path)){
            File::delete($image_path);
        }
        $image->delete();
        return redirect()->back()->with('success', 'Image deleted successfully');
    }

}
