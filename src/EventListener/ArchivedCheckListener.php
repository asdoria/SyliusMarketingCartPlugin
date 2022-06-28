<?php

namespace Asdoria\SyliusMarketingCartPlugin\EventListener;

use Asdoria\SyliusMarketingCartPlugin\Model\MarketingCartInterface;
use Asdoria\SyliusMarketingCartPlugin\Model\MarketingCartSimilarInterface;
use Asdoria\SyliusMarketingCartPlugin\Repository\Model\MarketingCartRepositoryInterface;
use Sylius\Bundle\ResourceBundle\Event\ResourceControllerEvent;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Sylius\Component\Locale\Context\LocaleContextInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class ArchivedCheckListener
 * @package Asdoria\SyliusMarketingCartPlugin\EventListener
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class ArchivedCheckListener
{
    const _CHECKED_ROUTE = 'asdoria_marketing_shop_marketing_cart_show';
    const _REDIRECT_ATTRIBUTE = 'asdoria_marketing_cart_redirect_archived';

    /**
     * @param MarketingCartRepositoryInterface $marketingCartRepository
     * @param LocaleContextInterface           $localeContext
     * @param ChannelContextInterface          $channelContext
     * @param UrlGeneratorInterface            $router
     * @param RequestStack                     $requestStack
     */
    public function __construct (
        protected MarketingCartRepositoryInterface $marketingCartRepository,
        protected LocaleContextInterface $localeContext,
        protected ChannelContextInterface $channelContext,
        protected UrlGeneratorInterface $router,
        protected RequestStack $requestStack
    )
    {
    }

    /**
     * @param ResourceControllerEvent $event
     * @return void
     */
    public function onCheck(ResourceControllerEvent $event): void
    {
        $request = $this->requestStack->getMainRequest();
        $routeName = $request->attributes->get('_route');

        if ($routeName !== self::_CHECKED_ROUTE || !$request->attributes->has('slug')) {
            return;
        }

        $slug     = $request->attributes->get('slug');
        $resource = $this->marketingCartRepository->findOneBySlug(
            $slug,
            $this->localeContext->getLocaleCode(),
            $this->channelContext->getChannel()
        );

        if (!$resource instanceof MarketingCartInterface) {
            return;
        }

        if (!$resource->isEnabled()) {
            return;
        }

        try {
            if($resource->getArchivedAt() !== null) {
                throw new \InvalidArgumentException('MarketingCart is archived');
            }
        } catch (\Throwable $exception) {
            $request->attributes->set(self::_REDIRECT_ATTRIBUTE, $this->getRedirectResponse($resource, $request->headers->get('referer')));
        }
    }


    /**
     * @param MarketingCartInterface $marketingCart
     * @param string|null            $referer
     *
     * @return RedirectResponse
     */
    private function getRedirectResponse(MarketingCartInterface $marketingCart, ?string $referer): RedirectResponse
    {
        if (!$marketingCart->getEnabledSimilarCarts($this->channelContext->getChannel())->isEmpty()) {
            /** @var MarketingCartSimilarInterface $similarCart */
            $similarCart = $marketingCart->getEnabledSimilarCarts($this->channelContext->getChannel())->first();
            return new RedirectResponse(
                $this->router->generate(self::_CHECKED_ROUTE, ['slug'=> $similarCart->getSimilarCart()->getSlug()])
            );
        }

        if (null !== $referer) {
            return new RedirectResponse($referer);
        }

        return new RedirectResponse($this->router->generate('sylius_shop_homepage'));
    }


}
