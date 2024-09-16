<?php
class Response{
    const STATUSE = [
        400 => "bad request",
        404 => "not found",
    ];
 
    public function __call($method, $arquments): void{
        $this->response(data:['data'=>[]], code: 404);
    }
    public function response(array $data, $code = 200, $message=''):void{
        if (isset(self::STATUSES[$code])){
            http_response_code(response_code: $code);
            if (!$message){
                $message = self::STATUSES[$code];
            }
            $protocol = $_SERVER['SERVER_PROTOCOL'] ??'HTTP/1.0';
            header(header: $protocol. ' '. $code . ' '. self::STATUSES[$code]);
        }
        header(header:'Content-Type: application/json');
        $response = [
            'data' => $data,
            'message' => $message,
            'code' => $code,
        ];
        echo json_encode(value: $response, flags: JSON_THROW_ON_ERROR);
    }
}
 