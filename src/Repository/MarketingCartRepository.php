<?php
declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Repository;

use Asdoria\SyliusMarketingCartPlugin\Model\MarketingCartInterface;
use Asdoria\SyliusMarketingCartPlugin\Repository\Model\MarketingCartRepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\QueryBuilder;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Taxonomy\Model\TaxonInterface;

/**
 * Class MarketingCartRepository
 * @package Asdoria\SyliusMarketingCartPlugin\Doctrine\ORM
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class MarketingCartRepository extends EntityRepository implements MarketingCartRepositoryInterface
{

    /**
     * @param string $criteria
     *
     * @return Collection
     */
    public function findByCriteriaAndChannel(?string $criteria, ChannelInterface $channel): Collection {
        $expr = $this->getEntityManager()->getExpressionBuilder();
        $qb = $this
            ->createQueryBuilder('o')
            ->andWhere('o.archivedAt is null')
            ->innerJoin('o.channels', 'channel')
            ->andWhere('channel = :channel')
            ->setParameter('channel', $channel)
        ;
        foreach (explode(',', $criteria) as $v) {
            $attrParam = 'attr_' . uniqid($v);
            $qb
                ->andWhere('o.criteria LIKE :'.$attrParam)
                ->setParameter($attrParam, '%'.$v.'%');
        }
        $sql = $qb->getQuery()->getSQL();
        $result = $qb->getQuery()->getResult();

        return (new ArrayCollection($result));
    }

    /**
     * @param string $slug
     * @param string $locale
     *
     * @return MarketingCartInterface|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneBySlug(string $slug, string $locale, ChannelInterface $channel): ?MarketingCartInterface
    {
        return $this->createTranslationBasedQueryBuilder($locale)
            ->innerJoin('o.channels', 'channel')
            ->andWhere('o.enabled = true')
            ->andWhere('translation.slug = :slug')
            ->andWhere('translation.locale = :locale')
            ->andWhere('channel = :channel')
            ->setParameter('slug', $slug)
            ->setParameter('locale', $locale)
            ->setParameter('channel', $channel)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
    
    /**
     * @param string      $phrase
     * @param string|null $locale
     * @param null        $limit
     *
     * @return array
     */
    public function findByNamePart(string $phrase, ?string $locale = null, $limit = null): array
    {
        $maxResults = $limit ? intval($limit) : null;

        return $this->createTranslationBasedQueryBuilder($locale)
            ->andWhere('translation.name LIKE :name')
            ->setParameter('name', '%' . $phrase . '%')
            ->setMaxResults($maxResults > 0 ? $maxResults : null)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param string|null $locale
     *
     * @return QueryBuilder
     */
    protected function createTranslationBasedQueryBuilder(?string $locale): QueryBuilder
    {
        $queryBuilder = $this->createQueryBuilder('o')
            ->addSelect('translation')
            ->leftJoin('o.translations', 'translation')
        ;

        if (null !== $locale) {
            $queryBuilder
                ->andWhere('translation.locale = :locale')
                ->setParameter('locale', $locale)
            ;
        }

        return $queryBuilder;
    }
    
}
