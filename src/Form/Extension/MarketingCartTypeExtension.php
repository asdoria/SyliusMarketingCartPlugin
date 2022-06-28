<?php

declare(strict_types=1);


namespace Asdoria\SyliusMarketingCartPlugin\Form\Extension;


use Asdoria\SyliusFacetFilterPlugin\Form\Extension\AbstractFacetFilterCodeTypeExtension;
use Asdoria\SyliusMarketingCartPlugin\Form\Type\MarketingCartType;

/**
 * Class MarketingCartTypeExtension
 * @package Asdoria\SyliusMarketingCartPlugin\Form\Extension
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class MarketingCartTypeExtension extends AbstractFacetFilterCodeTypeExtension
{
    /**
     * Gets the extended types.
     *
     * @return string[]
     */
    public static function getExtendedTypes(): iterable
    {
        return [MarketingCartType::class];
    }
}
