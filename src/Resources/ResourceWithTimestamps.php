<?php
namespace WhatsappChatbot\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

abstract class ResourceWithTimestamps extends JsonResource
{
    abstract public function makeData(): array;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge($this->makeData(), [
            'created_at'    => $this->created_at->format(config("chatbot.default_date_time_format")),
            'updated_at'    => $this->updated_at->format(config("chatbot.default_date_time_format"))
        ]);
    }
}
