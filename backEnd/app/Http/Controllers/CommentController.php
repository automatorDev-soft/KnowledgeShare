<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function commentOfPost($id, $type)
    {
        switch ($type) {
            case 'article':
                $comments = Comment::where('article_id', $id)->get();
                break;
            case 'course':
                $comments = Comment::where('course_id', $id)->get();
                break;
            default:
                $comments = Comment::all();
                break;
        }
        return response()->json(['comments' => $comments, 'status' => 200]);
    }

    public function commentOfUser($id)
    {
        $comments = Comment::where('user_id', $id)->get();
        return response()->json(['comments' => $comments, 'status' => 200]);
    }

    public function addComment(Request $request)
    {
        $comment = new Comment();
        $comment->user_id = $request->user_id;
        $comment->article_id = $request->article_id;
        $comment->course_id = $request->course_id;
        $comment->content = $request->content;
        $comment->save();
        return response()->json(['message' => 'comment added', 'status' => 200]);
    }
    public function editComment(Request $request)
    {
        $comment = Comment::find($request->id);
        $comment->content = $request->content;
        $comment->save();
        return response()->json(['message' => 'comment edited', 'status' => 200]);
    }
    public function deleteComment($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return response()->json(['message' => 'comment deleted', 'status' => 200]);
    }
}
