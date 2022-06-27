<?php

declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Repository\Model;

use Asdoria\SyliusMarketingCartPlugin\Model\MarketingCartInterface;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

interface MarketingCartRepositoryInterface extends RepositoryInterface
{
    /**
     * @param string|null      $criteria
     * @param ChannelInterface $channel
     *
     * @return Collection
     */
    public function findByCriteriaAndChannel(?string $criteria, ChannelInterface $channel): Collection;

    /**
     * @param string $slug
     * @param string $locale
     *
     * @return MarketingCartInterface|null
     * @throws \Doctrine\ORM\NonUniqueResultException
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
}
