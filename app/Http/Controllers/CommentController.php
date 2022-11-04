<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{

    public function index()
    {
        $comments = Comment::all();
        $users = User::all();
        $products  = Product::all();

        $params = [
            'comments' => $comments,
            'users' => $users,
            'products' => $products,
        ];
        return view('admin.comments.index', $params);
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        try {
        $comment->delete();
        return redirect()->route('comments.index')->with('success', 'Xóa thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('comments.index')->with('error', 'Xóa không thành công');
        }
    }

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

    }
}
