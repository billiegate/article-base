<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleActionRequest;
use App\Http\Requests\ArticleTagRequest;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Services\ArticleService;

class ArticleController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService){
        $this->articleService = $articleService;
    }

    /**
     * @OA\Get(
     *      path="/articles",
     *      operationId="getArticles",
     *      tags={"Clients"},
     *      summary="Get list of articles",
     *      description="Returns list of articles",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       )
     *     )
     *
     * Returns list of articles
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $article = $this->articleService->fetchAll(request());
        return view('article', compact('article'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        return $this->articleService->create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return $this->articleService->singleArticle($article);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateArticleRequest  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        return $this->articleService->updateArticle($request, $article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        return $this->articleService->deleteArticle($article);
    }

    /**
     * Like the specified resource.
     *
     * @param  \App\Http\Requests\ArticleActionRequest  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function like(ArticleActionRequest $request, Article $article)
    {
        return $this->articleService->likeArticle($request, $article);
    }


    /**
     * View the specified resource.
     *
     * @param  \App\Http\Requests\ArticleActionRequest  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function view(ArticleActionRequest $request, Article $article)
    {
        return $this->articleService->viewArticle($request, $article);
    }


    /**
     * Tag the specified resource.
     *
     * @param  \App\Http\Requests\ArticleTagRequest  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function tag(ArticleTagRequest $request, Article $article)
    {
        return $this->articleService->tag($request, $article);
    }

}
