<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Comment;

class CommentController extends Controller
{
    function index(Article $article)  {
        $comments = $article->comments;
        return response()->json([
            'comments'=>$comments
        ]);
    }
    function store(Request $request, Article $article)  {
        $request->validate([
            'message' => 'required',
        ]);
        $comment = new Comment([
            'name' => $request->input('name'),
          
            'message' => $request->input('message'),
        ]);

        $article->comments()->save($comment);

        return response()->json([
            'status' => 'success',
            'message' => 'Comment added successfully',
            'data' => $comment,
        ]);
        
    }

    function delete(Request $reqeust, Article $article, Comment $comment){
        $comment->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Comment deleted successfully',
        ]);
    }
}
