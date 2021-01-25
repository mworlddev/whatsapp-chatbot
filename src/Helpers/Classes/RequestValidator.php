<?php
namespace WhatsappChatbot\Helpers\Classes;

use Exception;
use Illuminate\Support\Carbon;
use WhatsappChatbot\Handlers\ErrorHandler;
use WhatsappChatbot\Helpers\Classes\ParsedRequest;

class RequestValidator
{
    protected static $invalidDateErrorMsg = "Invalid date!\n- The correct format should be _(date-month-Year)_ e.g. _20-1-2021_\n- The date should be at least 1 day after today";
    protected static $invalidTimeErrorMsg = "Invalid time format! the correct format should be _(hour:minute)_ in 24h format. e.g. _13:00_";

    public static function validateEmpty(ParsedRequest $request)
    {
        if (strlen($request->msg) == 0) {
            ErrorHandler::addError("Empty response");
            return false;
        }

        return true;
    }

    public static function validateDate(string $date)
    {
        try {
            $date = Carbon::createFromFormat("d-m-Y", $date);
        } catch (Exception $e) {
            ErrorHandler::addError(self::$invalidDateErrorMsg);
            return false;
        }

        if ($date !== false && $date->between(now(), now()->addYear())) {
            return true;
        }

        ErrorHandler::addError(self::$invalidDateErrorMsg);
        return false;
    }

    public static function validateTime(string $time)
    {
        try {
            $time = Carbon::createFromFormat("H:i", $time);
        } catch (Exception $e) {
            ErrorHandler::addError(self::$invalidTimeErrorMsg);
            return false;
        }

        if ($time !== false) {
            return true;
        }

        ErrorHandler::addError(self::$invalidTimeErrorMsg);
        return false;
    }

    public static function validateNumber(string $text, int $min = null, int $max = null)
    {
        $isNumeric = is_numeric($text);
        $gtMin = true;
        $ltMax = true;
        
        $errorString = "";

        if (!is_null($min)) {
            $gtMin = (int) $text >= $min;
            $errorString.= "- The number must be greater than or equal to ({$min})\n";
        }

        if (!is_null($max)) {
            $ltMax = (int) $text <= $max;
            $errorString .= "- The number must be less than or equal to <= ({$max})\n";
        }

        if ($isNumeric && $gtMin && $ltMax) {
            return true;
        }

        ErrorHandler::addError("Invalid Number provided!\n{$errorString}");
        return false;
    }

    public static function validatePhoneNumber(string $number)
    {
        if (preg_match("/^\+[0-9]{10,}$/", $number) !== 1) {
            ErrorHandler::addError("Invalid phone number!\nThe number must be in the international format with a + sign at the start and more than 10 digits.");
            return false;
        }

        return true;
    }

    public static function validateLandlineNumber(string $landline, int $digits = 8)
    {
        if (preg_match("/^\+[0-9]{{$digits},}$/", $landline) !== 1) {
            ErrorHandler::addError("Invalid landline number!\nThe number must be in the international format with a + sign at the start followed by the country code and more than 8 digits.");
            return false;
        }

        return true;
    }

    public static function validateEmail(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            ErrorHandler::addError("Invalid email address!");
            return false;
        }

        return true;
    }

    public static function validateFile(string $fileName, bool $optional = false)
    {
        if (
            !file_exists(
                storage_path(
                    "app/".config("chatbot.default_storage_path") . $fileName
                )
            )
        ) {
            if (!$optional) {
                ErrorHandler::addError("Invalid File!");
            }
            return false;
        }

        return true;
    }

    public static function validateOptionalFile(string $fileName)
    {
        return self::validateFile($fileName, true);
    }
}
