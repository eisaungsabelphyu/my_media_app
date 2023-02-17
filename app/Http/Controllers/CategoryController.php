<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct caregory page
    public function index(){
        $categories = Category::when(request('searchKey'),function($query){
                        $query->orWhere('title','like','%'.request('searchKey').'%')
                            ->orWhere('description','like','%'.request('searchKey').'%');
        })
                        ->get()->toArray();
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
        Category::where('category_id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Category Deleted!']);
    }

    //validation check
    private function requestValidationCheck($request){
        Validator::make($request->all(),[
            'categoryName' => 'required|unique:categories,title',
            'description' => 'required|min:10'
        ])->validate();
    }

    //get request data
    private function getRequestData($request){
        return[
            'title' => $request->categoryName,
            'description' => $request->description
        ];
    }
}
