<?php
namespace WhatsappChatbot\Api\Controllers;

use WhatsappChatbot\Models\Answer;
use App\Http\Controllers\Controller;
use WhatsappChatbot\Models\AnswerText;
use WhatsappChatbot\Models\AnswerMapper;
use WhatsappChatbot\Models\MethodMapper;
use WhatsappChatbot\Resources\AnswerResource;
use WhatsappChatbot\Helpers\Classes\ApiResponse;
use WhatsappChatbot\Api\Requests\CreateAnswerRequest;
use WhatsappChatbot\Api\Requests\AddChildToAnswerRequest;

class AnswersController extends Controller
{
    public function store(CreateAnswerRequest $request)
    {
        if (!empty($request->key) && !empty(Answer::withKey($request->key))) {
            return ApiResponse::error("There's an answer already with the key '{$request->key}'");
        }

        $answer = Answer::create([
            'key'       => $request->key
        ]);

        $this->addTextsToAnswer($answer, $request->texts);
        $this->addMethodToAnswer($answer, $request->method);

        return ApiResponse::success([
            'answer'    => new AnswerResource($answer)
        ]);
    }

    public function storeChild(Answer $answer, AddChildToAnswerRequest $request)
    {
        if (!empty($request->key) && !empty(Answer::withKey($request->key))) {
            return ApiResponse::error("There's an answer already with the key '{$request->key}'");
        }

        $child = Answer::create([
            'parent'    => $answer->id,
            'key'       => $request->key
        ]);

        $this->addTextsToAnswer($child, $request->texts);
        $this->addMethodToAnswer($child, $request->method);
        $this->addAnswerMapper($answer, $child, $request->input);

        return ApiResponse::success([
            'parent'    => new AnswerResource($answer),
            'child'     => new AnswerResource($child)
        ]);
    }

    protected function addTextsToAnswer(Answer $answer, array $texts)
    {
        foreach($texts as $lang => $text) {
            if (empty($text)) {
                continue;
            }

            $answer->texts()->save(
                new AnswerText([
                    'lang_id'   => $lang,
                    'text'      => $text
                ])
            );
        }

        return true;
    }

    protected function addMethodToAnswer(Answer $answer, string $method = null)
    {
        if (empty($method)) {
            return false;
        }

        return $answer->method()->save(
            new MethodMapper([
                'name'  => $method
            ]) 
        );
    }

    protected function addAnswerMapper(Answer $answer, Answer $child, string $input)
    {
        return AnswerMapper::create([
            'answer_id' => $answer->id,
            'child_id'  => $child->id,
            'input'     => $input
        ]);
    }
}
