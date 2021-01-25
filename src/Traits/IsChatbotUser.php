<?php
namespace WhatsappChatbot\Traits;

use WhatsappChatbot\Models\Answer;
use WhatsappChatbot\Models\Language;
use WhatsappChatbot\Models\UserMessage;
use WhatsappChatbot\Helpers\Classes\ParsedRequest;

trait IsChatbotUser
{
    public function messages()
    {
        return $this->hasMany(UserMessage::class);
    }

    public function getLastMessage()
    {
        return $this->messages->last();
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'lang_id');
    }

    public function addMessageLog(ParsedRequest $request, Answer $answer)
    {
        $latestLog = $this->getLastMessage();

        if (!empty($latestLog)) {
            $latestLog->update(['user_response' => $request->msg]);
        }

        return $this->messages()->save(
            new UserMessage([
                'answer_id'  => $answer->id,
            ])
        );
    }
}
