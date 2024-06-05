<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    /**
     * @Route("/livres/", name="book_list")
     */
    public function list(): Response
    {
        $books = $this->get(BookRepository::class)->findAll();

        return $this->render('book/list.html.twig', [
            'books' => $books,
        ]);
    }

    #[Route('/livre/{id}', name: 'book_detail')]
    public function detail(Book $book): Response
    {
        return $this->render('book/detail.html.twig', [
            'book' => $book,
        ]);
    }

    /**
     * @Route("/livre/{id}/ajouter-au-panier", name="book_add_to_cart")
     */
    public function addToCart(Book $book): Response
    {
        $session = $this->get('session');

        $cart = $session->get('cart', []);
        $cart[$book->getIsnb()] = [ 'item' => $book , 'qty' => ($cart[$book->getIsnb()]['qty'] ?? 0) + 1 ];
        $session->set('cart', $cart);

        return $this->detail($book);
    }
}
