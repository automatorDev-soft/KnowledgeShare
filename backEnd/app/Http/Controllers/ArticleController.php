<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    //
    public function articleOfUser($id)
    {
        $articles = Article::where('user_id', $id)->get();
        return response()->json(['articles' => $articles, 'status' => 200]);
    }
    public function addArticle(Request $request)
    {
        $article = new Article();
        $article->user_id = $request->user_id;
        $article->title = $request->title;
        $article->content = $request->content;
        $article->save();
        return response()->json(['message' => 'article added', 'status' => 200]);
    }
    public function editArticle(Request $request)
    {
        $article = Article::find($request->id);
        $article->title = $request->title;
        $article->content = $request->content;
        $article->save();
        return response()->json(['message' => 'article edited', 'status' => 200]);
    }
    public function deleteArticle($id)
    {
        $article = Article::find($id);
        $article->delete();
        return response()->json(['message' => 'article deleted', 'status' => 200]);
    }
}
