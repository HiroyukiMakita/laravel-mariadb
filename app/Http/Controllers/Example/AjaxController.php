<?php

namespace App\Http\Controllers\Example;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class AjaxController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'ajax_result' => '文字列取得成功',
        ]);
    }
}
