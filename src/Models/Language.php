<?php
namespace WhatsappChatbot\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Language extends Model
{
    use HasFactory;

    public static function getDefault()
    {
        $default = config('chatbot.default_language_code');

        return self::where('code', $default)->first();
    }
}
