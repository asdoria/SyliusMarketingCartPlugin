<?php
declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Traits\Meta;

/**
 * Trait MetaTitleTrait
 * @package Asdoria\SyliusMarketingCartPlugin\Traits\Meta
 */
trait MetaTitleTrait
{
    /** @var string|null */
    protected ?string $metaTitle;

    /**
     * @return string|null
     */
    public function getMetaTitle(): ?string
    {
        return $this->metaTitle;
    }

    /**
     * @param string|null $metaTitle
     */
    public function setMetaTitle(?string $metaTitle): void
    {
        $this->metaTitle = $metaTitle;
    }
}
