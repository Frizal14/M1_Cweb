<?php

namespace Traits;

trait ResponseFormatter {
    public function responseFormatter($code, $message, $data) {
        return json_encode([
            "code" => $code,
            "message" => $message,
            "data" => $data
        ]);
    }
}
