<?php
namespace App\Traits;

/**
 * http response for request
 */
trait ResponseTrait
{
    
    public function JsonResponse($data, $messages = 'Request sucessful', $status = 200)
    {  
        $data = [
            'status'=> $status,
            'message'=> $messages,
            'data' => $data
        ];

        return request()->isJson() ? response()->json($data, $status) : $data;
    }

    public function successResponse($data, $messages = 'Request sucessful', $status = 200)
    {
        return $this->JsonResponse($data, $messages);
    }

}