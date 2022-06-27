<?php

declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin;

use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class AsdoriaSyliusMarketingCartPlugin
 * @package Asdoria\SyliusMarketingCartPlugin
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
final class AsdoriaSyliusMarketingCartPlugin extends Bundle
{
    use SyliusPluginTrait;
}
