<?php

namespace App\Base\DatabaseServiceManger;

use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\Facades\DB;

class DatabaseServiceManager
{
    public function  __invoke(\Closure $action,\Closure $reject = null)
    {
        DB::beginTransaction();
        try{
            $actionResult = $action();
            DB::commit();
        }
        catch (\Throwable $th) {
            DB::rollBack();
            !is_null($reject) && $reject();
            app()[ExceptionHandler::class]->report($th);
            return new DatabaseServiceResult(false,$th->getMessage());
        }

        return new DatabaseServiceResult(true,$actionResult);
    }
}
