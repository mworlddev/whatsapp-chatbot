<?php

use Illuminate\Support\Facades\Route;
use WhatsappChatbot\Api\Controllers\AnswersController;
use WhatsappChatbot\Api\Controllers\KeywordsController;
use WhatsappChatbot\Api\Middlewares\VerifyUserApiTokenMiddleware;

Route::group(['prefix' => 'api/bot', 'middleware' => [VerifyUserApiTokenMiddleware::class, 'api']], function() {

    Route::group(['prefix' => 'answers'], function() {
        Route::post('/', [AnswersController::class, 'store'])
            ->name('answers-store');

        Route::post('/children/{answer}', [AnswersController::class, 'storeChild'])
            ->name('children-answers-store');
    });

    Route::group(['prefix' => 'keywords'], function() {
        Route::post('/', [KeywordsController::class, 'store'])
            ->name('keywords-store');
    });
});
