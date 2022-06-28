<?php

declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Factory;


use Asdoria\SyliusMarketingCartPlugin\Model\MarketingCartImageInterface;
use Asdoria\SyliusMarketingCartPlugin\Factory\Model\MarketingCartImageFactoryInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

/**
 * Class MarketingCartImageFactory
 * @package Asdoria\SyliusMarketingCartPlugin\Factory
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class MarketingCartImageFactory implements MarketingCartImageFactoryInterface
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * {@inheritdoc}
     */
    public function createNew(): MarketingCartImageInterface
    {
        /** @var MarketingCartImageInterface $marketingCartImage */
        $marketingCartImage = $this->factory->createNew();

        return $marketingCartImage;
    }

    /**
     * {@inheritdoc}
     */
    public function createForMarketingCart(MarketingCartInterface $marketingCart): MarketingCartImageInterface
    {
        /** @var MarketingCartImageInterface $marketingCartImage */
        $marketingCartImage = $this->createNew();
        $marketingCartImage->setOwner($marketingCart);

        return $marketingCartImage;
    }
}
