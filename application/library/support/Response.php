<?php
namespace Support;

class Response{

    const RET_CODE_SUCCESS = true;
    const RET_CODE_FAIL = false;

    /**
     * 成功响应
     * @param array $data
     */
    public static function success(array $data = [])
    {
        header('Content-Type:application/json; charset=utf-8');
        $data = ["code" => self::RET_CODE_SUCCESS, "msg" => self::RET_CODE_SUCCESS, "data" => $data];
        echo json_encode($data, JSON_FORCE_OBJECT);
        exit;
    }

    /**
     * 错误响应
     * @param string $message
     */
    public static function fail(string $message)
    {
        header('Content-Type:application/json; charset=utf-8');
        $data = ["code" => self::RET_CODE_FAIL, "msg" => $message, "data" => []];
        echo json_encode($data, JSON_FORCE_OBJECT);
        exit;
    }
}