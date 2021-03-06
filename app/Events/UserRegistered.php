<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserRegistered extends Event
{
  use SerializesModels;

  public $userData;

  /**
   * Create a new event instance.
   *
   * @return void
   */
  public function __construct($userData)
  {
    $this->userData = $userData;
  }

  /**
   * Get the channels the event should be broadcast on.
   *
   * @return array
   */
  public function broadcastOn()
  {
    return [];
  }
}