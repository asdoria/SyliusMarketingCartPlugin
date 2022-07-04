<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Repository\Traits;

use Asdoria\SyliusMarketingCartPlugin\Model\MarketingCartAttributeValueInterface;
use Asdoria\SyliusMarketingCartPlugin\Model\MarketingCartInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Attribute\AttributeType\SelectAttributeType;
use Sylius\Component\Attribute\Model\AttributeInterface;
use Sylius\Component\Attribute\Model\AttributeValueInterface;
use Sylius\Component\Channel\Model\ChannelInterface;
use Sylius\Component\Taxonomy\Model\TaxonInterface;

/**
 * Trait ProductRepositoryTrait
 * @package Asdoria\Bundle\SearchFilterBundle\Repository\Traits
 */
trait ProductMarketingCartRepositoryTrait
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
        ChannelInterface       $channel,
        MarketingCartInterface $marketingCart,
        string                 $locale,
        ?array                 $sorting = null
    ): QueryBuilder
    {
        $qb = $this->createQueryBuilder('o')
            ->innerJoin('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
            ->innerJoin('o.channels', 'channel', 'WITH', 'channel.code = :channelCode')
            ->andWhere('o.enabled = true')
            ->setParameter('channelCode', $channel->getCode())
            ->setParameter('locale', $locale)
            ->orderBy('o.code', 'ASC')
            ->distinct();

        $this->sortingPrice($qb, $channel, $sorting);

        if (!$marketingCart->getTaxons()->isEmpty()) {
            $qb
                ->innerJoin('o.productTaxons', 'productTaxon')
                ->andWhere('productTaxon.taxon IN (:taxonIds)')
                ->setParameter('taxonIds', $marketingCart->getTaxons());
        }

        $attributes = $this->getTranslatableAttributes($marketingCart);
        $joinMethod = $marketingCart->isAndWhereAttribute() ? 'innerJoin' : 'leftJoin';
        $expr       = $parameters = [];
        foreach ($attributes as $key => $attribute) {
            /** @var MarketingCartAttributeValueInterface $attribute */
            $productAttribute = $attribute->getAttribute();
            $id               = uniqid($productAttribute->getCode() . '' . $key);
            $exprMethod       = $productAttribute->getStorageType() === AttributeValueInterface::STORAGE_JSON ? 'like' : 'eq';
            $qb->$joinMethod('o.attributes', $id, 'WITH', sprintf('%s.attribute = :attr_%s', $id, $id))
                ->setParameter(sprintf('attr_%s', $id), $productAttribute);

            if (!is_array($attribute->getValue())) {
                $this->push($expr, $parameters, $qb, $productAttribute, $id, sprintf(':value_%s', $id), $attribute->getValue());
                continue;
            }

            foreach ($attribute->getValue() as $k => $v)
                $this->push($expr, $parameters, $qb, $productAttribute, $id, sprintf(':value_%s_%s', $id, $k), '%'.$v.'%');
        }

        if (!empty($expr)) {
            $qb->andWhere($marketingCart->isAndWhereAttribute() ? $qb->expr()->andX(...$expr): $qb->expr()->orX(...$expr));
            foreach ($parameters as $k => $v) $qb->setParameter($k, $v);
        }

        if (empty($sorting)) {
            (!$marketingCart->getTaxons()->isEmpty()) ?
                $qb->orderBy('productTaxon.position') :
                $qb->orderBy('o.createdAt', 'DESC');
        }
        
        return $qb;
    }

    /**
     * @param                    $expr
     * @param                    $parameters
     * @param QueryBuilder       $qb
     * @param AttributeInterface $productAttribute
     * @param                    $key
     * @param                    $value
     */
    protected function push(&$expr, &$parameters, QueryBuilder $qb, AttributeInterface $productAttribute, $id, $key, $value) {
        $exprMethod       = $productAttribute->getStorageType() === AttributeValueInterface::STORAGE_JSON ? 'like' : 'eq';
        $expr[]           = $qb->expr()->$exprMethod(sprintf('%s.%s', $id, $productAttribute->getStorageType()), $key);
        $parameters[$key] = $value;
    }

    /**
     * @param QueryBuilder     $qb
     * @param ChannelInterface $channel
     * @param array|null       $sorting
     */
    protected function sortingPrice( QueryBuilder $qb, ChannelInterface $channel, ?array $sorting = null) {
        // Grid hack, we do not need to join these if we don't sort by price
        if (!isset($sorting['price'])) {
            return;
        }

        // Another hack, the subquery to get the first position variant
        $subQuery = $this->createQueryBuilder('m')
            ->select('min(v.position)')
            ->innerJoin('m.variants', 'v')
            ->andWhere('m.id = :product_id')
            ->andWhere('v.enabled = :enabled');

        $qb
            ->addSelect('variant')
            ->addSelect('channelPricing')
            ->innerJoin('o.variants', 'variant')
            ->innerJoin('variant.channelPricings', 'channelPricing')
            ->andWhere('channelPricing.channelCode = :channelCode')
            ->andWhere(
                $qb->expr()->in(
                    'variant.position',
                    str_replace(':product_id', 'o.id', $subQuery->getDQL())
                )
            )
            ->setParameter('channelCode', $channel->getCode())
            ->setParameter('enabled', true);

    }

    /**
     * @param MarketingCartInterface $marketingCart
     *
     * @return Collection
     */
    protected function getTranslatableAttributes(MarketingCartInterface $marketingCart): Collection {
        return $marketingCart->getAttributes()->filter(function (MarketingCartAttributeValueInterface $attributeValue) use ($marketingCart) {
            if ($attributeValue->getAttribute()->isTranslatable()) {
                return $attributeValue->getLocaleCode() === $marketingCart->getTranslation()->getLocale();
            }
            return !empty($attributeValue->getValue()) && (empty($attributeValue->getLocaleCode()) || $attributeValue->getLocaleCode() === $marketingCart->getTranslation()->getLocale());
        });
    }

    /**
     * Creates a new QueryBuilder instance that is prepopulated for this entity name.
     *
     * @param string $alias
     * @param string $indexBy The index for the from.
     *
     * @return QueryBuilder
     */
    abstract public function createQueryBuilder($alias, $indexBy = null);
}
