<?php
namespace WhatsappChatbot\Models;

use App\Models\User;
use WhatsappChatbot\Models\Answer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'answer_id', 'bot_message', 'user_response'
    ];
    
    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
