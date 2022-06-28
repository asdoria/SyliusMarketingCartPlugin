<?php

declare(strict_types=1);


namespace Asdoria\SyliusMarketingCartPlugin\Model\Aware;


use Asdoria\SyliusMarketingCartPlugin\Model\MarketingCartSimilarInterface;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Core\Model\ChannelInterface;

/**
 * Class SimilarCartsAwareInterface
 * @package Asdoria\SyliusMarketingCartPlugin\Model\Aware
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface SimilarCartsAwareInterface
{
    /**
     * @return Collection
     */
    public function getSimilarCarts(): Collection;

    /**
     * @param ChannelInterface $channel
     *
     * @return Collection
     */
    public function getEnabledSimilarCarts(ChannelInterface $channel): Collection;

    /**
     * @param MarketingCartSimilarInterface $cart
     */
    public function addSimilarCart(MarketingCartSimilarInterface $cart): void;

    /**
     * @param MarketingCartSimilarInterface $cart
     */
    public function removeSimilarCart(MarketingCartSimilarInterface $cart): void;

    /**
     * @param MarketingCartSimilarInterface $cart
     *
     * @return bool
     */
    public function hasSimilarCart(MarketingCartSimilarInterface $cart): bool;
}
