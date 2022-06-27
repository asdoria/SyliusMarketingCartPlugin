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

namespace Asdoria\SyliusMarketingCartPlugin\Form\EventSubscriber;

use Asdoria\SyliusMarketingCartPlugin\Model\MarketingCartAttributeValueInterface;
use Asdoria\SyliusMarketingCartPlugin\Model\MarketingCartInterface;
use Sylius\Component\Attribute\Model\AttributeValueInterface;
use Sylius\Component\Product\Model\ProductAttributeInterface;
use Sylius\Component\Product\Model\ProductAttributeValueInterface;
use Sylius\Component\Product\Model\ProductInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Translation\Provider\TranslationLocaleProviderInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Webmozart\Assert\Assert;

class BuildAttributesFormSubscriber implements EventSubscriberInterface
{
    public function __construct(
        protected FactoryInterface                   $attributeValueFactory,
        protected TranslationLocaleProviderInterface $localeProvider
    )
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::POST_SUBMIT  => 'postSubmit',
        ];
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function preSetData(FormEvent $event): void
    {
        $marketingCart = $event->getData();

        /** @var MarketingCartInterface $marketingCart */
        Assert::isInstanceOf($marketingCart, MarketingCartInterface::class);

        $defaultLocaleCode = $this->localeProvider->getDefaultLocaleCode();

        $attributes = $marketingCart->getAttributes()->filter(
            function (MarketingCartAttributeValueInterface $attribute) use ($defaultLocaleCode) {
                return $attribute->getLocaleCode() === $defaultLocaleCode;
            }
        );

        /** @var MarketingCartAttributeValueInterface $attribute */
        foreach ($attributes as $attribute) {
            $this->resolveLocalizedAttributes($marketingCart, $attribute);
        }
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function postSubmit(FormEvent $event): void
    {
        $marketingCart = $event->getData();

        /** @var MarketingCartInterface $marketingCart */
        Assert::isInstanceOf($marketingCart, MarketingCartInterface::class);

        /** @var AttributeValueInterface $attribute */
        foreach ($marketingCart->getAttributes() as $attribute) {
            if (null === $attribute->getValue()) {
                $marketingCart->removeAttribute($attribute);
            }
        }
    }

    private function resolveLocalizedAttributes(MarketingCartInterface $marketingCart, MarketingCartAttributeValueInterface $attribute): void
    {
        $localeCodes = $this->localeProvider->getDefinedLocalesCodes();

        foreach ($localeCodes as $localeCode) {
            if (!$marketingCart->hasAttributeByCodeAndLocale($attribute->getCode(), $localeCode)) {
                $attributeValue = $this->createProductAttributeValue($attribute->getAttribute(), $localeCode);
                $marketingCart->addAttribute($attributeValue);
            }
        }
    }

    private function createProductAttributeValue(
        ProductAttributeInterface $attribute,
        string                    $localeCode
    ): MarketingCartAttributeValueInterface
    {
        /** @var MarketingCartAttributeValueInterface $attributeValue */
        $attributeValue = $this->attributeValueFactory->createNew();
        $attributeValue->setAttribute($attribute);
        $attributeValue->setLocaleCode($localeCode);

        return $attributeValue;
    }
}
