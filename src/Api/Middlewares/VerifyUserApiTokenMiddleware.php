<?php
namespace WhatsappChatbot\Api\Middlewares;

use Closure;
use Illuminate\Http\Request;
use WhatsappChatbot\Api\Models\ApiUser;
use WhatsappChatbot\Helpers\Classes\ApiResponse;

class VerifyUserApiTokenMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!ApiUser::where('token', $request->user_token)->first()) {
            return ApiResponse::error("Invalid token!", 401);
        }

        return $next($request);
    }
}
