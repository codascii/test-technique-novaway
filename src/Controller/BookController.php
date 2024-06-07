<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

final class BookController extends AbstractController
{
    public function __construct(private BookRepository $bookRepository)
    {}

    #[Route(path: '/livres', name: 'book_list')]
    public function list(): Response
    {
        $books = $this->bookRepository->findAll();

        return $this->render('book/list.html.twig', [
            'books' => $books,
        ]);
    }

    #[Route('/livre/{id}', name: 'book_detail', requirements: ['id' => '\d+'])]
    public function detail(Book $book): Response
    {
        return $this->render('book/detail.html.twig', [
            'book' => $book,
        ]);
    }

    #[Route(path: '/livre/{id}/ajouter-au-panier', name: 'book_add_to_cart', requirements: ['id' => '\d+'])]
    public function addToCart(Book $book, SessionInterface $session): Response
    {
        $cart = $session->get('cart', []);
        $cartKey = $book->getIsnb();

        // Récupération de la quantité déjà présente dans le panier, sinon 0.
        $currentQuantity = $cart[$cartKey]['qty'] ?? 0;

        $cart[$cartKey] = [ 'item' => $book , 'qty' => $currentQuantity + 1 ];
        $session->set('cart', $cart);

        // Ajout d'un message flash indiquant que le livre est bien ajouté au panier
        $this->addFlash(
            'success',
            'Le livre <strong>' . $book->getTitle() . '</strong> a bien été ajouter au panier.'
        );

        return $this->detail($book);
    }
}
