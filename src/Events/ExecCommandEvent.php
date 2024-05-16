<?php

namespace Acdphp\SchedulePolice\Events;

class ExecCommandEvent extends BaseEvent
{
    public string $state = BaseEvent::FINISH_EXECUTE_COMMAND_STATE;

    public function __construct(string $command, bool $isSuccess)
    {
        parent::__construct(BaseEvent::EXECUTE_COMMAND_ACTION, $command, $isSuccess);
    }
}
