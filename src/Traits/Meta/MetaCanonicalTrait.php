<?php
declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Traits\Meta;

/**
 * Trait MetaCanonicalTrait
 * @package Asdoria\SyliusMarketingCartPlugin\Traits\Meta
 */
trait MetaCanonicalTrait
{
    /** @var string|null */
    protected ?string $metaCanonical;

    /**
     * @return string|null
     */
    public function getMetaCanonical(): ?string
    {
        return $this->metaCanonical;
    }

    /**
     * @param string|null $metaCanonical
     */
    public function setMetaCanonical(?string $metaCanonical): void
    {
        $this->metaCanonical = $metaCanonical;
    }
}
