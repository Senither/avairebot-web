<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Database\Eloquent\Builder;

class ApiController extends BaseController
{
    protected function sendPaginatedQuery(Builder $builder, $perPage = 10, $fields = [])
    {
        $json = $builder->paginate($perPage)->toArray();
        $data = $json['data'];
        unset($json['data']);

        return $this->sendSuccess($data, array_merge([
            '_paginate' => $json
        ], $fields));
    }

    public function sendSuccess($response, $fields = [], $statusCode = 200)
    {
        return response()->json(array_merge([
            'status' => $statusCode,
            'data' => $response,
        ], $fields), $statusCode);
    }

    protected function sendErrorResponse($reason, $status, $fields = [])
    {
        return response()->json(array_merge([
            'status' => $status,
            'reason' => $reason,
        ], $fields), $status);
    }
}
