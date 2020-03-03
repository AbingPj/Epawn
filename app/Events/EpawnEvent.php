<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class EpawnEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data;
    
  
    public function __construct($data){
        $this->data = $data;
    }
  
    public function broadCastWith(){
      return [
          'updateType' => $this->data
      ];
    }
  
    public function broadcastOn(){
        // $currentUserId = Auth::user()->id;
        // $postId = $this->data;
        // $postUserId = Post::find($postId)->user->id;
        // if( $currentUserId == $postUserId){
        //     return new Channel('UserPostChannel');
        // }
        return new Channel('EpawnChannel');
    }


}
