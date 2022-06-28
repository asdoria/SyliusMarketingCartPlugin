<?php
declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Entity;

use Asdoria\SyliusMarketingCartPlugin\Model\MarketingCartInterface;
use Asdoria\SyliusMarketingCartPlugin\Model\MarketingCartSimilarInterface;
use Sylius\Component\Core\Model\ChannelInterface;

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
    protected int $position = 0;
    protected ?MarketingCartInterface $marketingCart = null;
    protected ?MarketingCartInterface $similarCart = null;

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
     * @param ChannelInterface $channel
     *
     * @return bool
     */
    public function isEnabled(ChannelInterface $channel): bool {
      if (!$this->getSimilarCart() instanceof MarketingCartInterface) return false;

      return $this->getSimilarCart()->isEnabled() &&
          $this->getSimilarCart()->getArchivedAt() === null &&
          $this->getSimilarCart()->hasChannel($channel);
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
