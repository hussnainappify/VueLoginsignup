<?php
 
namespace App\Http\Controllers\API;
 
use App\Http\Controllers\Controller;
 
use App\Models\Post;
 
use Illuminate\Http\Request;
 
use Validator;
 
class PostController extends Controller
{
    // all posts
    public function index()
    {


  

        return Post::all();

       
    }
 
  
    public function add(Request $request)
    {
      


 $request->validate([
        
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
        ]);
  
        $input = $request->all();
  
        if ($image = $request->file('image')) {
            $destinationPath = 'image2/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
    }

    Post::create($input);
     
       
 }

  public function create()
    {
        return view('home');
    }

    public function stores(Request $request)
    {
        $request->validate([
        
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
  
        $input = $request->all();
  
        if ($image = $request->file('image')) {
            $destinationPath = 'image2/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
    }

    Post::create($input);
     
       
}






    public function edit($id)
    {
        $post = Post::find($id);
        return response()->json($post);
    }
 
    // update post
    public function update($id, Request $request)
    {
        $post = Post::find($id);
        $post->update($request->all());
 
        return response()->json('The post successfully updated');
    }
 
    // delete post
    public function delete($id)
    {
        $posts = Post::find($id);
        $posts->delete();
 
        return response()->json('The post successfully deleted');
    }
}