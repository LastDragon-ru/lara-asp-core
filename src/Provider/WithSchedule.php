<?php declare(strict_types = 1);

namespace LastDragon_ru\LaraASP\Core\Provider;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;
use LastDragon_ru\LaraASP\Core\Utils\Scheduler;

/**
 * @phpstan-require-extends ServiceProvider
 */
trait WithSchedule {
    /**
     * @param class-string ...$jobs
     */
    protected function bootSchedule(string ...$jobs): void {
        if (!$this->app->runningInConsole()) {
            return;
        }

        $this->callAfterResolving(
            Schedule::class,
            static function (Schedule $schedule, Container $container) use ($jobs): void {
                $scheduler = $container->make(Scheduler::class);

                foreach ($jobs as $job) {
                    $scheduler->register($schedule, $job);
                }
            },
        );
    }
}
