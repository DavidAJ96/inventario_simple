<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;

class BaseRepository {
    public function iniciarTransaccion() {
        DB::beginTransaction();
    }

    public function commit() {
        DB::commit();
    }

    public function rollback() {
        DB::rollBack();
    }
}
