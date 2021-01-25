<?php
namespace WhatsappChatbot\Resources;

class AnswerTextResource extends ResourceWithTimestamps
{
    public function makeData(): array
    {
        return [
            'id'    => $this->id,
            'lang'  => $this->lang->code,
            'text'  => $this->text
        ];
    }
}
