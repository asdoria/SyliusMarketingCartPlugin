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

use Asdoria\SyliusMarketingCartPlugin\Model\MarketingCartAttributeValueInterface;
use Asdoria\SyliusMarketingCartPlugin\Model\MarketingCartInterface;
use Sylius\Component\Attribute\Model\AttributeValue as BaseAttributeValue;
use Webmozart\Assert\Assert;

/*
 * 
 */
class MarketingCartAttributeValue extends BaseAttributeValue implements MarketingCartAttributeValueInterface
{
    public function getMarketingCart(): ?MarketingCartInterface
    {
        $subject = parent::getSubject();

        /** @var MarketingCartInterface|null $subject */
        Assert::nullOrIsInstanceOf($subject, MarketingCartInterface::class);

        return $subject;
    }

    public function setMarketingCart(?MarketingCartInterface $marketingCart): void
    {
        parent::setSubject($marketingCart);
    }
}
