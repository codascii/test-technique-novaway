<?php

namespace App\Controller;

use App\Repository\BookRepository;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /** @var BookRepository */
    private $bookRepository;

    /** @var MovieRepository */
    private $filmRepository;

    /**
     * DefaultController constructor.
     * @param BookRepository $bookRepository
     * @param MovieRepository $movieRepository
     */
    public function __construct(
        BookRepository $bookRepository,
        MovieRepository $movieRepository
    )
    {
        $this->bookRepository = $bookRepository;
        $this->movieRepository = $movieRepository;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        return $this->render('default/index.html.twig', [
            'lastBooks' => $this->bookRepository->getLastFour(),
            'lastMovies' => $this->movieRepository->getLastFour(),
        ]);
    }
}
