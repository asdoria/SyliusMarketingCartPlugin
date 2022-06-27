<?php

declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Model\Aware;

use Asdoria\SyliusMarketingCartPlugin\Model\MarketingCartInterface;

/**
 * Interface MarketingCartAwareInterface
 * @package Asdoria\SyliusMarketingCartPlugin\Model\Aware
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface MarketingCartAwareInterface
{
    public function getMarketingCart(): ?MarketingCartInterface;

    public function setMarketingCart(?MarketingCartInterface $marketingCart): void;
}
