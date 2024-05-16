<?php

namespace Acdphp\SchedulePolice\Events;

class StartScheduleEvent extends BaseEvent
{
    public function __construct(string $command)
    {
        parent::__construct(BaseEvent::START_SCHEDULE_ACTION, $command);
    }
}
