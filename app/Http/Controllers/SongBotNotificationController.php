<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\Channel;
use Illuminate\Http\Request;
use App\Notifications\LyricsNotification;
use Discord\Parts\Channel\Message;

class SongBotNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $song_id = $request->query('song');
        $chanel = Channel::findOrFail(1);
        $chanel->notify(new LyricsNotification($song_id));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function receiveMessage(Message $message)
    {
        $content = $message->content;
        $song_id = "0";
        if(substr($content, 0, 6) === "!song "){
            $song_id = substr($content, 6);
            $chanel = Channel::findOrFail(1);
            $chanel->notify(new LyricsNotification($song_id));
        };
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Song  $songs
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Song $songs)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\Song  $songs
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Song $songs)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\Song  $songs
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Song $songs)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\Song  $songs
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Song $songs)
    // {
    //     //
    // }
}
