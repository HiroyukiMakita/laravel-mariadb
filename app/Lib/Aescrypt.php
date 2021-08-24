<?php
namespace App\Lib;

trait Aescrypt
{
    /**
     * 暗号化カラムを複合化したものをselectに追加する。
     *
     * モデルのdecrypts配列プロパティに複合化したいカラム名を列挙して使用する。
     *
     * @return $this|\Illuminate\Database\Eloquent\Builder
     */
    public function newQuery()
    {
        $query = parent::newQuery()->select('*');
        foreach ($this->decrypts as $column) {
            $query->addSelect(\DB::raw(decrypt_column($column)." as decrypt_$column"));
        }
        return $query;
    }
}