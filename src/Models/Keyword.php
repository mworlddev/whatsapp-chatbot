<?php
namespace WhatsappChatbot\Models;

use Illuminate\Database\Eloquent\Model;
use WhatsappChatbot\Traits\HasExecutableMethods;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Keyword extends Model
{
    use HasFactory, HasExecutableMethods;

    protected $fillable = [
        'name'
    ];
}
