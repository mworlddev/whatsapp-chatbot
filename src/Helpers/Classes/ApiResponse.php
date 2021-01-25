<?php
namespace WhatsappChatbot\Helpers\Classes;

class ApiResponse
{
    public static function success(array $data = [])
    {
        return self::send(200, true, $data);
    }

    public static function error(string $error, int $status = 422)
    {
        $data = [
            'error' => $error
        ];

        return self::send($status, false, $data);
    }

    private static function send(int $status, bool $success, array $data)
    {
        $data = array_merge($data, [
            'success' => $success
        ]);

        return response()->json($data, $status);
    }
}
