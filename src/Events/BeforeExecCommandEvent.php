<?php

namespace Acdphp\SchedulePolice\Events;

class BeforeExecCommandEvent extends ExecCommandEvent
{
    public string $state = BaseEvent::START_EXECUTE_COMMAND_STATE;

    public function __construct(string $command)
    {
        parent::__construct($command, true);
    }
}
