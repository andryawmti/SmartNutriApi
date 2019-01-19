<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\Classes\ApiResponse;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getAll()
    {
        $rawArticles = Article::all();

        $articles = [];
        foreach ($rawArticles as $a) {
            $articles[] = [
                'id' => $a->id,
                'admin_id' => $a->admin_id,
                'admin_name' => $a->admin->first_name . ' ' . $a->admin->last_name,
                'title' => $a->title,
                'content' => $a->content,
                'photo' => $a->photo,
                'created_at' => date('Y-m-d', strtotime($a->created_at)),
                'updated_at' => date('Y-m-d', strtotime($a->updated_at)),
            ];
        }
        return ApiResponse::data($articles);
    }

    public function get(Article $article)
    {
        $article = [
            'id' => $article->id,
            'admin_id' => $article->admin_id,
            'admin_name' => $article->admin->first_name . ' '. $article->admin->last_name,
            'title' => $article->title,
            'content' => $article->content,
            'photo' => $article->photo,
            'created_at' => date('Y-m-d', strtotime($article['created_at'])),
            'updated_at' => date('Y-m-d', strtotime($article['updated_at'])),
        ];
        return ApiResponse::data($article);
    }
}
