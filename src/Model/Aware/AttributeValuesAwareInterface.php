<?php

declare(strict_types=1);


namespace Asdoria\SyliusMarketingCartPlugin\Model\Aware;


use Doctrine\Common\Collections\Collection;
use Sylius\Component\Attribute\Model\AttributeValueInterface;
/**
 * Class AttributeValuesAwareInterface
 * @package Asdoria\SyliusMarketingCartPlugin\Model\Aware
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface AttributeValuesAwareInterface
{

    public function getAttributes(): Collection;

    public function getAttributesByLocale(
        string $localeCode,
        string $fallbackLocaleCode,
        ?string $baseLocaleCode = null
    ): Collection;

    public function addAttribute(AttributeValueInterface $attribute): void;

    public function removeAttribute(AttributeValueInterface $attribute): void;

    public function hasAttribute(AttributeValueInterface $attribute): bool;

    public function hasAttributeByCodeAndLocale(string $attributeCode, ?string $localeCode = null): bool;

    public function getAttributeByCodeAndLocale(string $attributeCode, ?string $localeCode = null): ?AttributeValueInterface;
}
