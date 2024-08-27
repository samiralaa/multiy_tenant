<?php

namespace App\Traits;

trait ApiResponseTrait
{
      public function successResponse($data = null, $status = 200)
    {
        return response()->json([
            'success' => true,
            'data' => $data,
        ], $status);
    }

    /**
     * Send an error response.
     *
     * @param  string|array  $message
     * @param  int  $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse($message, $status)
    {
        return response()->json([
            'success' => false,
            'error' => $message,
        ], $status);
    }

    
}
