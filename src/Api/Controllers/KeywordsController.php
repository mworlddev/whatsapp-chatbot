<?php
namespace WhatsappChatbot\Api\Controllers;

use WhatsappChatbot\Models\Keyword;
use App\Http\Controllers\Controller;
use WhatsappChatbot\Resources\KeywordResource;
use WhatsappChatbot\Helpers\Classes\ApiResponse;
use WhatsappChatbot\Api\Requests\CreateKeywordRequest;

class KeywordsController extends Controller
{
    public function store(CreateKeywordRequest $request)
    {
        $keyword = Keyword::create([
            'name'  => $request->keyword
        ]);

        $keyword->addMethod($request->method);

        return ApiResponse::success([
            'keyword'   => new KeywordResource($keyword)
        ]);
    }
}
