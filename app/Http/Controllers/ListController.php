<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ListController extends Controller
{
    //direct admin list page
    public function index(){
        $users = User::get()->toArray();
        return view('admin.list.index',compact('users'));
    }

    //account delete page
    public function accountDelete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess' => "Account Deleted!"]);
    }
}
