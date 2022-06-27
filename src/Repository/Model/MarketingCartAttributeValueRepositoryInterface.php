<?php

declare(strict_types=1);


namespace Asdoria\SyliusMarketingCartPlugin\Repository\Model;


/**
 * Class MarketingCartAttributeValueRepositoryInterface
 * @package Asdoria\SyliusMarketingCartPlugin\Repository\Model
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface MarketingCartAttributeValueRepositoryInterface
{
    public function findByJsonChoiceKey(string $choiceKey): array;
}
