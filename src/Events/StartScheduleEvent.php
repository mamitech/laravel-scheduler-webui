<?php

namespace Acdphp\SchedulePolice\Events;

class StartScheduleEvent extends BaseEvent
{
    public function __construct(string $command)
    {
        parent::__construct('start_schedule', $command);
    }
}
