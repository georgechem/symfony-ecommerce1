<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\FilesystemService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{

    public function __construct(FilesystemService $filesystemService){

        $this->files = $filesystemService
            ->getFilesFromDirectory('/src/Entity');

    }
    /**
     * @Route("/", name="app_homepage")
     */
    public function index(): Response
    {

        return $this->render('default/index.html.twig', [
           'files'=>$this->files

        ]);
    }
}
