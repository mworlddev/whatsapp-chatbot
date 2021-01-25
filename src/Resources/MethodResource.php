<?php
namespace WhatsappChatbot\Resources;

class MethodResource extends ResourceWithTimestamps
{
    public function makeData(): array
    {
        return [
            'id'        => $this->id,
            'method'    => $this->name
        ];
    }
}
