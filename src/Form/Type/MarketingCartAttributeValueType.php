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

namespace Asdoria\SyliusMarketingCartPlugin\Form\Type;

use Sylius\Bundle\AttributeBundle\Form\Type\AttributeValueType;

class MarketingCartAttributeValueType extends AttributeValueType
{
    public function getBlockPrefix(): string
    {
        return 'asdoria_marketing_cart_attribute_value';
    }
}
