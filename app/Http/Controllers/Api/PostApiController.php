<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all post
        $posts = Post::get();
        return response()->json([
            'status' => 'success',
            'posts' => $posts
        ], 200);
    }

    //search post data
    public function searchData(Request $request){
        $post = Post::where('title','like','%'.$request->key.'%')->get();
        return response()->json([
            'searchKey' => $post
        ], 200);
    }

    //post detail
    public function detail(Request $request){

        $post = Post::where('id',$request->postId)->first();
        return response()->json([
            'post' => $post
        ], 200);
    }


}
