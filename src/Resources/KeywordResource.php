<?php
namespace WhatsappChatbot\Resources;

class KeywordResource extends ResourceWithTimestamps
{
    public function makeData(): array
    {
        return [
            'id'        => $this->id,
            'keyword'   => $this->name,
            'method'    => new MethodResource($this->method)
        ];
    }
}
