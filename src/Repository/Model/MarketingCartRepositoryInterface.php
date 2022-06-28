<?php

declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Repository\Model;

use Asdoria\SyliusMarketingCartPlugin\Model\MarketingCartInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

/**
 * Interface MarketingCartRepositoryInterface
 * @package Asdoria\SyliusMarketingCartPlugin\Repository\Model
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface MarketingCartRepositoryInterface extends RepositoryInterface
{
    /**
     * @param string           $slug
     * @param string           $locale
     * @param ChannelInterface $channel
     *
     * @return MarketingCartInterface|null
     */
    public function findOneBySlug(string $slug, string $locale, ChannelInterface $channel): ?MarketingCartInterface;

    /**
     * @param string      $phrase
     * @param string|null $locale
     * @param null        $limit
     *
     * @return array
     */
    public function findByNamePart(string $phrase, ?string $locale = null, $limit = null): array;

    /**
     * @param ChannelInterface $channel
     * @param string           $locale
     * @param int              $count
     *
     * @return array
     */
    public function findLatestByChannelAndHighlighted(ChannelInterface $channel, string $locale, int $count): array;
}
