<?php
namespace WhatsappChatbot\Helpers\Parsers;

use Exception;
use Carbon\Carbon;
use WhatsappChatbot\Helpers\Classes\ParsedRequest;

class ResponseParser
{
    public const REQUIRED_DATA = [
        "number",
        "msg",
        "chatId",
    ];

    public static function parse(array $data): array
    {
        foreach(self::REQUIRED_DATA as $key) {
            if (!array_key_exists($key, $data)) {
                throw new Exception("{$key} is a required parameter!");
            }
        }

        return [
            "code" =>  "0",
            "msg" => [
                "status" =>  "success",
                // "message_id" =>  1,
                'answer_id' => array_key_exists('answer_id', $data) ? $data['answer_id'] : null,
                "chat_id" =>  $data['chatId'],
                "msisdn" =>  $data['number'],
                "message" =>  [
                    "body" =>  $data['msg'],
                    "type" =>  "text",
                    "caption" =>  null,
                    "extension" =>  null
                ],
                "date" => Carbon::now()->toDateTimeString()
            ]
        ];
    }

    public static function unknownAnswer(ParsedRequest $request)
    {
        return self::parse([
            'number'    => $request->number,
            'msg'       => "You have provided an unknown answer!",
            'chatId'    => $request->chatId,
        ]);
    }

    public static function emptyMessage(ParsedRequest $request)
    {
        return self::parse([
            'number'    => $request->number,
            'msg'       => "You have provided an empty answer!",
            'chatId'    => $request->chatId,
        ]);
    }

    public static function message(ParsedRequest $request, string $msg)
    {
        return self::parse([
            'number'    => $request->number,
            'msg'       => $msg,
            'chatId'    => $request->chatId,
        ]);
    }
}
