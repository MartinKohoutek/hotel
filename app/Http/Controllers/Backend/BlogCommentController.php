<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogComment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BlogCommentController extends Controller
{
    public function StoreBlogComment(Request $request) {
        BlogComment::insert([
            'user_id' => $request->user_id,
            'post_id' => $request->post_id,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Comment Inserted Successfully! Admin will approved',
            'alert-type' => 'success', 
        ];

        return redirect()->back()->with($notification);
    }

    public function AllComment() {
        $comments = BlogComment::latest()->get();
        return view('backend.blog.all_comment', compact('comments'));
    }

    public function UpdateCommentStatus(Request $request) {
        $comment_id = $request->input('comment_id');
        $is_checked = $request->input('is_checked', 0);

        $comment = BlogComment::find($comment_id);
        if ($comment) {
            $comment->status = $is_checked;
            $comment->save();
        }

        return response()->json(['message' => 'Comment Status Updated Successfully!']);
    }
}
