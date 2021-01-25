<?php
namespace WhatsappChatbot\Models;

use Illuminate\Database\Eloquent\Model;
use WhatsappChatbot\Models\AnswerMapper;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MethodMapper extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function methodable()
    {
        return $this->morphTo();
    }
}
