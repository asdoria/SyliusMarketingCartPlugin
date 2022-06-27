<?php

declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Event;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Asdoria\SyliusMarketingCartPlugin\Model\MarketingCartInterface;
use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

class MarketingCartMenuBuilderEvent extends MenuBuilderEvent
{
    /** @var MarketingCartInterface */
    private $marketingCart;

    public function __construct(FactoryInterface $factory, ItemInterface $menu, MarketingCartInterface $marketingCart)
    {
        parent::__construct($factory, $menu);

        $this->marketingCart = $marketingCart;
    }

    public function getMarketingCart(): MarketingCartInterface
    {
        return $this->marketingCart;
    }
}
