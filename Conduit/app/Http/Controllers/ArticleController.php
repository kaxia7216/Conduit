<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Tag;

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
        $article = new Article();
        $article->title = $request['title'];
        $article->theme = $request['theme'];
        $article->text = $request['text'];
        $article->save();

        //先ほど作成した記事のidを取得
        $article = null;
        $article = new Article();
        $article_id = $article->latest('id')->first();

        //タグ欄が入力されているか
        if ($request['tags'] === "") {
            //何もしない
        } else {
            $tagList = explode(" ", $request['tags']);

            foreach ($tagList as $tag) {
                //タグ名があればidを取得、なければDBに登録
                $tags = Tag::firstOrCreate(['name' => $tag]);
                $tag_id = Tag::where('name', $tag)->get(['id']);
                $article_id->tags()->attach($tag_id);
                $tags = null;
            }
        }

        return redirect('/');
    }

    public function showArticles()
    {
        //topページに表示するブログ記事を取得
        $articleList = Article::all();

        $tagRanking = Tag::withCount('articles')
        ->orderBy('articles_count', 'desc')
        ->limit(10)
        ->get();

        return view('home', compact('articleList', 'tagRanking'));
    }

    public function pickUpArticle($article_id)
    {
        //idをもとに記事を１件取得する
        $article = Article::firstWhere('id', $article_id);
        $setTags = $article->tags()->get();

        $articleComments = Comment::where('article_id', $article_id)->get();

        return view('article', compact('article', 'articleComments', 'setTags'));
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
        $renewArticle = Article::where('id', $article_id);
        $renewArticle->update(['title' => $request['title']]);
        $renewArticle->update(['theme' => $request['theme']]);
        $renewArticle->update(['text' => $request['text']]);

        $article = Article::firstWhere('id', $article_id);

        if ($request['tags'] === "") {
            //何もしない
        } else {
            //タグ名があればidを取得、なければDBに登録
            $tagList = explode(" ", $request['tags']);

            foreach ($tagList as $tag) {
                $tags = Tag::firstOrCreate(['name' => $tag]);
                $tag_id = Tag::where('name', $tag)->get(['id']);
                $article->tags()->attach($tag_id);
                $tags = null;
            }
        }

        //登録したタグをすべて取得
        $setTags = $article->tags()->get();
        $articleComments = Comment::where('article_id', $article_id)->get();

        //記事詳細画面にもどる
        return view('article', compact('article', 'setTags', 'articleComments'));
    }

    public function deleteArticle($article_id)
    {
        //削除する記事のレコードを取得
        $article = Article::firstWhere('id', $article_id);

        //取得したレコードのタグの紐づけを解除(中間テーブルの対応するレコードが削除)
        foreach ($article->tags as $article_tag) {
            $article->tags()->detach($article_tag->id);
        }

        //記事を削除
        $article->delete();

        return redirect('/');
    }

    public function deleteTagFromArticle($article_id, $articleTag_id)
    {
        //タグに対応するレコードを取得
        $article = Article::firstWhere('id', $article_id);

        //取得したレコードのタグの紐づけを解除(中間テーブルの対応するレコードが削除)
        $article->tags()->detach($articleTag_id);
        $editMode = 1;

        return view('create-edit-article', compact('article', 'editMode'));
    }
}
