<?php
namespace WhatsappChatbot\Resources;

class AnswerResource extends ResourceWithTimestamps
{
    public function makeData(): array
    {
        return [
            'id'        => $this->id,
            'key'       => $this->key,
            'parent_id' => $this->parent,
            'texts'     => AnswerTextResource::collection($this->texts)
        ];
    }
}
