<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Tag;
use App\Traits\ResponseTrait;
use App\Models\User;

class ArticleService
{
    use ResponseTrait;

    public function __construct(){}

    public function fetchAll($request)
    {
        $limit = $request->has($request->limit) ? $request->limit : config('app.pagination');

        //get all the articles orderby created date
        $articles = Article::orderBy('created_at', 'DESC')
            ->withCount (['likes', 'views'])
            ->with(['comments', 'tags'])
            ->when($request->search, function ($query) use ($request) {
                $query->where('title', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('description', 'LIKE', '%' . $request->search . '%');
            })
            ->when($request->date, function ($query) use ($request) {
                $query->where('created_at', $request->date);
            })
            ->when($request->user, function ($query) use ($request) {
                $query->where('user_id', $request->user);
            })
            ->paginate($limit);

        return $this->successResponse($articles);
    }

    public function create($request)
    {
        $data = $request->only([
            'title',
            'description',
            'thumbnail'
        ]);
        
        $data["user_id"] = auth()->user()->id;
        //create a new article
        $existing = Article::where([
            ["title", $data["title"]],
            ["user_id", $data["user_id"]]
        ])->first();

        if ( $existing ) {
            return $this->JsonResponse($data, "An article with similar title already exist.", 401);
        }

        $article = Article::create($data);

        return $this->successResponse($article);
    }

    public function singleArticle($article)
    {
        $article = $article->withCount (['likes', 'views'])
                    ->with(['comments', 'tags']);
        return $this->successResponse($article);
    }

    public function updateArticle($request, $article)
    {
        $article->fill($request->all());
        
        if($article->isDirty()){
            $article->update();
        }
        return $this->successResponse($article);
    }

    public function deleteArticle($article)
    {
        $article->delete();
        return $this->successResponse($article, 'Article Deleted successfully');
    }

    public function fetchUserArticles() {
        return $this->successResponse(auth()->user()->articles, "User article fetched!");
    }

    public function likeArticle($article, $request)
    {
        $user = $request->user_id ? User::findOrFail($request->user_id) : auth()->user();

        if ( $user->hasLiked($article) ) {
            return $this->successResponse([], "Comment already liked!");
        }

        $user->likes()->save($user);

        return $this->successResponse([], "Comment liked!");
    }

    public function viewArticle($article, $request)
    {
        $user = $request->user_id ? User::findOrFail($request->user_id) : auth()->user();

        if ( $user->hasViewed($article) ) {
            return $this->successResponse([], "Comment already viewed!");
        }

        $user->views()->save($user);

        return $this->successResponse([], "Comment viewed!");
    }

    public function tag($article, $request)
    {
        $tag = Tag::firstOrCreate([
            'value' => $request->value
        ], [
            'value' => $request->value
        ]);

        if ( $article->hasTag($tag) ) {
            return $this->successResponse([], "Article already has tag!");
        }

        $article->elections()->attach($tag);

        return $this->successResponse([], "Article tagged!");
    }

    
}