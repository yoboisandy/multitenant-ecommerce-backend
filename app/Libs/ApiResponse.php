<?php

namespace App\Libs;

class ApiResponse
{
    /**
     * @param mix $message
     * @param string $flag
     * @return void
     */
    public static function success($data = null, $message = null)
    {
        $result = [
            'success' => true
        ];
        if (!empty($data)) {
            $result['data'] = $data;
        }
        if ($message) {
            $result['message'] = $message;
        }
        return $result;
    }
}
