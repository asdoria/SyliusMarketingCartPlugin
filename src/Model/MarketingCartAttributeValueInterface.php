<?php

declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Model;

use Asdoria\SyliusMarketingCartPlugin\Model\Aware\MarketingCartAwareInterface;
use Sylius\Component\Attribute\Model\AttributeValueInterface as BaseAttributeValueInterface;

/**
 * Interface MarketingCartAttributeValueInterface
 * @package Asdoria\SyliusMarketingCartPlugin\Model
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface MarketingCartAttributeValueInterface extends BaseAttributeValueInterface, MarketingCartAwareInterface
{

}
