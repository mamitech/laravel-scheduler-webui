<?php

namespace Acdphp\SchedulePolice\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;

class BaseEvent
{
    use InteractsWithSockets;
    use Dispatchable;

    public const START_SCHEDULE_ACTION = 'start_schedule';
    public const STOP_SCHEDULE_ACTION = 'stop_schedule';
    public const EXECUTE_COMMAND_ACTION = 'exec_command';

    public const START_EXECUTE_COMMAND_STATE = 'start';
    public const FINISH_EXECUTE_COMMAND_STATE = 'finish';

    public function __construct(public string $action, public string $command, public bool $isSuccess = true)
    {
    }
}
