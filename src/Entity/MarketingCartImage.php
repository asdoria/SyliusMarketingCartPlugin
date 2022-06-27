<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Entity;

use Sylius\Component\Core\Model\Image;
use Asdoria\SyliusMarketingCartPlugin\Model\MarketingCartImageInterface;

/**
 * Class MarketingCartImage
 * @package Asdoria\SyliusMarketingCartPlugin\Entity
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class MarketingCartImage extends Image implements MarketingCartImageInterface
{

}

