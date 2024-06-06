<?php
declare(strict_types=1);

namespace App\Controller;

use App\Interface\PriceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

final class CartController extends AbstractController
{
    private ?SessionInterface $session = null;

    public function __construct(RequestStack $requestStack)
    {
        $this->session = $requestStack->getSession();
    }
    
    #[Route(path: '/panier', name: 'cart_detail')]
    public function listing(): Response
    {
        $cart = $this->session->get('cart', []);

        return $this->render('cart/detail.html.twig', [
            'cart' => $cart,
            'totalPrice' => array_sum(array_map(function ($item) {
                /** @var PriceInterface $cartItem */
                $cartItem = $item['item'];

                return $cartItem->getPrice() * $item['qty'];
            }, $cart)),
        ]);
    }

    #[Route(path: '/panier/supprimer/{key}', name: 'cart_remove', requirements: ['key' => '[A-Z0-9]+'])]
    public function delete($key): Response
    {
        $cart = $this->session->get('cart', []);
        unset($cart[$key]);
        $this->session->set('cart', $cart);

        return $this->listing();
    }

    #[Route(path: '/panier/ajouter/{key}', name: 'cart_increase', requirements: ['key' => '[A-Z0-9]+'])]
    public function increase($key): Response
    {
        $cart = $this->session->get('cart', []);
        ++$cart[$key]['qty'];
        $this->session->set('cart', $cart);

        return $this->listing();
    }

    #[Route(path: '/panier/retirer/{key}', name: 'cart_decrease', requirements: ['key' => '[A-Z0-9]+'])]
    public function decrease($key): Response
    {
        $cart = $this->session->get('cart', []);
        $qty = $cart[$key]['qty']--;

        if($qty > 0) {
            $this->session->set('cart', $cart);
            return $this->listing();
        } else {
            return $this->delete($key);
        }

    }
}
