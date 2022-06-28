<?php

declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Traits;

use Asdoria\SyliusMarketingCartPlugin\Model\MarketingCartSimilarInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Sylius\Component\Core\Model\ChannelInterface;


/**
 * Class SimilarCartsTrait
 *
 * @author Philippe Vesin <pve.asdoria@gmail.com>
 */
trait SimilarCartsTrait
{
    protected Collection $similarCarts;

    protected function initializeSimilarCarts(): void
    {
        $this->similarCarts = new ArrayCollection();
    }

    /**
     * @param MarketingCartSimilarInterface $cart
     */
    public function addSimilarCart(MarketingCartSimilarInterface $cart): void
    {
        if (!$this->hasSimilarCart($cart)) {
            $this->similarCarts->add($cart);
            $cart->setMarketingCart($this);
        }
    }

    /**
     * @param MarketingCartSimilarInterface $cart
     */
    public function removeSimilarCart(MarketingCartSimilarInterface $cart): void
    {
        if ($this->hasSimilarCart($cart)) {
            $this->similarCarts->removeElement($cart);
            $cart->setMarketingCart(null);
        }
    }

    /**
     * @param MarketingCartSimilarInterface $cart
     *
     * @return bool
     */
    public function hasSimilarCart(MarketingCartSimilarInterface $cart): bool
    {
        return $this->similarCarts->contains($cart);
    }

    /**
     * @return Collection
     */
    public function getSimilarCarts(): Collection
    {
        return $this->similarCarts;
    }

    /**
     * @param ChannelInterface $channel
     *
     * @return Collection
     */
    public function getEnabledSimilarCarts(ChannelInterface $channel) : Collection {
        return $this->similarCarts->filter(
            fn(MarketingCartSimilarInterface $similarCart) => $similarCart->isEnabled($channel)
        );
    }
}
