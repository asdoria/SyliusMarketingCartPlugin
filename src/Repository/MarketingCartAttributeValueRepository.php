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

namespace Asdoria\SyliusMarketingCartPlugin\Repository;

use Asdoria\SyliusMarketingCartPlugin\Repository\Model\MarketingCartAttributeValueRepositoryInterface;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Product\Repository\ProductAttributeValueRepositoryInterface;

class MarketingCartAttributeValueRepository extends EntityRepository implements MarketingCartAttributeValueRepositoryInterface
{
    public function findByJsonChoiceKey(string $choiceKey): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.json LIKE :key')
            ->setParameter('key', '%"' . $choiceKey . '"%')
            ->getQuery()
            ->getResult()
        ;
    }
}
