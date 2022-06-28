<?php


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
