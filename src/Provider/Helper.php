<?php declare(strict_types = 1);

namespace LastDragon_ru\LaraASP\Core\Provider;

use Closure;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use ReflectionClass;

use function dirname;
use function ltrim;

/**
 * @mixin ServiceProvider
 */
trait Helper {
    /**
     * Should return the name of the package.
     */
    abstract protected function getName(): string;

    /**
     * Returns path relative to class location.
     */
    protected function getPath(string $path): string {
        $class = new ReflectionClass(self::class);
        $path  = dirname((string) $class->getFileName()).'/'.ltrim($path, '/');

        return $path;
    }

    /**
     * @deprecated 5.2.0 Not used anymore and will be removed soon.
     *
     * @param Closure(mixed...): mixed $callback
     */
    protected function callAfterBoot(Closure $callback): void {
        if ($this->app instanceof Application && $this->app->isBooted()) {
            $this->app->call($callback);
        } else {
            $this->booted($callback);
        }
    }
}
