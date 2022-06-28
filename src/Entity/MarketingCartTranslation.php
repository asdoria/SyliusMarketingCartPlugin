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

namespace Asdoria\SyliusMarketingCartPlugin\Entity;

use Asdoria\SyliusMarketingCartPlugin\Model\MarketingCartTranslationInterface;
use Asdoria\SyliusMarketingCartPlugin\Traits\Meta\MetaCanonicalTrait;
use Asdoria\SyliusMarketingCartPlugin\Traits\Meta\MetaDescriptionTrait;
use Asdoria\SyliusMarketingCartPlugin\Traits\Meta\MetaKeywordsTrait;
use Asdoria\SyliusMarketingCartPlugin\Traits\Meta\MetaRobotsTrait;
use Asdoria\SyliusMarketingCartPlugin\Traits\Meta\MetaTitleTrait;
use Sylius\Component\Resource\Model\AbstractTranslation;

/**
 * Class MarketingCartTranslation
 * @package Asdoria\SyliusMarketingCartPlugin\Entity
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class MarketingCartTranslation extends AbstractTranslation implements MarketingCartTranslationInterface
{
    use MetaDescriptionTrait;
    use MetaKeywordsTrait;
    use MetaRobotsTrait;
    use MetaTitleTrait;
    use MetaCanonicalTrait;

    /** @var mixed */
    protected $id;

    /** @var string|null */
    protected ?string $name = null;

    /** @var string|null */
    protected ?string $slug= null;

    /** @var string|null */
    protected ?string $description= null;

    public function __toString(): string
    {
        return (string) $this->getName();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): void
    {
        $this->slug = $slug;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
}
