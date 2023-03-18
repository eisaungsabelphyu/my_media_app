<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //all categories
        $categories = Category::get();
        return response()->json([
            'status' => 'success',
            'categories' => $categories
        ], 200);
    }

    //search category
    public function search(Request $request){

        if($request->key != null){
           $post = Post::select('posts.*','categories.title as category')
                       ->leftJoin('categories','posts.category_id','categories.id')
                        ->where('posts.category_id',$request->key)->paginate(4);
        }else{
            $post = Post::select('posts.*','categories.title as category')
                       ->leftJoin('categories','posts.category_id','categories.id')
                        ->paginate(4);
        }
        return response()->json([
            'searchData' => $post
        ], 200);
    }


}
