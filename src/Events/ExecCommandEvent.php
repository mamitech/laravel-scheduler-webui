<?php

namespace Acdphp\SchedulePolice\Events;

class ExecCommandEvent extends BaseEvent
{
    public function __construct(string $command, bool $isSuccess)
    {
        parent::__construct('exec_command', $command, $isSuccess);
    }
}
