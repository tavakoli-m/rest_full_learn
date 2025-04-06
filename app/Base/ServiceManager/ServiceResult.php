<?php

namespace App\Base\ServiceManager;

class ServiceResult
{
    public function __construct(public bool $ok,public mixed $data = null)
    {}
}
