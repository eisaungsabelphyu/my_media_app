<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrendPostController extends Controller
{
    //direct trend post page
    public function index(){
        return view('admin.trend_post.index');
    }
}
