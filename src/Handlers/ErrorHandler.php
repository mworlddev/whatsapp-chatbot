<?php
namespace WhatsappChatbot\Handlers;

use WhatsappChatbot\Helpers\Classes\ParsedRequest;
use WhatsappChatbot\Helpers\Parsers\ResponseParser;

class ErrorHandler
{
    protected static $errors = [];

    public static function addError(string $error)
    {
        self::$errors[] = $error;
    }

    public static function genericError()
    {
        return self::addError("Error!");
    }

    public static function clear()
    {
        self::$errors = [];

        return true;
    }

    public static function hasErrors()
    {
        return !empty(self::$errors);
    }

    public static function toString()
    {
        if (!self::hasErrors()) {
            return "";
        }

        return implode("\n", self::$errors);
    }

    public static function toResponse(ParsedRequest $request)
    {
        $string = "*We encountered some errors while processing your request!*\n\n";
        $string .= self::toString();

        return ResponseParser::message($request, $string);
    }
}
