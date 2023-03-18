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

         $posts = Post::select('posts.*','categories.title as category')
                       ->leftJoin('categories','posts.category_id','categories.id')
                       ->paginate(4);
        return response()->json([
            'status' => 'success',
            'posts' => $posts
        ], 200);
    }

   //search post data
    public function searchData(){

        $post = Post::select('posts.*','categories.title as category')
                       ->leftJoin('categories','posts.category_id','categories.id')
        ->orWhere('posts.title','like','%'.request('key').'%')->paginate(4);
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
