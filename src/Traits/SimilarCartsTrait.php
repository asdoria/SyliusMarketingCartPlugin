<?php

declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Traits;

use Doctrine\Common\Collections\Collection;


/**
 * Class SimilarCartsTrait
 *
 * @author Philippe Vesin <pve.asdoria@gmail.com>
 */
trait SimilarCartsTrait
{
    /**
     * @var Collection|MarketingCartSimilarInterface[]
     */
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
}
