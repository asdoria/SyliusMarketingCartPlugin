<?php


declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Model;

use Asdoria\SyliusMarketingCartPlugin\Model\Aware\MetaCanonicalAwareInterface;
use Asdoria\SyliusMarketingCartPlugin\Model\Aware\MetaDescriptionAwareInterface;
use Asdoria\SyliusMarketingCartPlugin\Model\Aware\MetaKeywordsAwareInterface;
use Asdoria\SyliusMarketingCartPlugin\Model\Aware\MetaRobotsAwareInterface;
use Asdoria\SyliusMarketingCartPlugin\Model\Aware\MetaTitleAwareInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\SlugAwareInterface;
use Sylius\Component\Resource\Model\TranslationInterface;

/**
 * Interface MarketingCartTranslationInterface
 * @package Asdoria\SyliusMarketingCartPlugin\Model
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface MarketingCartTranslationInterface extends 
    SlugAwareInterface, 
    ResourceInterface, 
    TranslationInterface,
    MetaTitleAwareInterface,
    MetaKeywordsAwareInterface,
    MetaDescriptionAwareInterface,
    MetaRobotsAwareInterface,
    MetaCanonicalAwareInterface
{
    public function getName(): ?string;

    public function setName(?string $name): void;

    public function getDescription(): ?string;

    public function setDescription(?string $description): void;
}
