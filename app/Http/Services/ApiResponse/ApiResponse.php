<?php

namespace App\Http\Services\ApiResponse;

use Illuminate\Http\JsonResponse;
class ApiResponse
{
    private ?string $message = null;

    private mixed $data = null;

    private int $status = 200;

    private array $appends = [];

    public function setData(mixed $data): void
    {
        $this->data = $data;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function setAppends(array $appends): void
    {
        $this->appends = $appends;
    }

    public function response($message = null,$data = null,$status = 200): JsonResponse
    {
        $response = [];
        !is_null($this->message) && $response['message'] = $this->message;
        !is_null($this->data) && $response['data'] = $this->data;
        $response = array_merge($response,$this->appends);
        return response()->json($response,$this->status);
    }
}
