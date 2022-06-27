<?php
declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Entity;

use Asdoria\SyliusMarketingCartPlugin\Model\MarketingCartInterface;
use Asdoria\SyliusMarketingCartPlugin\Model\MarketingCartSimilarInterface;

/**
 * Class MarketingCartSimilar
 * @package Asdoria\SyliusMarketingCartPlugin\Entity
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class MarketingCartSimilar implements MarketingCartSimilarInterface
{
    /**
     * @var int|null
     */
    protected $id;

    /**
     * @var int
     */
    protected $position = 0;

    /**
     * @var MarketingCartInterface|null
     */
    protected $marketingCart;

    /**
     * @var MarketingCartInterface|null
     */
    protected $similarCart;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    /**
     * @return MarketingCartInterface|null
     */
    public function getMarketingCart(): ?MarketingCartInterface
    {
        return $this->marketingCart;
    }

    /**
     * @param MarketingCartInterface|null $marketingCart
     */
    public function setMarketingCart(?MarketingCartInterface $marketingCart): void
    {
        $this->marketingCart = $marketingCart;
    }

    /**
     * @return MarketingCartInterface|null
     */
    public function getSimilarCart(): ?MarketingCartInterface
    {
        return $this->similarCart;
    }

    /**
     * @param MarketingCartInterface|null $similarCart
     */
    public function setSimilarCart(?MarketingCartInterface $similarCart): void
    {
        $this->similarCart = $similarCart;
    }
}
