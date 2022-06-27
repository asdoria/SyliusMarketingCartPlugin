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

namespace Asdoria\SyliusMarketingCartPlugin\Generator;

use Asdoria\SyliusMarketingCartPlugin\Model\MarketingCartInterface;

interface MarketingCartSlugGeneratorInterface
{
    public function generate(MarketingCartInterface $marketingCart, ?string $locale = null): string;


    public function generateSlug(string $name, ?string $locale = null): string;
}
