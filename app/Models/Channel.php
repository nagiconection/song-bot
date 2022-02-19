<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Channel extends Model
{
    use HasFactory,Notifiable;

    public function routeNotificationForDiscord()
    {
        return $this->channel_id;
    }
}
