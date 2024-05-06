<?php

use Acdphp\SchedulePolice\Data\ExecResult;
use Acdphp\SchedulePolice\Events\ExecCommandEvent;
use Acdphp\SchedulePolice\Events\StartScheduleEvent;
use Acdphp\SchedulePolice\Events\StopScheduleEvent;
use Acdphp\SchedulePolice\Http\Middleware\RestrictedAccess;
use Acdphp\SchedulePolice\Services\SchedulePoliceService;
use Illuminate\Support\Facades\Event;

it('has an index page', function () {
    $this->withoutMiddleware([RestrictedAccess::class]);

    $this->mock(SchedulePoliceService::class, function ($service) {
        $service->shouldReceive('isConfigured')
            ->once()
            ->andReturn(true);

        $service->shouldReceive('getScheduledEvents')
            ->once();
    });

    $this->get(route('schedule-police.index'))
        ->assertOk();
});

it('cannot access index page on non local', function () {
    $this->get(route('schedule-police.index'))
        ->assertForbidden();
});

it('can stop scheduled event', function () {
    Event::fake();
    $this->withoutMiddleware([RestrictedAccess::class]);

    $this->mock(SchedulePoliceService::class, function ($service) {
        $service->shouldReceive('stopSchedule')
            ->once()
            ->with('inspire', '* * * * *');
    });

    $this->post(route('schedule-police.stop'), [
        'key' => 'inspire',
        'expression' => '* * * * *',
    ])
        ->assertRedirectToRoute('schedule-police.index');

    Event::assertDispatched(StopScheduleEvent::class);
});

it('can start scheduled event', function () {
    Event::fake();
    $this->withoutMiddleware([RestrictedAccess::class]);

    $this->mock(SchedulePoliceService::class, function ($service) {
        $service->shouldReceive('startSchedule')
            ->once()
            ->with('inspire', '* * * * *');
    });

    $this->post(route('schedule-police.start'), [
        'key' => 'inspire',
        'expression' => '* * * * *',
    ])
        ->assertRedirectToRoute('schedule-police.index');

    Event::assertDispatched(StartScheduleEvent::class);
});

it('can execute commands', function () {
    Event::fake();
    $this->withoutMiddleware([RestrictedAccess::class]);

    $this->mock(SchedulePoliceService::class, function ($service) {
        $service->shouldReceive('execCommand')
            ->once()
            ->with('inspire')
            ->andReturn(new ExecResult('Message', false));
    });

    $this->post(route('schedule-police.exec'), [
        'command' => 'inspire',
    ])
        ->assertRedirect(route('schedule-police.index').'#v-execute');

    Event::assertDispatched(ExecCommandEvent::class);
});
