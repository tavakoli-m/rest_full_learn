<?php

namespace App\Base\DatabaseServiceManger;

class DatabaseServiceResult
{
    public function __construct(public bool $ok,public mixed $data = null)
    {}
}
