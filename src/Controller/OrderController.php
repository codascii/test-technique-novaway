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
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Sequentially;
use ZipCodeValidator\Constraints\ZipCode;

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
            ->add('address', TextType::class, [
                'label' => 'Adresse',
                "required" => true,
                "empty_data" => "",
                "constraints" => new Sequentially([
                    new NotBlank(message: "L'adresse de livraison est obligatoire."),
                    new Length(min: 5, minMessage: "L'adresse de livraison doit avoir au moins 5 caractères.")
                ]),
                "attr" => [
                    'placeholder' => "19 Rue des développeurs passionés"
                ]
            ])
            ->add('zipcode', TextType::class, [
                'label' => 'Code postal',
                "required" => true,
                "empty_data" => "",
                "constraints" => new Sequentially([
                    new NotBlank(message: "Le code postal est obligatoire."),
                    new Length(exactly: 5, exactMessage: "Le code postal doit avoir exactement 5 caractères."),
                    new ZipCode([
                        "iso" => "FR",
                        "message" => "Veuillez renseigner un code postale valide."
                    ])
                ]),
                "attr" => [
                    'placeholder' => "69003"
                ]
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville', 
                "required" => true,
                "empty_data" => "",
                "constraints" => new Sequentially( [
                    new NotBlank(message: "La ville de livraison est obligatoire."),
                    new Length(min: 2, minMessage: "La ville de livraison doit avoir au moins 2 caractères.")
                ]),
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
