<?php

namespace Acdphp\SchedulePolice\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;

class BaseEvent
{
    use InteractsWithSockets;
    use Dispatchable;

    protected $action;
    protected $command;

    public function __construct(string $action, string $command)
    {
        $this->action = $action;
        $this->command = $command;
    }
}
