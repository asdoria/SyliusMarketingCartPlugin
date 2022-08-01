<?php

declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

/**
 * Class ComparatorExtension
 * @package Asdoria\SyliusMarketingCartPlugin\Twig
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class MarketingCartExtension extends AbstractExtension
{
    /**
     * @return TwigFunction[]
     */
    public function getFilters()
    {
        return [
            new TwigFilter('mc_json_decode', [$this, 'jsonDecode']),
        ];
    }

    public function jsonDecode(string $data): mixed {
        return json_decode($data);
    }
}
