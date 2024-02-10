<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function forCreateArticle()
    {
        //新規作成画面を表示
        $editMode = 0;

        return view('create-edit-article', compact('editMode'));
    }

    public function createArticle(Request $request)
    {
        //新規記事を作成
        $article = new Article;
        $article->title = $request['title'];
        $article->theme = $request['theme'];
        $article->text = $request['text'];
        $article->save();

        return redirect('/');
    }

    public function showArticles()
    {
        //topページに表示するブログ記事を取得
        $articleList = Article::all();

        return view('home', compact('articleList'));
    }

    public function pickUpArticle($article_id)
    {
        //idをもとに記事を１件取得する
        $article = Article::firstWhere('id', $article_id);

        return view('article', compact('article'));
    }

    public function forEditArticle($article_id)
    {
        $article = Article::firstWhere('id', $article_id);
        $editMode = 1;

        return view('create-edit-article', compact('article', 'editMode'));
    }

    public function editArticle(Request $request, $article_id)
    {
        //記事の内容を更新
        $article = Article::where('id', $article_id);
        $article->update(['title' => $request['title']]);
        $article->update(['theme' => $request['theme']]);
        $article->update(['text' => $request['text']]);


        return redirect('/');
    }

    public function deleteArticle($article_id)
    {
        //idに対応する記事を削除
        $article = Article::where('id', $article_id);
        $article->delete();

        return redirect('/');
    }
}
