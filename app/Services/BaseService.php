<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class BaseService
{
    public function withTransaction(callable $callback)
    {
        DB::beginTransaction();
        try {
            $result = $callback();

            DB::commit();
            return $result;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
