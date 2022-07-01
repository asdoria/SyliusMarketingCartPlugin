<p align="center">
</p>


<h1 align="center">Asdoria Marketing Cart Bundle</h1>

<p align="center">Simply create pages with products from several criteria such as similar attributes, taxon into Sylius Shop</p>

## Features

+ Create pages with products from several criteria such as similar attributes, taxon,

<div style="max-width: 75%; height: auto; margin: auto">
 
[comment]: <> (![Add to Cart]&#40;doc/addtocart.gif&#41;)

[comment]: <> (![Your shopping]&#40;doc/yourshopping.png&#41;)

</div>

<div style="max-width: 75%; height: auto; margin: auto">

</div>

 

## Installation

---
1. run `composer require asdoria/sylius-marketing-cart-plugin`


2. Add the bundle in `config/bundles.php`.

```PHP
Asdoria\SyliusMarketingCartPlugin\AsdoriaSyliusMarketingCartPlugin::class => ['all' => true],
```

3. Import routes in `config/routes.yaml`

```yaml
asdoria_marketing_cart:
    resource: "@AsdoriaSyliusMarketingCartPlugin/Resources/config/routing.yaml"
```

4. Import config in `config/packages/_sylius.yaml`
```yaml
imports:
    - { resource: "@AsdoriaSyliusMarketingCartPlugin/Resources/config/config.yaml"}
```

5. Paste the following content to the `src/Repository/ProductRepository.php`:
```php
  <?php

  declare(strict_types=1);

  namespace App\Repository;

  use Asdoria\SyliusMarketingCartPlugin\Repository\Model\Aware\ProductMarketingCartRepositoryAwareInterface;
  use Asdoria\SyliusMarketingCartPlugin\Repository\Traits\ProductMarketingCartRepositoryTrait;
  use Sylius\Bundle\CoreBundle\Doctrine\ORM\ProductRepository as BaseProductRepository;
  
  final class ProductRepository extends BaseProductRepository implements ProductMarketingCartRepositoryAwareInterface
  {
      use ProductMarketingCartRepositoryTrait;
  }
```
   
6. Configure repositories in `config/packages/_sylius.yaml`:
```diff  
 sylius_product:
     resources:
         product:
             classes:
                 model: App\Entity\Product\Product
+                repository: App\Repository\ProductRepository
```
   
## Demo

You can try the MarketingCart plugin online by following this link: [here!](https://demo-sylius.asdoria.fr/en_US).

Note that we have developed several other open source plugins for Sylius, whose demos and documentation are listed on the [following page](https://asdoria.github.io/).

## Usage

1. In the shop office, go to /en_US/marketing-carts route.

