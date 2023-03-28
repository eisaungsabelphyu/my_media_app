<?php

namespace App\Http\Controllers\Api;

use App\Models\Reaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReactionController extends Controller
{
    //when react
    public function react(Request $request){
                $reactData = $this->getReactData($request);
                 $data = [
                            'user_id' => $request->user_id,
                            'post_id' => $request->post_id,
                            'like_unlike_status' => $request->status,
                        ];
                if(!isset($reactData)){
                        $reactPost = Reaction::create($data);
                            return response()->json([
                                'reactPost' => $reactPost
                            ], 200);

                }else{
                    $reactPost = Reaction::where('user_id',$request->user_id)
                                    ->where('post_id',$request->post_id)
                                    ->update(['like_unlike_status' => $request->status]);
                                    return response()->json([
                                        'reactPost' => $reactPost
                                    ], 200);
                }
    }

    //get react data
    public function reactData(Request $request){

        $reactData = $this->getReactData($request);
        $totalReact = $this->totalReact($request);
        return response()->json([
            'reactData' => $reactData,
            'totalReact' => $totalReact,
        ], 200);
    }

   private function totalReact($request){
    return Reaction::where('post_id',$request->post_id)
            ->where('like_unlike_status',1)->get();
   }

    private function getReactData($request){

        return Reaction::where('user_id',$request->user_id)
                ->where('post_id',$request->post_id)
                ->first();

    }
}
