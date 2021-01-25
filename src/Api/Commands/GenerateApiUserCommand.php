<?php
namespace WhatsappChatbot\Api\Commands;


use Illuminate\Support\Str;
use Illuminate\Console\Command;
use WhatsappChatbot\Api\Models\ApiUser;

class GenerateApiUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apiuser:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new API User';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $token = Str::random(20);

        ApiUser::create([
            'token'  => $token
        ]);

        $this->info("API User Generated!");
        $this->info("Token is: {$token}");

        return 0;
    }
}
