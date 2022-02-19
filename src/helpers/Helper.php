<?php

namespace Pipedev\Lazerpay\helpers;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class Helper {

    public function generateReference(int $len): string
    {

        $hex = md5(Config::get('lazerpay.lazer_secret_key'). uniqid("", true));

        $pack = pack('H*', $hex);
        $tmp =  base64_encode($pack);

        $uid = preg_replace("#(*UTF8)[^A-Za-z0-9]#", "", $tmp);

        $len = max(4, min(128, $len));

        while (strlen($uid) < $len)
            $uid .= $this->generateReference(22);

        return substr($uid, 0, $len);
    }


    protected static function dataResponse($message, $data = null, $status = "success", $statusCode = null): JsonResponse
    {
        if (!$statusCode) {
            if ($status == "error") {
                $statusCode = ResponseAlias::HTTP_BAD_REQUEST;
            } else {
                $statusCode = ResponseAlias::HTTP_OK;
            }
        }

        return new JsonResponse([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }
}
