<?php

namespace App\Controller;

use App\Repository\BookRepository;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class DefaultController extends AbstractController
{
    /** @var BookRepository */
    private ?BookRepository $bookRepository = null;

    /** @var MovieRepository */
    private ?MovieRepository $movieRepository = null;

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

    #[Route(path: '/', name: 'homepage')]
    public function index()
    {
        return $this->render('default/index.html.twig', [
            'lastBooks' => $this->bookRepository->getLast(),
            'lastMovies' => $this->movieRepository->getLast(),
        ]);
    }
}
