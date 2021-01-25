<?php
namespace WhatsappChatbot\Api\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'token'
    ];
}
