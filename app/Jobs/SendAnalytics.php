<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class SendAnalytics implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $eventData;
    public function __construct(array $eventData)
    {
        $this->eventData = $eventData;
    }
    public function handle(): void
    {
        \Amqp::publish(
            '',
            json_encode($this->eventData),
            ['queue' => env('RABBITMQ_QUEUE', 'analytics_queue')]
        );
    }
}
