<?php

declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Model;

use Asdoria\SyliusFacetFilterPlugin\Model\Aware\FacetFilterCodeAwareInterface;
use Asdoria\SyliusMarketingCartPlugin\Model\Aware\AttributeValuesAwareInterface;
use Asdoria\SyliusMarketingCartPlugin\Model\Aware\SimilarCartsAwareInterface;
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
    TaxonsAwareInterface,
    SimilarCartsAwareInterface,
    AttributeValuesAwareInterface,
    FacetFilterCodeAwareInterface
{
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
     * @param int $position
     */
    public function setPosition(int $position): void;

    public function getName(): ?string;

    public function setName(?string $name): void;

    public function getDescription(): ?string;

    public function setDescription(?string $description): void;

    /**
     * @return bool
     */
    public function isAndWhereAttribute(): bool;

    /**
     * @param bool $andWhereAttribute
     */
    public function setAndWhereAttribute(bool $andWhereAttribute): void;
}
