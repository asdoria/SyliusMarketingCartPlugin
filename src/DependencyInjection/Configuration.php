<?php
declare(strict_types=1);

namespace Asdoria\SyliusMarketingCartPlugin\DependencyInjection;

use Asdoria\SyliusMarketingCartPlugin\Entity\MarketingCart;
use Asdoria\SyliusMarketingCartPlugin\Entity\MarketingCartAttributeValue;
use Asdoria\SyliusMarketingCartPlugin\Entity\MarketingCartImage;
use Asdoria\SyliusMarketingCartPlugin\Entity\MarketingCartMatrixFacet;
use Asdoria\SyliusMarketingCartPlugin\Entity\MarketingCartMatrixFacetTranslation;
use Asdoria\SyliusMarketingCartPlugin\Entity\MarketingCartSimilar;
use Asdoria\SyliusMarketingCartPlugin\Entity\MarketingCartTranslation;
use Asdoria\SyliusMarketingCartPlugin\Factory\MarketingCartImageFactory;
use Asdoria\SyliusMarketingCartPlugin\Form\Type\MarketingCartAttributeValueType;
use Asdoria\SyliusMarketingCartPlugin\Form\Type\MarketingCartImageType;
use Asdoria\SyliusMarketingCartPlugin\Form\Type\MarketingCartMatrixFacetType;
use Asdoria\SyliusMarketingCartPlugin\Form\Type\MarketingCartSimilarType;
use Asdoria\SyliusMarketingCartPlugin\Form\Type\MarketingCartTranslationType;
use Asdoria\SyliusMarketingCartPlugin\Form\Type\MarketingCartType;
use Asdoria\SyliusMarketingCartPlugin\Model\MarketingCartAttributeValueInterface;
use Asdoria\SyliusMarketingCartPlugin\Repository\MarketingCartAttributeValueRepository;
use Asdoria\SyliusMarketingCartPlugin\Repository\MarketingCartRepository;
use Asdoria\SyliusMarketingCartPlugin\Factory\MarketingCartFactory;

use Asdoria\Bundle\MenuBundle\Factory\MenuItemImageFactory;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Sylius\Bundle\ResourceBundle\SyliusResourceBundle;
use Sylius\Component\Resource\Factory\Factory;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * @package Asdoria\SyliusMarketingCartPlugin\DependencyInjection
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @return TreeBuilder|void
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('asdoria_marketing_cart');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
            ->scalarNode('driver')->defaultValue(SyliusResourceBundle::DRIVER_DOCTRINE_ORM)->end()
            ->end()
        ;

        $this->addResourcesSection($rootNode);

        return $treeBuilder;
    }

    /**
     * @param ArrayNodeDefinition $node
     */
    private function addResourcesSection(ArrayNodeDefinition $node): void
    {
        $node
            ->children()
                ->arrayNode('resources')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('marketing_cart')
                        ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('options')->end()
                                ->arrayNode('classes')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('model')->defaultValue(MarketingCart::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->defaultValue(MarketingCartRepository::class)->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(MarketingCartFactory::class)->end()
                                        ->scalarNode('form')->defaultValue(MarketingCartType::class)->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                                ->arrayNode('translation')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->variableNode('options')->end()
                                        ->arrayNode('classes')
                                        ->addDefaultsIfNotSet()
                                        ->children()
                                            ->scalarNode('model')->defaultValue(MarketingCartTranslation::class)->cannotBeEmpty()->end()
                                            ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                            ->scalarNode('repository')->cannotBeEmpty()->end()
                                            ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                            ->scalarNode('form')->defaultValue(MarketingCartTranslationType::class)->cannotBeEmpty()->end()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                    ->arrayNode('marketing_cart_attribute_value')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->variableNode('options')->end()
                            ->arrayNode('classes')
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->scalarNode('model')->defaultValue(MarketingCartAttributeValue::class)->cannotBeEmpty()->end()
                                    ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                    ->scalarNode('repository')->defaultValue(MarketingCartAttributeValueRepository::class)->cannotBeEmpty()->end()
                                    ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                    ->scalarNode('form')->defaultValue(MarketingCartAttributeValueType::class)->cannotBeEmpty()->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                    ->arrayNode('marketing_cart_image')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->variableNode('options')->end()
                            ->arrayNode('classes')
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->scalarNode('model')->defaultValue(MarketingCartImage::class)->cannotBeEmpty()->end()
                                    ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                    ->scalarNode('repository')->cannotBeEmpty()->end()
                                    ->scalarNode('factory')->defaultValue(MarketingCartImageFactory::class)->end()
                                    ->scalarNode('form')->defaultValue(MarketingCartImageType::class)->cannotBeEmpty()->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                    ->arrayNode('marketing_cart_similar')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->variableNode('options')->end()
                            ->arrayNode('classes')
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->scalarNode('model')->defaultValue(MarketingCartSimilar::class)->cannotBeEmpty()->end()
                                    ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                    ->scalarNode('repository')->cannotBeEmpty()->end()
                                    ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                    ->scalarNode('form')->defaultValue(MarketingCartSimilarType::class)->cannotBeEmpty()->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
