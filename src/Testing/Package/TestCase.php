<?php declare(strict_types = 1);

namespace LastDragon_ru\LaraASP\Core\Testing\Package;

use LastDragon_ru\LaraASP\Core\Provider;
use LastDragon_ru\LaraASP\Testing\Testing\TestCase as PackageTestCase;
use Override;

use function array_merge;

/**
 * @internal
 */
abstract class TestCase extends PackageTestCase {
    /**
     * @inheritDoc
     */
    #[Override]
    protected function getPackageProviders(mixed $app): array {
        return array_merge(parent::getPackageProviders($app), [
            Provider::class,
        ]);
    }
}
