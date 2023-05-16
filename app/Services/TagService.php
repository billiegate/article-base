<?php

namespace App\Services;

use App\Models\Tag;
use App\Traits\ResponseTrait;

class TagService
{
    use ResponseTrait;

    public function __construct(){}

    public function fetchAll($request)
    {
        $limit = $request->has($request->limit) ? $request->limit : config('app.pagination');

        //get all the tags orderby created date
        $tags = Tag::orderBy('created_at', 'DESC')
            ->when($request->search, function ($query) use ($request) {
                $query->where('value', 'LIKE', '%' . $request->search . '%');
            })
            ->when($request->date, function ($query) use ($request) {
                $query->where('created_at', $request->date);
            })
            ->paginate($limit);

        return $this->successResponse($tags);
    }

    public function create($request)
    {
        $data = $request->only([
            'value'
        ]);
        
        //create a new tag
        $existing = Tag::where("value", $data["value"])->first();

        if ( $existing ) {
            return $this->JsonResponse($data, "An tag with similar value already exist.", 200);
        }

        $tag = Tag::create($data);

        return $this->successResponse($tag);
    }

    public function singleTag($tag)
    {
        return $this->successResponse($tag);
    }

    public function updateTag($request, $tag)
    {
        $tag->fill($request->all());
        
        if($tag->isDirty()){
            $tag->update();
        }
        return $this->successResponse($tag);
    }

    public function deleteTag($tag)
    {
        $tag->delete();
        return $this->successResponse($tag, 'Tag Deleted successfully');
    }

}