<?php

namespace Acdphp\SchedulePolice\Events;

class StopScheduleEvent extends BaseEvent
{
    public function __construct(string $command)
    {
        parent::__construct('stop_schedule', $command);
    }
}
