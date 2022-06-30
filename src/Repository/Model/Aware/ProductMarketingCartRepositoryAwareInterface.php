<?php

declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Repository\Model\Aware;

use Asdoria\SyliusMarketingCartPlugin\Model\MarketingCartInterface;
use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Channel\Model\ChannelInterface;

/**
 * Interface ProductMarketingCartRepositoryAwareInterface
 * @package Asdoria\SyliusMarketingCartPlugin\Repository\Model\Aware
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface ProductMarketingCartRepositoryAwareInterface
{
    /**
     * @param ChannelInterface       $channel
     * @param MarketingCartInterface $marketingCart
     * @param string                 $locale
     * @param array|null             $sorting
     *
     * @return QueryBuilder
     */
    public function createShopMarketingCartListQueryBuilder(
        ChannelInterface $channel,
        MarketingCartInterface $marketingCart,
        string $locale,
        ?array $sorting = null
    ): QueryBuilder;

    /**
     * Creates a new QueryBuilder instance that is prepopulated for this entity name.
     *
     * @param string $alias
     * @param string $indexBy The index for the from.
     *
     * @return QueryBuilder
     */
    public function createQueryBuilder($alias, $indexBy = null);
}
