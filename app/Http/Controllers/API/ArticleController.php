<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    function index()  {
        $articles = Article::all();
        return response()->json([
            'articles'=>$articles
        ],200);
    }
    function store(Request $request)  {
        $data = $request->validate([
            'title'=> ['required', 'string'],
            'content'=>['required', 'string']
        ]);
        return Article::create($data);
    }
    
    function show(Article $article){
        return response()->json([
            'article'=>$article
        ]);
    }

    function edit(Request $reqeust){
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->save();
        return response()->json(['message' => 'Product updated successfully']);

    }

    function delete(Article $article){
        $article->delete();
        return response(null, 204);
    }
}

