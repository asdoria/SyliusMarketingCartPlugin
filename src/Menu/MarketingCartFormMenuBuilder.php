<?php

declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Menu;

use Asdoria\SyliusMarketingCartPlugin\Event\MarketingCartMenuBuilderEvent;
use Asdoria\SyliusMarketingCartPlugin\Model\MarketingCartInterface;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\LegacyEventDispatcherProxy;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface as ContractsEventDispatcherInterface;

class MarketingCartFormMenuBuilder
{
    public const EVENT_NAME = 'asdoria_marketing.menu.admin.marketing_cart.form';

    /** @var FactoryInterface */
    private $factory;

    /** @var EventDispatcherInterface */
    private $eventDispatcher;

    public function __construct(FactoryInterface $factory, EventDispatcherInterface $eventDispatcher)
    {
        $this->factory = $factory;

        if (class_exists('Symfony\Component\EventDispatcher\LegacyEventDispatcherProxy')) {
            /**
             * It could return null only if we pass null, but we pass not null in any case
             *
             * @var ContractsEventDispatcherInterface
             */
            $eventDispatcher = LegacyEventDispatcherProxy::decorate($eventDispatcher);
        }

        $this->eventDispatcher = $eventDispatcher;
    }

    public function createMenu(array $options = []): ItemInterface
    {
        $menu = $this->factory->createItem('root');

        if (!array_key_exists('marketingCart', $options) || !$options['marketingCart'] instanceof MarketingCartInterface) {
            return $menu;
        }

        $menu
            ->addChild('details')
            ->setAttribute('template', '@AsdoriaSyliusMarketingCartPlugin/Admin/MarketingCart/Tab/_details.html.twig')
            ->setLabel('sylius.ui.details')
            ->setCurrent(true);


        $menu
            ->addChild('criteria')
            ->setAttribute('template', '@AsdoriaSyliusMarketingCartPlugin/Admin/MarketingCart/Tab/_criterias.html.twig')
            ->setLabel('asdoria.ui.criteria')
        ;

        $menu
            ->addChild('media')
            ->setAttribute('template', '@AsdoriaSyliusMarketingCartPlugin/Admin/MarketingCart/Tab/_media.html.twig')
            ->setLabel('sylius.ui.media')
        ;

        $menu
            ->addChild('similar_carts')
            ->setAttribute('template', '@AsdoriaSyliusMarketingCartPlugin/Admin/MarketingCart/Tab/_similar_carts.html.twig')
            ->setLabel('asdoria.ui.similar_carts')
        ;


        $this->eventDispatcher->dispatch(
            new MarketingCartMenuBuilderEvent($this->factory, $menu, $options['marketingCart']),
            self::EVENT_NAME
        );


        return $menu;
    }
}
