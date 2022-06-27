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

namespace Asdoria\SyliusMarketingCartPlugin\Form\Type;

use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class MarketingCartTranslationType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'sylius.form.taxon.name',
            ])
            ->add('slug', TextType::class, [
                'label' => 'sylius.form.taxon.slug',
            ])
            ->add('description', CKEditorType::class, [
                'required' => false,
                'label' => 'sylius.form.taxon.description',
            ])
            ->add('metaTitle', TextType::class, [
                'label'    => 'asdoria.form.marketing_cart.meta_title',
                'required' => false,
            ])
            ->add('metaDescription', TextareaType::class, [
                'label'    => 'asdoria.form.marketing_cart.meta_description',
                'required' => false,
            ])
            ->add('metaKeywords', TextType::class, [
                'label'    => 'asdoria.form.marketing_cart.meta_keywords',
                'required' => false,
            ])
            ->add('metaRobots', TextType::class, [
                'label'    => 'asdoria.form.marketing_cart.meta_robots',
                'required' => false,
            ])
            ->add('metaCanonical', TextareaType::class, [
                'label'    => 'asdoria.form.marketing_cart.meta_canonical',
                'required' => false,
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'asdoria_marketing_cart_translation';
    }
}
