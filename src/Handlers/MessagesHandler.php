<?php
namespace WhatsappChatbot\Handlers;

use Illuminate\Http\Request;
use WhatsappChatbot\Models\Answer;
use WhatsappChatbot\Models\Keyword;
use WhatsappChatbot\Handlers\ErrorHandler;
use WhatsappChatbot\Helpers\Parsers\RequestParser;
use WhatsappChatbot\Helpers\Parsers\ResponseParser;
use WhatsappChatbot\Helpers\Classes\RequestValidator;

class MessagesHandler
{
    public static function handle(Request $request)
    {
        $request = RequestParser::parse($request);
        RequestValidator::validateEmpty($request);

        if (ErrorHandler::hasErrors()) {
            return ErrorHandler::toResponse($request);
        }

        $lastMessage = $request->user->getLastMessage();
        
        if (!$lastMessage) {
            $answer = Answer::withKey('default');
            $request->user->addMessageLog($request, $answer);

            return ResponseParser::parse([
                'answer_id' => $answer->id,
                'chatId'    => $request->chatid,
                'number'    => $request->number,
                'msg'       => $answer->getTextInLang($request->user->lang_id),
            ]);
        }

        $keyword = Keyword::where('keyword', strtolower($request->msg))->first();

        if (!empty($keyword)) {
            return $keyword->executeMethod($request);
        }

        $mapper = $lastMessage->answer->mapper()
            ->whereIn('input', [$request->msg, '*'])
            ->first();

        if (!$mapper) {
            ErrorHandler::addError("Unmapped Response!");
            return ErrorHandler::toResponse($request);
        }

        $answer = $mapper->child;

        if (!$answer) {
            ErrorHandler::addError("Unknown Answer!");
            return ErrorHandler::toResponse($request);
        }

        $request->user->addMessageLog($request, $answer);

        if ($answer->hasMethod()) {
            return $answer->executeMethod($request);
        }

        $message = $answer->getTextInLang($request->user->lang_id);

        return ResponseParser::parse([
            'answer_id' => $answer->id,
            'chatId'    => $request->chatid,
            'number'    => $request->number,
            'msg'       => $message,
        ]);
    }
}
