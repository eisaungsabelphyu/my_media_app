<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct caregory page
    public function index(){
        $categories = Category::when(request('searchKey'),function($query){
                        $query->orWhere('title','like','%'.request('searchKey').'%')
                            ->orWhere('description','like','%'.request('searchKey').'%');
        })
                        ->paginate(3);
        return view('admin.category.index',compact('categories'));
    }

    //category create
    public function create(Request $request){
        $this->requestValidationCheck($request);
        $data = $this->getRequestData($request);
        Category::create($data);
        return back()->with(['createSuccess' => 'Category created!']);
    }

    //category delete
    public function delete($id){
        Category::where('id',$id)->delete();
        return redirect()->route('admin#category')->with(['deleteSuccess'=>'Category Deleted!']);
    }

    //category edit page
    public function edit($id){
        $editCategory = Category::where('id',$id)->first();
        $categories = Category::get();
        return view('admin.category.edit',compact('editCategory','categories'));
    }

    //category update page
    public function update(Request $request){

       $this->requestValidationCheck($request);
        $data = $this->getUpdateData($request);
        Category::where('id',$request->categoryId)->update($data);
        return redirect()->route('admin#category')->with(['updateSuccess'=>'Success Updating']);
    }

    //validation check
    private function requestValidationCheck($request){
        Validator::make($request->all(),[
            'categoryName' => 'required|unique:categories,title,'.$request->categoryId,
            'description' => 'required|min:10'
        ])->validate();
    }

    //get update date
    private function getUpdateData($request){
        return[
            'title'=>$request->categoryName,
            'description'=>$request->description,
            'updated_at'=>Carbon::now()
        ];
    }

    //get request data
    private function getRequestData($request){
        return[
            'title' => $request->categoryName,
            'description' => $request->description
        ];
    }
}
