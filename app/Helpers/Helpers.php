<?php

namespace app\Helpers;


use Illuminate\Support\Facades\DB;

if (!function_exists('aesDecrypt')) {
    /**
     * 複合化
     *
     * @param $column
     * @return string
     */
    function aesDecrypt($column): string
    {
        $key = getAesEncryptKey();

        return "convert(AES_DECRYPT(UNHEX($column), '$key') USING utf8)";
    }
}

if (!function_exists('aesEncrypt')) {
    /**
     * 暗号化
     *
     * @param $value
     * @return string
     */
    function aesEncrypt($value): string
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