<?php


declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\Form\Type;

use Sylius\Bundle\AttributeBundle\Form\Type\AttributeValueType;
use Sylius\Component\Attribute\Model\AttributeInterface;
use Sylius\Component\Attribute\Model\AttributeValueInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;

class MarketingCartAttributeValueType extends AttributeValueType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);
        $builder
            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
                $form           = $event->getForm();
                $attributeValue = $form->getData();
                $data           = $event->getData();
                $value          = $data['value'] ?? null;

                if (!$attributeValue instanceof AttributeValueInterface) return;
                if ($attributeValue->getAttribute()->getStorageType() === AttributeValueInterface::STORAGE_JSON) return;
                if (!is_array($value)) return;

                $data['value'] = json_encode($value);
                $event->setData($data);
            });
    }

    public function getBlockPrefix(): string
    {
        return 'asdoria_marketing_cart_attribute_value';
    }
}
