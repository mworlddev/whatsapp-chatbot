<?php
namespace WhatsappChatbot\Models;

use Illuminate\Database\Eloquent\Model;
use WhatsappChatbot\Models\AnswerMapper;
use WhatsappChatbot\Traits\HasExecutableMethods;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Answer extends Model
{
    use HasFactory, HasExecutableMethods;

    protected $fillable = [
        'parent', 'key'
    ];

    public static function withKey(string $key)
    {
        return self::where('key', $key)->first();
    }

    public function parentAnswer()
    {
        return $this->belongsTo(Answer::class, 'parent');
    }

    public function mapper()
    {
        return $this->hasMany(AnswerMapper::class, 'answer_id');
    }

    public function texts()
    {
        return $this->hasMany(AnswerText::class, 'answer_id');
    }

    public function children()
    {
        return $this->hasMany(Answer::class, 'parent');
    }

    public function getTextInLang(int $lang)
    {
        $text = $this->texts()->where('lang_id', $lang)->first();
        
        return $text ? $text->text : null;
    }
}
