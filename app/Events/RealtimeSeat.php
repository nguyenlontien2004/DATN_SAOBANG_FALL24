<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log; 

class RealtimeSeat implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $id;
    public $ngay;
    public $dataSeat;
    public $idRemove;
    public $connection = 'sync'; // Xử lý đồng bộ, không qua queue
    public function __construct($id, $ngay,$dataSeat,$idRemove)
    {
        $this->id = $id;
        $this->ngay = $ngay;
        $this->dataSeat = $dataSeat;
        $this->idRemove = $idRemove;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('seat.' . $this->id .'.'. $this->ngay),
        ];
    }
    public function broadcastWith(): array
    {
        Log::info('Broadcasting event', [
            'dataSeat'=>$this->dataSeat
        ]);
        return ['dataSeat'=>$this->dataSeat,'idRemove'=>$this->idRemove];
    }
}
