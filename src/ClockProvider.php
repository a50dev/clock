<?php

declare(strict_types=1);

namespace A50\Clock;

use A50\Container\ServiceProvider;
use Psr\Clock\ClockInterface;
use Psr\Container\ContainerInterface;

final class ClockProvider implements ServiceProvider
{
    public static function getDefinitions(): array
    {
        return [
            ClockConfig::class => static fn () => ClockConfig::withDefaults(),
            ClockInterface::class => static function (ContainerInterface $container) {
                /** @var ClockConfig $config */
                $config = $container->get(ClockConfig::class);

                return new TimeZoneAwareClock($config->timezone());
            },
        ];
    }

    public static function getExtensions(): array
    {
        return [];
    }
}
