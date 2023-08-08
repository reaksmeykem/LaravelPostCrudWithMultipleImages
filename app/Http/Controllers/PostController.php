<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Image;

class PostController extends Controller
{
    public function index(){
        $posts = Post::latest()->get();
        return view("index", compact('posts'));
    }
    public function store(Request $request){
        $post = new Post();

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'photo' => 'required|array',
            'photo.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();

        foreach($request->file('photo') as $image){
            $ext = $image->extension();
            $final_name = time().rand(1,100).'.'.$ext;
            $image->move(public_path('uploads/'), $final_name);

            $post->rPhoto()->create([
                'post_id' => $post->id,
                'photo' => $final_name
            ]);
        }

        return redirect()->route('create_post')->with('success','Added Successfully.');
    }

    public function view_detail($id){
        $post_detail = Post::where('id', $id)->first();
        return view('post_detail', compact('post_detail'));
    }

    public function edit($id){
        $post_detail = Post::where('id', $id)->first();
        return view('post-edit', ['post_detail' => $post_detail]);
    }

    public function delete_image($id){
        $image = Image::where('id',$id)->first();

        if(file_exists(public_path('uploads/'.$image->photo))){
            unlink(public_path('uploads/'.$image->photo));
        }
        $image->delete();
        return back();
    }

    public function update($id, Request $request){
        $post = Post::where('id', $id)->first();

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'photo' => 'array',
            'photo.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        $post->title = $request->title;
        $post->description = $request->description;

        if($request->hasFile('photo')){
            foreach($request->file('photo') as $image){
                $ext = $image->extension();
                $final_name = time().rand(1,100).'.'.$ext;
                $image->move(public_path('uploads/'), $final_name);

                $post->rPhoto()->create([
                    'post_id' => $post->id,
                    'photo' => $final_name
                ]);
            }
        }else{

        }

        $post->update();

        return redirect()->route('create_post')->with('success','Updated Successfully.');
    }

    public function delete($id){
        $post = Post::where('id', $id)->first();

        // delete multiple images
        foreach($post->rPhoto as $image){
            if(file_exists(public_path('uploads/'.$image->photo)) AND !empty($image->photo)){
                unlink(public_path('uploads/'.$image->photo));
            }
            $image->delete();
        }

        $post->delete();

        return redirect()->route('create_post')->with('success','Deleted Successfully.');

    }


}

