<?php

namespace App\Http\Controllers\Api;

use App\Models\ActionLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActionLogsController extends Controller
{
    //view count action
    public function action(Request $request){
        $data = [
            'user_id' => $request->user_id,
            'post_id' => $request->post_id
        ];
        ActionLog::create($data);

        $post = ActionLog::where('post_id',$request->post_id)->get();
        return response()->json([
            'post' => $post
        ], 200);
    }
}
