<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DailyAccrualStatus implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data;

    protected $status = [
        'start'     => 'start',
        'finished'  => 'finished'
    ];

    /**
     * DailyAccrualStatus constructor.
     * @param $status
     */
    public function __construct($status = 'start')
    {
        $status = array_key_exists($status, $this->status) ? $this->status[$status] : $this->status['finished'];

        $this->data = [
            'status' => $status
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['accrual'];
    }
}
