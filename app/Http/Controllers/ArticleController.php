<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Resources\Article as ArticleResource;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Article\StoreArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Http\Requests\Article\DestroyArticleRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::paginate(15);
        return ArticleResource::collection($articles);
    }

    /**
     * Display the specified resource.
     *
     * @param  Article $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return new ArticleResource($article);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        $article = new Article;
        $article->title = $request->input('title');
        $article->body = $request->input('body');
        if($request->hasFile('image')){
            $request->file('image')->store('images/articles');
            $article->image = $request->file('image')->hashName();
        }

        if($article->save()) {
            return new ArticleResource($article);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Article $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $article->title = $request->input('title');
        $article->body = $request->input('body');
        if($request->hasFile('image')){
            if($article->image && Storage::exists('images/articles/'.$article->image)){
                Storage::delete('images/articles/'.$article->image);
            }
            $request->file('image')->store('images/articles');
            $article->image = $request->file('image')->hashName();

        } elseif (Storage::exists('images/articles/'.$article->image)) {
            Storage::delete('images/articles/'.$article->image);
            $article->image = null;
        }
        if($article->save()) {
            return new ArticleResource($article);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Article $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyArticleRequest $request, Article $article)
    {
        if($article->image && Storage::exists('images/articles/'.$article->image)){
            Storage::delete('images/articles/'.$article->image);
        }
        if($article->delete()){
            return response()->json(null, 204);
        }
    }
}
