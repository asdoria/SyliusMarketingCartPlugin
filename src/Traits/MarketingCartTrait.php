<?php
declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Traits;


use Asdoria\SyliusMarketingCartPlugin\Model\MarketingCartInterface;

/**
 *
 */
trait MarketingCartTrait
{
    /**
     * @var MarketingCartInterface|null
     */
    protected ?MarketingCartInterface $marketingCart;

    /**
     * @return MarketingCartInterface|null
     */
    public function getMarketingCart(): ?MarketingCartInterface
    {
        return $this->marketingCart;
    }

    /**
     * @param MarketingCartInterface|null $marketingCart
     */
    public function setMarketingCart(?MarketingCartInterface $marketingCart): void
    {
        $this->marketingCart = $marketingCart;
    }
}
