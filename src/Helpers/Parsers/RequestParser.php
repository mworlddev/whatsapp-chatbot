<?php
namespace WhatsappChatbot\Helpers\Parsers;

use App\Models\User;
use Illuminate\Http\Request;
use WhatsappChatbot\Models\Language;
use WhatsappChatbot\Helpers\Classes\ParsedRequest;

class RequestParser
{
    public static function parse(Request $request): ParsedRequest
    {
        $chatID = $request->sender['id'];
        $tmp = explode('@', $chatID);
        $msisdn = $tmp[0];
        $name = $request->sender['verifiedName'];
        $message = $request->content;

        if ($request->sender['isBusiness'] != 'true') {
            $name = $request->sender['pushname'];

            if (empty($name) || is_null($name) || strlen($name) <= 0) {
                $name = " ";
            }
        }

        $parsedRequest = new ParsedRequest([
            'chatID'    => $chatID,
            'chatId'    => $chatID,
            'chatid'    => $chatID,

            'number'    => $msisdn,
            'msisdn'    => $msisdn,

            'name'      => $name,

            'msg'       => $message,
            'message'   => $message,
        ]);

        $parsedRequest->set('user', self::getUser($parsedRequest));

        return $parsedRequest;
    }

    private static function getUser(ParsedRequest $request): User
    {
        $user = User::where('msisdn', $request->number)->first();

        if (!$user) {
            $user = User::create([
                'name'      => $request->name,
                'chat_id'   => $request->chatid,
                'msisdn'    => $request->number,
                'lang_id'   => Language::getDefault()->id,
            ]);
        }

        return $user;
    }
}
