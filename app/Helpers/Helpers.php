<?php

namespace app\Helpers;


use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;

if (!function_exists('aes_decrypt')) {
    /**
     * 複合化
     *
     * @param $column
     * @return string
     */
    function aes_decrypt($column): string
    {
        $key = getAesEncryptKey();

        return "convert(AES_DECRYPT(UNHEX($column), '$key') USING utf8)";
    }
}

if (!function_exists('aes_encrypt')) {
    /**
     * 暗号化
     *
     * @param $value
     * @return Expression
     */
    function aes_encrypt($value): Expression
    {
        $key = getAesEncryptKey();

        return DB::raw("HEX(AES_ENCRYPT('$value', '$key'))");
    }
}

if (!function_exists('getAesEncryptKey')) {
    /**
     * 暗号化キーを取得する。
     *
     * @return string
     */
    function getAesEncryptKey(): string
    {
        $key = config("app.key");
        return str_replace('base64:', '', $key);
    }
}