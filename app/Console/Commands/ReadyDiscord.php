<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Discord\Discord;
use Discord\Parts\Channel\Message;
use Psr\Http\Message\ResponseInterface;
use React\Http\Browser;
use App\Http\Controllers\SongBotNotificationController;

class ReadyDiscord extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'discord:ready';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ディスコードBotを起動します';

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
        $discord = new Discord([
            'token' => env('DISCORD_API_TOKEN'),
        ]);
        $discord->on('ready', function ($discord) {
            echo "Bot is ready!";
            $discord->on('message', function ($message, $discord) {
                if ($message->author->bot) return;
                SongBotNotificationController::receiveMessage($message);
            });
        });
        $discord->run();
        return 0;
    }
}
