<?php

declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Model\Aware;

/**
 * Interface MetaImageAwareInterface
 * @package Asdoria\SyliusMarketingCartPlugin\Model\Aware
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface MetaImageAwareInterface
{
    /**
     * @return string|null
     */
    public function getMetaImage(): ?string;

    /**
     * @param string|null $metaImage
     */
    public function setMetaImage(?string $metaImage): void;
}
