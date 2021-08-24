<?php

namespace App\Lib;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

use function app\Helpers\decrypt_column;

trait Aescrypt
{
    /**
     * 暗号化カラムを複合化したものをselectに追加する。
     *
     * モデルのdecrypts配列プロパティに複合化したいカラム名を列挙して使用する。
     *
     * @return Builder
     */
    public function newQuery(): Builder
    {
        $query = parent::newQuery()->select('*');
        foreach ($this->decrypts as $column) {
            $query->addSelect(DB::raw(decrypt_column($column) . " as decrypt_$column"));
        }
        return $query;
    }
}