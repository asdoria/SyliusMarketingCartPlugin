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
use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Attribute\AttributeType\SelectAttributeType;
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
     * @param null                   $sorting
     *
     * @return QueryBuilder
     */
    public function createShopMarketingCartListQueryBuilder(
        ChannelInterface $channel,
        MarketingCartInterface $marketingCart,
        string $locale,
        $sorting = null
    ): QueryBuilder
    {
        $qb = $this->createQueryBuilder('o')
            ->innerJoin('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
            ->innerJoin('o.channels', 'channel', 'WITH', 'channel.code = :channelCode')
            ->innerJoin('o.variants', 'variant')
            ->innerJoin('variant.channelPricings', 'channelPricing', 'WITH', 'channelPricing.channelCode = :channelCode')
            ->andWhere('o.enabled = true')
            ->setParameter('channelCode', $channel->getCode())
            ->setParameter('locale', $locale)
            ->orderBy('o.code', 'ASC')
            ->distinct();

        if (!$marketingCart->getTaxons()->isEmpty()) {
            $qb
                ->innerJoin('o.productTaxons', 'productTaxon')
                ->andWhere('productTaxon.taxon IN (:taxonIds)')
                ->setParameter('taxonIds', $marketingCart->getTaxons())
            ;
        }

        $attributes = $marketingCart->getAttributes()->filter(function (MarketingCartAttributeValueInterface $attributeValue) use ($marketingCart) {
            if ($attributeValue->getAttribute()->isTranslatable()) {
                return $attributeValue->getLocaleCode() === $marketingCart->getTranslation()->getLocale();
            }
            return !empty($attributeValue->getValue()) && (empty($attributeValue->getLocaleCode()) || $attributeValue->getLocaleCode() === $marketingCart->getTranslation()->getLocale());
        });

        foreach ($attributes as $attribute) {
            /** @var MarketingCartAttributeValueInterface $attribute */
            $productAttribute = $attribute->getAttribute();
            $code             = str_replace(['-', '.'], '', $productAttribute->getCode());
            $id               = uniqid($code);
            $type             = $productAttribute->getType();
            $fieldType        = $productAttribute->getStorageType();
            $whereType        = $type === SelectAttributeType::TYPE ? 'LIKE' : '=';
            $selectValue      = ($attribute->getValue()[0] ?? '');
            $whereValue       = $type === SelectAttributeType::TYPE ? implode(['%',$selectValue,'%']) : $attribute->getValue();
            $qb->innerJoin('o.attributes', $id, 'WITH', sprintf('%s.attribute = :attr_%s',$id, $id))
                ->andWhere(sprintf('%s.%s %s :%s',$id, $fieldType, $whereType ,$code))
                ->setParameter($code, $whereValue)
                ->setParameter(sprintf('attr_%s', $id), $productAttribute);
        }

        if (empty($sorting)) {
            if (!$marketingCart->getTaxons()->isEmpty()) {
                $qb->orderBy('productTaxon.position');
            } else {
                $qb->orderBy('o.createdAt', 'DESC');
            }
        }

        return $qb;
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
