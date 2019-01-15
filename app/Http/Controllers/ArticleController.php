<?php

namespace App\Http\Controllers;

use App\Article;
use App\Classes\MyHttpResponse;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index()
    {
        return view('manage.article.index', ['articles' => Article::all()]);
    }

    public function store()
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'content' => ['required', 'min:3'],
            'photo_url' => 'required'
        ]);

        try {
            $article = new Article();
            $article->admin_id = auth()->user()->id;
            $article->title = request('title');
            $article->content = request('content');
            $article->photo = request('photo_url');

            $article->save();

            return MyHttpResponse::storeResponse(true, 'Article Successfully Created', 'article.index');
        } catch (\Exception $e) {
            return MyHttpResponse::storeResponse(false, $e->getMessage(), 'article.index');
        }
    }

    public function show(Article $article)
    {
        return view('manage.article.edit', ['article' => $article]);
    }

    public function update(Article $article)
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'content' => ['required', 'min:3'],
            'photo_url' => 'required'
        ]);

        try {
            $article->admin_id = auth()->user()->id;
            $article->title = request('title');
            $article->content = request('content');
            $article->photo = request('photo_url');

            $article->save();

            return MyHttpResponse::updateResponse(true, 'Article Successfully Updated', 'article.show', $article->id);
        } catch (\Exception $e) {
            return MyHttpResponse::updateResponse(false, $e->getMessage(), 'article.show', $article->id);
        }
    }

    public function destroy(Article $article)
    {
        try {
            $article->delete();
            return MyHttpResponse::deleteResponse(true, 'Article Successfully Deleted', 'article.index');
        } catch (\Exception $e) {
            return MyHttpResponse::deleteResponse(false, $e->getMessage(), 'article.index');
        }
    }

    public function uploadPhoto()
    {
        $success = false;
        $url = '';
        if (request()->hasFile('file')) {
            $path = Storage::putFile('public/article_photo', request()->file('file'));
            $url =  Storage::url($path);
            $success = true;
        }

        return json_encode([
            'success' => $success,
            'url' => $url,
        ]);
    }
}
