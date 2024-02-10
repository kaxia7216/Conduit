<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Comment;

class CommentController extends Controller
{
    public function addComment(Request $request, $article_id)
    {
        //コメント追加
        $comment = new Comment();
        $comment->comment = $request['comment'];
        $comment->article_id = $article_id;
        $comment->save();

        //コメントを追加した記事、コメント、タグを取得
        $article = Article::firstWhere('id', $article_id);
        $articleComments = Comment::where('article_id', $article_id)->get();
        $setTags = $article->tags()->get();

        //記事詳細画面にもどる
        return view('article', compact('article', 'articleComments', 'setTags'));
    }

    public function deleteComment($comment_id, $article_id)
    {
        //コメントの削除
        $comment = Comment::where('id', $comment_id);
        $comment->delete();

        //コメントの再取得
        $article = Article::firstWhere('id', $article_id);
        $articleComments = Comment::where('article_id', $article_id)->get();
        $setTags = $article->tags()->get();

        //記事詳細画面にもどる
        return view('article', compact('article', 'articleComments', 'setTags'));
    }
}
