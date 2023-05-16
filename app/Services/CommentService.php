<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Comment;
use App\Traits\ResponseTrait;

class CommentService
{
    use ResponseTrait;

    public function __construct(){}

    public function fetchAll($request)
    {
        $limit = $request->has($request->limit) ? $request->limit : config('app.pagination');

        //get all the Comments orderby created date
        $comments = Comment::orderBy('created_at', 'DESC')
            ->when($request->search, function ($query) use ($request) {
                $query->where('value', 'LIKE', '%' . $request->search . '%');
            })
            ->when($request->date, function ($query) use ($request) {
                $query->where('created_at', $request->date);
            })
            ->paginate($limit);

        return $this->successResponse($comments);
    }

    public function create($request)
    {
        $data = $request->only([
            'subject',
            'body',
            'article_id'
        ]);
        
        $data["user_id"] = auth()->user()->id;
        
        //create a new Comment
        $existing = Comment::where([
            ["subject", $data["subject"]],
            ["user_id", $data["user_id"]],
            ["article_id", $data["article_id"]]
        ])->first();

        if ( $existing ) {
            return $this->JsonResponse($data, "A Comment with similar subject already exist.", 200);
        }

        $comment = Comment::create($data);

        return $this->successResponse($comment);
    }

    public function singleComment($comment)
    {
        return $this->successResponse($comment);
    }

    public function updateComment($request, $comment)
    {
        $comment->fill($request->all());
        
        if($comment->isDirty()){
            $comment->update();
        }
        return $this->successResponse($comment);
    }

    public function deleteComment($comment)
    {
        $comment->delete();
        return $this->successResponse($comment, 'Comment Deleted successfully');
    }

    public function comment($request, $article) {

        $data = $request->only([
            'subject',
            'body'
        ]);

        $comment = new Comment($data);

        $article->comments()->save($comment);

        return $this->successResponse($comment);

    }

}