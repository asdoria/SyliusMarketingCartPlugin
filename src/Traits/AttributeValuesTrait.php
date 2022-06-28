<?php

declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Traits;

use Asdoria\SyliusMarketingCartPlugin\Model\MarketingCartAttributeValueInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Attribute\Model\AttributeValueInterface;
use Sylius\Component\Product\Model\ProductAttributeValueInterface;
use Webmozart\Assert\Assert;


/**
 * Class AttributeValueTrait
 *
 * @author Philippe Vesin <pve.asdoria@gmail.com>
 */
trait AttributeValuesTrait
{
    /**
     * @var Collection
     */
    protected Collection $attributes;

    protected function initializeAttributeValues(): void
    {
        $this->attributes = new ArrayCollection();
    }

    public function getAttributes(): Collection
    {
        return $this->attributes;
    }

    public function getAttributesByLocale(
        string $localeCode,
        string $fallbackLocaleCode,
        ?string $baseLocaleCode = null
    ): Collection {
        if (null === $baseLocaleCode || $baseLocaleCode === $fallbackLocaleCode) {
            $baseLocaleCode = $fallbackLocaleCode;
            $fallbackLocaleCode = null;
        }

        $attributes = $this->attributes->filter(
            function (MarketingCartAttributeValueInterface $attribute) use ($baseLocaleCode) {
                return $attribute->getLocaleCode() === $baseLocaleCode || null === $attribute->getLocaleCode();
            }
        );

        $attributesWithFallback = [];
        foreach ($attributes as $attribute) {
            $attributesWithFallback[] = $this->getAttributeInDifferentLocale($attribute, $localeCode, $fallbackLocaleCode);
        }

        return new ArrayCollection($attributesWithFallback);
    }

    protected function getAttributeInDifferentLocale(
        ProductAttributeValueInterface $attributeValue,
        string $localeCode,
        ?string $fallbackLocaleCode = null
    ): AttributeValueInterface {
        if (!$this->hasNotEmptyAttributeByCodeAndLocale($attributeValue->getCode(), $localeCode)) {
            if (
                null !== $fallbackLocaleCode &&
                $this->hasNotEmptyAttributeByCodeAndLocale($attributeValue->getCode(), $fallbackLocaleCode)
            ) {
                return $this->getAttributeByCodeAndLocale($attributeValue->getCode(), $fallbackLocaleCode);
            }

            return $attributeValue;
        }

        return $this->getAttributeByCodeAndLocale($attributeValue->getCode(), $localeCode);
    }

    protected function hasNotEmptyAttributeByCodeAndLocale(string $attributeCode, string $localeCode): bool
    {
        $attributeValue = $this->getAttributeByCodeAndLocale($attributeCode, $localeCode);
        if (null === $attributeValue) {
            return false;
        }

        $value = $attributeValue->getValue();
        if ('' === $value || null === $value || [] === $value) {
            return false;
        }

        return true;
    }

    public function addAttribute(?AttributeValueInterface $attribute): void
    {
        /** @var MarketingCartAttributeValueInterface $attribute */
        Assert::isInstanceOf(
            $attribute,
            MarketingCartAttributeValueInterface::class,
            'Attribute objects added to a Product object have to implement MarketingCartAttributeValueInterface'
        );

        if (!$this->hasAttribute($attribute)) {
            $attribute->setMarketingCart($this);
            $this->attributes->add($attribute);
        }
    }

    public function removeAttribute(?AttributeValueInterface $attribute): void
    {
        /** @var MarketingCartAttributeValueInterface $attribute */
        Assert::isInstanceOf(
            $attribute,
            MarketingCartAttributeValueInterface::class,
            'Attribute objects removed from a Product object have to implement MarketingCartAttributeValueInterface'
        );

        if ($this->hasAttribute($attribute)) {
            $this->attributes->removeElement($attribute);
            $attribute->setMarketingCart(null);
        }
    }

    public function hasAttribute(AttributeValueInterface $attribute): bool
    {
        return $this->attributes->contains($attribute);
    }

    public function hasAttributeByCodeAndLocale(string $attributeCode, ?string $localeCode = null): bool
    {
        $localeCode = $localeCode ?: $this->getTranslation()->getLocale();

        foreach ($this->attributes as $attribute) {
            if ($attribute->getAttribute()->getCode() === $attributeCode
                && ($attribute->getLocaleCode() === $localeCode || null === $attribute->getLocaleCode())) {
                return true;
            }
        }

        return false;
    }

    public function getAttributeByCodeAndLocale(string $attributeCode, ?string $localeCode = null): ?AttributeValueInterface
    {
        if (null === $localeCode) {
            $localeCode = $this->getTranslation()->getLocale();
        }

        foreach ($this->attributes as $attribute) {
            if ($attribute->getAttribute()->getCode() === $attributeCode &&
                ($attribute->getLocaleCode() === $localeCode || null === $attribute->getLocaleCode())) {
                return $attribute;
            }
        }

        return null;
    }
}
