<?php

declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Model;

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Attribute\Model\AttributeSubjectInterface;
use Sylius\Component\Attribute\Model\AttributeValueInterface;
use Sylius\Component\Channel\Model\ChannelsAwareInterface;
use Sylius\Component\Core\Model\ImagesAwareInterface as BaseImagesAwareInterface;
use Sylius\Component\Resource\Model\ArchivableInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\SlugAwareInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;
use Sylius\Component\Resource\Model\ToggleableInterface;
use Sylius\Component\Resource\Model\TranslatableInterface;
use Sylius\Component\Taxonomy\Model\TaxonsAwareInterface;

/**
 * Interface MarketingCartInterface
 * @package Asdoria\SyliusMarketingCartPlugin\Model
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface MarketingCartInterface extends
    ResourceInterface,
    TimestampableInterface,
    ChannelsAwareInterface,
    ToggleableInterface,
    TranslatableInterface,
    SlugAwareInterface,
    ArchivableInterface,
    BaseImagesAwareInterface,
    AttributeSubjectInterface,
    TaxonsAwareInterface
{
    /**
     * @return string|null
     */
    public function getCriteria(): ?string;

    /**
     * @param string|null $criteria
     */
    public function setCriteria(?string $criteria): void;

    /**
     * @return bool
     */
    public function isHighlighted(): bool;

    /**
     * @param bool $highlighted
     */
    public function setHighlighted(bool $highlighted): void;

    /**
     * @return number
     */
    public function getPosition(): int;

    /**
     * @param number $position
     */
    public function setPosition(int $position): void;

    /**
     * @return Collection
     */
    public function getSimilarCarts(): Collection;

    /**
     * @param MarketingCartSimilarInterface $cart
     */
    public function addSimilarCart(MarketingCartSimilarInterface $cart): void;

    /**
     * @param MarketingCartSimilarInterface $cart
     */
    public function removeSimilarCart(MarketingCartSimilarInterface $cart): void;

    /**
     * @param MarketingCartSimilarInterface $cart
     *
     * @return bool
     */
    public function hasSimilarCart(MarketingCartSimilarInterface $cart): bool;

    public function getName(): ?string;

    public function setName(?string $name): void;

    public function getSlug(): ?string;

    public function setSlug(?string $slug): void;

    public function getDescription(): ?string;

    public function setDescription(?string $description): void;

    public function getAttributes(): Collection;

    public function getAttributesByLocale(
        string $localeCode,
        string $fallbackLocaleCode,
        ?string $baseLocaleCode = null
    ): Collection;

    public function addAttribute(?AttributeValueInterface $attribute): void;

    public function removeAttribute(?AttributeValueInterface $attribute): void;

    public function hasAttribute(AttributeValueInterface $attribute): bool;

    public function hasAttributeByCodeAndLocale(string $attributeCode, ?string $localeCode = null): bool;

    public function getAttributeByCodeAndLocale(string $attributeCode, ?string $localeCode = null): ?AttributeValueInterface;
}
