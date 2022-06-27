<?php
declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Traits\Meta;

/**
 * Trait MetaImageTrait
 * @package Asdoria\SyliusMarketingCartPlugin\Traits\Meta
 */
trait MetaImageTrait
{
    /** @var string|null */
    protected ?string $metaImage;

    /**
     * @return string|null
     */
    public function getMetaImage(): ?string
    {
        return $this->metaImage;
    }

    /**
     * @param string|null $metaImage
     */
    public function setMetaImage(?string $metaImage): void
    {
        $this->metaImage = $metaImage;
    }
}
