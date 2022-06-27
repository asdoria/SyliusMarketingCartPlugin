<?php

declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Model\Aware;

/**
 * Interface MetaTitleAwareInterface
 * @package Asdoria\SyliusMarketingCartPlugin\Model\Aware
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface MetaTitleAwareInterface
{
    /**
     * @return string|null
     */
    public function getMetaTitle(): ?string;

    /**
     * @param string|null $metaTitle
     */
    public function setMetaTitle(?string $metaTitle): void;
}
