<?php

namespace App\RestFulApi;

class ApiResponseBuilder
{

    public function __construct(private readonly ApiResponse $response = new ApiResponse)
    {}
    public  function withMessage(string $message):ApiResponseBuilder
    {
        $this->response->setMessage($message);
        return $this;
    }
    public  function withData(mixed $data):ApiResponseBuilder
    {
        $this->response->setData($data);
        return $this;
    }
    public  function withAppends(array $appends):ApiResponseBuilder
    {
        $this->response->setAppends($appends);
        return $this;
    }

    public  function withStatus(int $status):ApiResponseBuilder
    {
        $this->response->setStatus($status);
        return $this;
    }
    public function build(): ApiResponse
    {
        return $this->response;
    }
}
