<?php
namespace WhatsappChatbot\Models;

use WhatsappChatbot\Models\Answer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnswerMapper extends Model
{
    use HasFactory;

    protected $fillable = [
        'answer_id', 'child_id', 'input'
    ];

    public function child()
    {
        return $this->belongsTo(Answer::class, 'child_id');
    }

    public function parent()
    {
        return $this->belongsTo(Answer::class, 'answer_id');
    }
}
