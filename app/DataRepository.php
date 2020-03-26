<?php

namespace App;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


trait DataRepository
{
    private string $tableName;

    public function getAll(): Collection
    {
        return DB::table($this->tableName)->get();
    }

    public function getOneById(int $id): ?object
    {
        return DB::table($this->tableName)->find($id);
    }

    public function getByFieldValue(string $field, string $value): Collection
    {
        return DB::table($this->tableName)->where($field, $value)->get();
    }

    public function addOne(array $dataArr): bool
    {
        return DB::table($this->tableName)->insert($dataArr);
    }

    public function updateOneById(int $id, array $dataArr): int
    {
        return DB::table($this->tableName)->where('id', $id)->update($dataArr);
    }

    public function deleteOneById(int $id): int
    {
        return DB::table($this->tableName)->where('id', $id)->delete();
    }
}
