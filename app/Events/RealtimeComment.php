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

class RealtimeComment implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $ten;
    public $idPhim;
    public $noidung;
    public $anh;
    public $ngaybinhluan;
    public $userId;
    public $connection = 'sync'; // Xử lý đồng bộ, không qua queue
    public function __construct($ten,$idPhim,$noidung,$anh,$ngaybinhluan,$userId)
    {
        $this->ten = $ten;
        $this->idPhim = $idPhim;
        $this->noidung = $noidung;
        $this->anh = $anh;
        $this->ngaybinhluan = $ngaybinhluan;
        $this->userId = $userId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('binhLuan.phim.'.$this->idPhim),
        ];
    }
    public function broadcastWith(): array
    {
        Log::info('check', [
            'noidung'=>$this->noidung,
        ]);
        return ['noidung'=>$this->noidung,'ten'=>$this->ten,'ngay'=>$this->ngaybinhluan,'anh'=>$this->anh];
    }
}
