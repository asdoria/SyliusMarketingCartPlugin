<?php
declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Traits\Meta;

/**
 * Trait MetaRobotsTrait
 * @package Asdoria\SyliusMarketingCartPlugin\Traits\Meta
 */
trait MetaRobotsTrait
{
    /** @var string|null */
    protected ?string $metaRobots;

    /**
     * @return string|null
     */
    public function getMetaRobots(): ?string
    {
        return $this->metaRobots;
    }

    /**
     * @param string|null $metaRobots
     */
    public function setMetaRobots(?string $metaRobots): void
    {
        $this->metaRobots = $metaRobots;
    }
}
