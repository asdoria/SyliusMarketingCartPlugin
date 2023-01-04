<?php
declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class MarketingCartSimilarType
 * @package Asdoria\SyliusMarketingCartPlugin\Form\Type
 *
 * @author  Hugo Duval <hugo.duval@asdoria.com>
 */
class MarketingCartSimilarType extends AbstractResourceType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('position', NumberType::class, [
                'label'      => 'sylius.ui.position',
                'required'   => false,
                'empty_data' => 0,
            ])
            ->add('similarCart', MarketingCartAutocompleteChoiceType::class, [
                'label' => 'asdoria.ui.marketing_cart',
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'asdoria_marketing_cart_similar';
    }
}
