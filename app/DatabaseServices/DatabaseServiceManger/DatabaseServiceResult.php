<?php

namespace App\DatabaseServices\DatabaseServiceManger;

class DatabaseServiceResult
{
    public function __construct(public bool $ok,public mixed $data = null)
    {}
}
