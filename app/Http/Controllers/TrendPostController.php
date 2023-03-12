<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrendPostController extends Controller
{
    //direct trend post page
    public function index(){
        $trendPost = ActionLog::select('action_logs.*','posts.*', DB::raw('COUNT(action_logs.post_id) as post_count'))
                                ->leftJoin('posts', 'posts.id','action_logs.post_id')
                                ->groupBy('action_logs.post_id')
                                ->get();

        return view('admin.trend_post.index',compact('trendPost'));
    }

    //detail
    public function detail($id){
        $post = Post::where('id',$id)->first();
        return view('admin.trend_post.detail',compact('post'));
    }
}
