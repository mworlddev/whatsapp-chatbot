<?php
namespace WhatsappChatbot\Models;

use WhatsappChatbot\Models\Answer;
use WhatsappChatbot\Models\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnswerText extends Model
{
    use HasFactory;

    protected $fillable = [
        'text', 'lang_id', 'answer_id'
    ];

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }

    public function lang()
    {
        return $this->belongsTo(Language::class, 'lang_id');
    }
}
