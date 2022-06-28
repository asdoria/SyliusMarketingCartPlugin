<?php
declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Entity;


use Asdoria\SyliusFacetFilterPlugin\Traits\FacetFilterCodeTrait;
use Asdoria\SyliusMarketingCartPlugin\Model\MarketingCartInterface;
use Asdoria\SyliusMarketingCartPlugin\Model\MarketingCartTranslationInterface;
use Asdoria\SyliusMarketingCartPlugin\Traits\AttributeValuesTrait;
use Asdoria\SyliusMarketingCartPlugin\Traits\ChannelsTrait;
use Asdoria\SyliusMarketingCartPlugin\Traits\MarketingCartImagesTrait;
use Asdoria\SyliusMarketingCartPlugin\Traits\SimilarCartsTrait;
use Asdoria\SyliusMarketingCartPlugin\Traits\TaxonsTrait;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Resource\Model\ArchivableTrait;
use Sylius\Component\Resource\Model\TimestampableTrait;
use Sylius\Component\Resource\Model\ToggleableTrait;
use Sylius\Component\Resource\Model\TranslatableTrait;
use Sylius\Component\Resource\Model\TranslationInterface;

/**
 * Class MarketingCart
 * @package Asdoria\SyliusMarketingCartPlugin\Entity
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class MarketingCart implements MarketingCartInterface
{
    use ArchivableTrait;
    use TranslatableTrait {
        __construct as private initializeTranslationsCollection;
        getTranslation as private doGetTranslation;
    }
    use TimestampableTrait;
    use ChannelsTrait;
    use ToggleableTrait;
    use MarketingCartImagesTrait;
    use TaxonsTrait;
    use AttributeValuesTrait;
    use SimilarCartsTrait;
    use FacetFilterCodeTrait;

    /**
     * @var int
     */
    protected $id;

    protected bool $highlighted = true;
    protected int $position = 0;
    protected bool $andWhereAttribute = true;

    /**
     * MarketingCart constructor.
     */
    public function __construct()
    {
        $this->initializeTranslationsCollection();
        $this->initializeSimilarCarts();
        $this->initializeMarketingCartImagesCollection();
        $this->initializeChannelsCollection();
        $this->initializeTaxonsCollection();
        $this->initializeAttributeValues();
    }

    /**
     * @return string|null
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return bool
     */
    public function isHighlighted(): bool
    {
        return $this->highlighted;
    }

    /**
     * @param bool $highlighted
     */
    public function setHighlighted(bool $highlighted): void
    {
        $this->highlighted = $highlighted;
    }

    /**
     * @return number
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    public function getName(): ?string
    {
        return $this->getTranslation()->getName();
    }

    public function setName(?string $name): void
    {
        $this->getTranslation()->setName($name);
    }

    public function getSlug(): ?string
    {
        return $this->getTranslation()->getSlug();
    }

    public function setSlug(?string $slug): void
    {
        $this->getTranslation()->setSlug($slug);
    }

    public function getDescription(): ?string
    {
        return $this->getTranslation()->getDescription();
    }

    public function setDescription(?string $description): void
    {
        $this->getTranslation()->setDescription($description);
    }

    /**
     * @return MarketingCartTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface
    {
        /** @var MarketingCartTranslationInterface $translation */
        $translation = $this->doGetTranslation($locale);

        return $translation;
    }

    /**
     * @return bool
     */
    public function isAndWhereAttribute(): bool
    {
        return $this->andWhereAttribute;
    }

    /**
     * @param bool $andWhereAttribute
     */
    public function setAndWhereAttribute(bool $andWhereAttribute): void
    {
        $this->andWhereAttribute = $andWhereAttribute;
    }



    protected function createTranslation(): MarketingCartTranslationInterface
    {
        return new MarketingCartTranslation();
    }
}
