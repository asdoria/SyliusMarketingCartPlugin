<?php

declare(strict_types=1);


namespace Asdoria\SyliusMarketingCartPlugin\Form\Type;


use Asdoria\SyliusMarketingCartPlugin\Form\EventSubscriber\BuildAttributesFormSubscriber;
use Sylius\Bundle\ChannelBundle\Form\Type\ChannelChoiceType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Bundle\ResourceBundle\Form\Type\ResourceTranslationsType;
use Sylius\Bundle\TaxonomyBundle\Form\Type\TaxonAutocompleteChoiceType;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Translation\Provider\TranslationLocaleProviderInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class MarketingCartType
 * @package Asdoria\SyliusMarketingCartPlugin\Form\Type
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class MarketingCartType extends AbstractResourceType
{
    /**
     * @param string                             $dataClass
     * @param FactoryInterface                   $attributeValueFactory
     * @param TranslationLocaleProviderInterface $localeProvider
     * @param array                              $validationGroups
     */
    public function __construct(
        string $dataClass,
        protected FactoryInterface $attributeValueFactory,
        protected TranslationLocaleProviderInterface $localeProvider,
        array $validationGroups = []
    )
    {
        parent::__construct($dataClass, $validationGroups);
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('translations', ResourceTranslationsType::class, [
                'entry_type' => MarketingCartTranslationType::class,
                'label'      => 'asdoria.form.marketing_cart_translation.name',
            ])
            ->add('channels', ChannelChoiceType::class, [
                'multiple' => true,
                'expanded' => true,
                'label'    => 'sylius.form.product.channels',
            ])
            ->add('taxons', TaxonAutocompleteChoiceType::class, [
                'multiple' => true,
                'label'    => 'sylius.ui.taxons',
            ])
            ->add('images', CollectionType::class, [
                'entry_type'   => MarketingCartImageType::class,
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label'        => 'asdoria.form.marketing_cart.images',
            ])
            ->add('similarCarts', CollectionType::class, [
                'entry_type'   => MarketingCartSimilarType::class,
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label'        => 'asdoria.form.marketing_cart.similar_carts',
            ])
            ->add('enabled', CheckboxType::class, [
                'required' => false,
                'label'    => 'asdoria.form.marketing_cart.enabled',
            ])
            ->add('highlighted', CheckboxType::class, [
                'required' => false,
                'label'    => 'asdoria.form.marketing_cart.highlighted',
            ])
            ->add('andWhereAttribute', CheckboxType::class, [
                'required' => false,
                'label'    => 'asdoria.form.marketing_cart.and_where_attribute',
            ])
            ->add('position', NumberType::class, [
                'label' => 'sylius.ui.position',
            ])
            ->addEventSubscriber(new BuildAttributesFormSubscriber($this->attributeValueFactory, $this->localeProvider))
            ->add('attributes', CollectionType::class, [
                'entry_type'   => MarketingCartAttributeValueType::class,
                'required'     => false,
                'prototype'    => true,
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label'        => false,
            ]);
    }

    /**
     * @return string|null
     */
    public function getBlockPrefix(): ?string
    {
        return 'asdoria_marketing_cart';
    }
}
