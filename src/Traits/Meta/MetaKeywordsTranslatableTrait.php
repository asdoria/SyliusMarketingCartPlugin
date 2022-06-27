<?php
declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Traits\Meta;

use Sylius\Component\Resource\Model\TranslationInterface;

/**
 * Trait MetaKeywordsTrait
 * @package Asdoria\SyliusMarketingCartPlugin\Traits\Meta
 */
trait MetaKeywordsTranslatableTrait
{
    /**
     * @return string|null
     */
    public function getMetaKeywords(): ?string
    {
        return $this->getTranslation()->getMetaKeywords();
    }

    /**
     * @param string|null $metaKeywords
     */
    public function setMetaKeywords(?string $metaKeywords): void
    {
        $this->getTranslation()->setMetaKeywords($metaKeywords);
    }

    /**
     * @param string|null $locale
     *
     * @return TranslationInterface
     */
    abstract public function getTranslation(?string $locale = null): TranslationInterface;
}
