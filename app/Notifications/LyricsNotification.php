<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Discord\DiscordChannel;
use NotificationChannels\Discord\DiscordMessage;
use App\Models\Song;

class LyricsNotification extends Notification
{
    use Queueable;

    private $song_id;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($song_id)
    {
        $this->song_id = $song_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [DiscordChannel::class];
    }

    public function toDiscord($notifiable)
    {
        $lyrics_arr = $this->getLyrics();
        $lyrics = "";
        foreach ($lyrics_arr as $index => $lyric)
        {
            if ($index === array_key_last($lyrics_arr)) {
                $lyrics = $lyrics.$lyric;
            } else {
                $lyrics = $lyrics.$lyric."\n";
            }
        }
        return DiscordMessage::create("\n",
        ["description"=> $lyrics]);
    }

    private function getLyrics() {
        $data = Song::find($this->song_id);
        $lyrics_arr = [];
        if(isset($data))
        {
            return explode('\n',$data->lyrics);
        }
        return ["そんな歌ないよ"];
    }
}
