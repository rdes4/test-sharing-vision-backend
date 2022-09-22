<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Validator;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function createPost(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, 
            [
                'title' => 'required|min:20',
                'content' => 'required|min:200',
                'category' => 'required|min:3',
                'status' => 'required|in:Draft,Publish,Trash'
            ],
            [
                'status.in' => 'Pilih salah satu status dari Draft, Publish, atau Trash'
            ]
            
        );
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $post = Post::create($input);
        return response()->json([
            "success" => true,
            "message" => "Post created successfully.",
            "data" => $post
        ]);
    }

    public function getAllPosts(){
        $posts = Post::paginate();
        return response()->json([
            "success" => true,
            "message" => "Posts List",
            "data" => $posts
        ]);
    }

    public function getPostById($id){
        if (Post::where('id', $id)->exists()) {
            $post = Post::where('id', $id)->get();
            return response()->json($post, 200);
        } else {
            return response()->json([
                "message" => "User Not Found"
            ], 201);
        }
        
    }

    public function updatePost(Request $request, Post $post){
        $input = $request->all();
        $post = Post::find(1);

        $validator = Validator::make($input, 
            [
                'title' => 'required|min:20',
                'content' => 'required|min:200',
                'category' => 'required|min:3',
                'status' => 'required|in:Draft,Publish,Trash'
            ],
            [
                'status.in' => 'Pilih salah satu status dari Draft, Publish, atau Trash'
            ]
            
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $post->title = $input['title'];
        $post->content = $input['content'];
        $post->category = $input['category'];
        $post->status = $input['status'];
        $post->save();

        return response()->json([
            "success" => true,
            "message" => "Post updated successfully.",
            "data" => $post
        ]);
    }

    public function deletePost($id){
        if (Post::where('id', $id)->exists()) {
            $post = Post::find($id);
            $post->delete();

            return response()->json([
                "message" => "Post Deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "User Not Found"
            ], 201);
        }
        
    }
}
