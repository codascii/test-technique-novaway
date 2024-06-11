<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

final class MovieController extends AbstractController
{
    public function __construct(private MovieRepository $movieRepository)
    {}

    #[Route(path: '/films', name: 'movie_list')]
    public function list(): Response
    {
        $movies = $this->movieRepository->findAll();

        return $this->render('movie/list.html.twig', [
            'movies' => $movies,
        ]);
    }
    #[Route(path: '/film/{id}', name: 'movie_detail', requirements: ['id' => '\d+'])]
    public function detail(Movie $movie): Response
    {
        return $this->render('movie/detail.html.twig', [
            'movie' => $movie,
        ]);
    }

    #[Route(path: '/film/{id}/ajouter-au-panier', name: 'movie_add_to_cart', requirements: ['id' => '\d+'])]
    public function addToCart(Movie $movie, SessionInterface $session): Response
    {
        $cart = $session->get('cart', []);
        $cartKey = $movie->getAsin();

        // Récupération de la quantité déjà présente dans le panier, sinon 0.
        $currentQuantity = $cart[$cartKey]['qty'] ?? 0;

        $cart[$cartKey] = [ 'item' => $movie , 'qty' => $currentQuantity + 1 ];
        $session->set('cart', $cart);

        // Ajout d'un message flash indiquant que le livre est bien ajouté au panier
        $this->addFlash(
            'success',
            'Le film <strong>' . $movie->getTitle() . '</strong> a bien été ajouter au panier.'
        );

        return $this->detail($movie);
    }
}
