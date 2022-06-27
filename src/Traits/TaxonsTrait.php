<?php
declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Traits;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Taxonomy\Model\TaxonInterface;

/**
 * Trait TaxonsTrait
 * @package Asdoria\SyliusMarketingCartPlugin\Traits
 *
 * @author  Hugo Duval <hugo.duval@asdoria.com>
 */
trait TaxonsTrait
{
    /**
     * @var Collection|TaxonInterface[]
     */
    protected Collection $taxons;

    public function initializeTaxonsCollection(): void
    {
        $this->taxons = new ArrayCollection();
    }

    /**
     * @return Collection|TaxonInterface[]
     */
    public function getTaxons(): Collection
    {
        return $this->taxons;
    }

    /**
     * @param TaxonInterface $taxon
     */
    public function addTaxon(TaxonInterface $taxon): void
    {
        if (!$this->hasTaxon($taxon)) {
            $this->taxons->add($taxon);
        }
    }

    /**
     * @param TaxonInterface $taxon
     */
    public function removeTaxon(TaxonInterface $taxon): void
    {
        if ($this->hasTaxon($taxon)) {
            $this->taxons->removeElement($taxon);
        }
    }

    /**
     * @param TaxonInterface $taxon
     *
     * @return bool
     */
    public function hasTaxon(TaxonInterface $taxon): bool
    {
        return $this->taxons->contains($taxon);
    }

    /**
     * @return bool
     */
    public function hasTaxons(): bool
    {
        return $this->taxons->isEmpty();
    }
}
