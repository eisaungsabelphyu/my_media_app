<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //direct post page
    public function index(){
        $posts = Post::select('posts.*','categories.title as category_title')
                    ->when(request('searchKey'),function($query){
            $query->orWhere('posts.title','like','%'.request('searchKey').'%')
                ->orWhere('posts.description','like','%'.request('searchKey').'%')
                ->orWhere('categories.title','like','%'.request('searchKey').'%');

        })->leftJoin('categories','posts.category_id','categories.id')
        ->paginate(4);


        $category = Category::get();
        return view('admin.post.index',compact('posts','category'));
    }

    //post create page
    public function create(Request $request){
        $this->requestValidationCheck($request,'create');
        $data = $this->getRequestData($request);

        if($request->hasFile('postImage')){
            $fileName = uniqid().$request->file('postImage')->getClientOriginalName();
            $request->file('postImage')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }

        Post::create($data);
        return redirect()->route('admin#post')->with(['createSuccess'=>'Success Post Creation']);
    }

    //post delete
    public function delete($id){
        $dbImage = Post::select('image')->where('id',$id)->first();
        if($dbImage != null){
            Storage::delete('public/'.$dbImage);
        }
        Post::where('id',$id)->delete();
        return redirect()->route('admin#post')->with(['deleteSuccess'=>'Data deleted!']);
    }

    //post edit
    public function edit($id){
        $editPost = Post::select('posts.*','categories.title as category_title')
                    ->leftJoin('categories','posts.category_id','categories.id')
                    ->where('posts.id',$id)->first();
        $category = Category::get();
        $post = Post::get();
        return view('admin.post.edit',compact('editPost','category','post'));
    }

    //post update
    public function update($id,Request $request){
        $this->requestValidationCheck($request,'update');
        $data = $this->getRequestData($request);

        if($request->hasFile('postImage')){
            //get db image
            $dbImage = Post::select('image')->where('id',$id)->first();

            //delete local image
            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            //store update local image
            $fileName = uniqid().$request->file('postImage')->getClientOriginalName();
            $request->file('postImage')->storeAs('public/',$fileName);
            $data['image'] = $fileName;
        }

        Post::where('id',$id)->update($data);
        return redirect()->route('admin#post')->with(['updateSuccess'=>'Data updated!']);
    }

    //validation check
    private function requestValidationCheck($request,$action){
        $validationRules = [
            'description' => 'required|min:10',
            'postCategory' => 'required',
            'postImage' => 'mimes:png,jpg,jpeg,webp'
        ];
        $validationRules['postTitle'] = $action == 'update' ? 'required|min:8|unique:posts,title,'.$request->id : 'required|min:8';
        Validator::make($request->all(),$validationRules)->validate();
    }

    //request data
    private function getRequestData($request){
        return[
            'title' => $request->postTitle,
            'description' => $request->description,
            'category_id' => $request->postCategory,
        ];
    }
}
