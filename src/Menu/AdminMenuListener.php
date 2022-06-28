<?php

declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Menu;

use Knp\Menu\ItemInterface;
use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class AdminMenuListener
{
    /**
     * @param MenuBuilderEvent $event
     */
    public function addAdminMenuItems(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();

        $item = $menu->getChild('marketing');

        $item
            ->addChild('marketing_carts', [
                'route' => 'asdoria_admin_marketing_cart_index',
            ])
            ->setLabel('asdoria.ui.marketing_carts')
            ->setLabelAttribute('icon', 'cart');
    }

}
