<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
        return view('posts.frontPage', compact('posts'));
    }
    public function create()
    {
        return view('posts.create');
    }
    public function store(Request $request)
    {
       
        $data = $request->validate([
            'caption' => 'required',
            'description' => 'required',
            'image' => 'required | mimes:jpeg,jpg,png | max:1000',
        ]);
        try {
            
            $imagePath = request('image')->store('postImages', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(350, 300);
            $image->save();
            auth()->user()->posts()->create([
                'caption' => $data['caption'],
                'description' => $data['description'],
                'image' => $imagePath,
            ]);
        } catch (\Throwable $th) {
          
        }
     
        return redirect()->to('profile/' . auth()->user()->id);
    }


    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

  
    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
