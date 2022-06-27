<?php
declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Entity;


use Asdoria\SyliusFacetFilterPlugin\Traits\FacetFilterCodeTrait;
use Asdoria\SyliusMarketingCartPlugin\Traits\AttributeValuesTrait;
use Asdoria\SyliusMarketingCartPlugin\Traits\ChannelsTrait;
use Asdoria\SyliusMarketingCartPlugin\Traits\MarketingCartImagesTrait;
use Asdoria\SyliusMarketingCartPlugin\Traits\SimilarCartsTrait;
use Asdoria\SyliusMarketingCartPlugin\Traits\TaxonsTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Attribute\Model\AttributeValueInterface;
use Sylius\Component\Resource\Model\ArchivableTrait;
use Sylius\Component\Resource\Model\TimestampableTrait;
use Sylius\Component\Resource\Model\ToggleableTrait;
use Sylius\Component\Resource\Model\TranslatableTrait;
use Sylius\Component\Resource\Model\TranslationInterface;
use Webmozart\Assert\Assert;

/**
 * Class Import
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

    /** @var string|null */
    protected ?string $criteria;
    protected bool $highlighted = true;
    protected float $position = 0;

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
        $this->initializeMatrixFacetsCollection();
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
     * @return string|null
     */
    public function getCriteria(): ?string
    {
        return $this->criteria;
    }

    /**
     * @param string|null $criteria
     */
    public function setCriteria(?string $criteria): void
    {
        $this->criteria = $criteria;
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

    /**
     * @param number $position
     */
    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    /**
     * @return Collection
     */
    public function getSimilarCarts(): Collection
    {
        return $this->similarCarts;
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

    protected function createTranslation(): MarketingCartTranslationInterface
    {
        return new MarketingCartTranslation();
    }
}
