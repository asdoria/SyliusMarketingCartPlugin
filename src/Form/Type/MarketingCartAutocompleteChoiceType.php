<?php
declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\ResourceAutocompleteChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class MarketingCartAutocompleteChoiceType
 * @package Asdoria\SyliusMarketingCartPlugin\Form\Type
 *
 * @author  Hugo Duval <hugo.duval@asdoria.com>
 */
class MarketingCartAutocompleteChoiceType extends AbstractType
{
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'resource'     => 'asdoria.marketing_cart',
            'choice_name'  => 'name',
            'choice_value' => 'id',
        ]);
    }

    /**
     * @param FormView      $view
     * @param FormInterface $form
     * @param array         $options
     */
    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        $view->vars['remote_criteria_type'] = 'contains';
        $view->vars['remote_criteria_name'] = 'phrase';
    }

    /**
     * @return string
     */
    public function getBlockPrefix(): string
    {
        return 'asdoria_marketing_cart_autocomplete_choice';
    }

    /**
     * @return string
     */
    public function getParent(): string
    {
        return ResourceAutocompleteChoiceType::class;
    }
}
