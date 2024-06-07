<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Order;
use App\Helper\CartHelper;
use App\Helper\VATCalculator;
use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

final class OrderController extends AbstractController
{
    #[Route(path: '/commande/initier', name: 'order_checkout')]
    public function checkout(Request $request, OrderRepository $repository, SessionInterface $session): Response
    {
        $cart = $session->get('cart', []);

        // S'il n'y a pas d'élément dans le panier, on redirige l'utilisateur vers la page "Panier"
        if (0 == count($cart)) {
            $this->addFlash("error", "Impossible de procéder au paiement car vous n'avez aucun produit dans votre panier");
            return $this->redirectToRoute('cart_detail');
        }

        $totalPrice = CartHelper::getTotalPrice($cart);

        $form = $this->createFormBuilder()
            ->add('address', TextType::class, ['label' => 'Adresse',
                "attr" => [
                    'placeholder' => "19 Rue des développeurs passionés"
                ]
            ])
            ->add('zipcode', TextType::class, ['label' => 'Code postal',
                "attr" => [
                    'placeholder' => "69003"
                ]
            ])
            ->add('city', TextType::class, ['label' => 'Ville', 
                "attr" => [
                    'placeholder' => "Lyon"
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Valider la commande',
                'attr' => ['class' => 'btn-success btn-lg']
            ])
            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $order = new Order($data['address'], $data['zipcode'], $data['city'], $cart, $totalPrice);

            $orderId = $repository->place($order);
            return $this->redirectToRoute('order_validate', [ 'id' => $orderId]);
        }

        return $this->render('order/deliveryform.html.twig', [
            'cart' => $cart,
            'prices' => VATCalculator::getPriceArray($totalPrice),
            'form' => $form->createView()
        ]);
    }

    #[Route(path: '/commande/valider/{id}', name: 'order_validate', requirements: ['id' => '\d+'])]
    public function valdate(Order $order): Response
    {
        return $this->render('order/summary.html.twig', [
            'order' => $order,
        ]);
    }

}
