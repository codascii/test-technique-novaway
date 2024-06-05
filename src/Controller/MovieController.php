<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    /**
     * @Route("/films/", name="movie_list")
     */
    public function list(): Response
    {
        $movies = $this->get(MovieRepository::class)->findAll();

        return $this->render('movie/list.html.twig', [
            'movies' => $movies,
        ]);
    }
    /**
     * @Route("/film/{id}", name="movie_detail")
     */
    public function detail(Movie $movie): Response
    {
        return $this->render('movie/detail.html.twig', [
            'movie' => $movie,
        ]);
    }

    /**
     * @Route("/film/{id}/ajouter-au-panier", name="movie_add_to_cart")
     */
    public function addToCart(Movie $movie): Response
    {
        $session = $this->get('session');

        $cart = $session->get('cart', []);
        $cart[$movie->getAsin()] = [ 'item' => $movie , 'qty' => ($cart[$movie->getAsin()]['qty'] ?? 0) + 1 ];
        $session->set('cart', $cart);

        return $this->detail($movie);
    }
}
