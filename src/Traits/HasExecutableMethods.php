<?php
namespace WhatsappChatbot\Traits;

use WhatsappChatbot\Models\MethodMapper;
use WhatsappChatbot\Helpers\Classes\ParsedRequest;

trait HasExecutableMethods
{
    public function method()
    {
        return $this->morphOne(MethodMapper::class, 'methodable');
    }

    public function addMethod(string $method)
    {
        return $this->method()->save(
            new MethodMapper([
                'name'  => $method
            ]) 
        );
    }

    public function hasMethod(): bool
    {
        return !empty($this->method);
    }

    public function executeMethod(ParsedRequest $request)
    {
        return call_user_func_array($this->method->name, [$request]);
    }
}
