<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function add_comment( Request $request)
    {
        $request_data = $request->all();
        $comment_name = $request_data['data'];
        $product_id = $request_data['product_id'];
        $user =  Auth::user();
        $user_id = $user['id'];
        $comment = new Comment();
        $comment->comment_name = $comment_name;
        $comment->user_id = $user_id;
        $comment->product_id = $product_id;
        $comment->save();
        session()->flash('success', 'Đã cập nhật bình luận của bạn');
        
        
        // echo "<pre>";
        // print_r($request_data);
        // echo "</pre>";
        // die();

    }
}
