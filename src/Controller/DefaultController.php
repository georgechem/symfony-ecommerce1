<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\FilesystemService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function index(FilesystemService $filesystemService): Response
    {
        $files = $filesystemService
            ->getFilesFromDirectory('/src/Entity');


        return $this->render('default/index.html.twig', [
           'files'=>$files

        ]);
    }
}
