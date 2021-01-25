<?php
namespace WhatsappChatbot;

use WhatsappChatbot\Api\Commands\GenerateApiUserCommand;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        // 
    }

    public function boot()
    {
        $translationsDir = __DIR__.'/Translations';

        $this->loadMigrationsFrom(__DIR__.'/Migrations');
        $this->loadMigrationsFrom(__DIR__.'/Api/Migrations');

        $this->loadTranslationsFrom($translationsDir, 'chatbot');

        $this->loadRoutesFrom(__DIR__.'/Api/Routes/api.php');

        $this->publishes([
            $translationsDir => resource_path('lang/vendor/chatbot'),
            __DIR__.'/Config/chatbot.php' => config_path('chatbot.php'),
        ]);

        $this->commands([
            GenerateApiUserCommand::class
        ]);
    }
}
