<?php
declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Traits\Meta;

/**
 * Trait MetaAltTrait
 * @package Asdoria\SyliusMarketingCartPlugin\Traits\Meta
 */
trait MetaAltTrait
{
    /** @var string|null */
    protected ?string $metaAlt;

    /**
     * @return string|null
     */
    public function getMetaAlt(): ?string
    {
        return $this->metaAlt;
    }

    /**
     * @param string|null $metaAlt
     */
    public function setMetaAlt(?string $metaAlt): void
    {
        $this->metaAlt = $metaAlt;
    }
}
