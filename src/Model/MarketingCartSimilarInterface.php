<?php

declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Model;

use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * Interface MarketingCartSimilarInterface
 * @package Asdoria\SyliusMarketingCartPlugin\Model
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface MarketingCartSimilarInterface extends ResourceInterface
{
    /**
     * @return int
     */
    public function getPosition(): int;

    /**
     * @param int $position
     */
    public function setPosition(int $position): void;

    /**
     * @return MarketingCartInterface|null
     */
    public function getMarketingCart(): ?MarketingCartInterface;

    /**
     * @param MarketingCartInterface|null $marketingCart
     */
    public function setMarketingCart(?MarketingCartInterface $marketingCart): void;

    /**
     * @return MarketingCartInterface|null
     */
    public function getSimilarCart(): ?MarketingCartInterface;

    /**
     * @param MarketingCartInterface|null $similarCart
     */
    public function setSimilarCart(?MarketingCartInterface $similarCart): void;
}
