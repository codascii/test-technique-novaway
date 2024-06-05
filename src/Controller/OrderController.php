<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Order;
use App\Helper\VATCalculator;
use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route("/commande/initier", name="order_checkout")
     */
    public function checkout(Request $request, OrderRepository $repository): Response
    {
        $session = $this->get('session');
        $cart = $session->get('cart', []);

        $totalPrice = array_sum(array_map(function ($item) {
            return $item['item']->getPrice() * $item['qty'];
        }, $cart));

        $form = $this->createFormBuilder()
            ->add('address', TextType::class, ['label' => 'Adresse'])
            ->add('zipcode', TextType::class, ['label' => 'Code postal'])
            ->add('city', TextType::class, ['label' => 'Ville'])
            ->add('save', SubmitType::class, [
                'label' => 'Valider la commande',
                'attr' => ['class' => 'btn-success']
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
//
    }

    /**
     * @Route("/commande/valider/{id}", name="order_validate")
     */
    public function valdate(Order $order): Response
    {
        return $this->render('order/summary.html.twig', [
            'order' => $order,
        ]);
    }

}
