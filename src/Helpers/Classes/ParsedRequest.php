<?php
namespace WhatsappChatbot\Helpers\Classes;

class ParsedRequest
{
    protected $data;

    public function __construct(array $data)
    {
        foreach($data as $key => $value) {
            $this->data[$key] = $value;
        }
    }

    public function __get($key)
    {
        return $this->data[$key];
    }

    public function __set(string $key, $value)
    {
        return $this->set($key, $value);
    }

    public function get(string $key)
    {
        if (!key_exists($key, $this->data)) {
            return null;
        }

        return $this->data[$key];
    }

    public function set(string $key, $value)
    {
        $this->data[$key] = $value;

        return $this;
    }
}
