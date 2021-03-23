<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\FilesystemService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
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
     * @IsGranted("ROLE_USER")
     */
    public function index(): Response
    {
        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAll();


        return $this->render('default/index.html.twig', [
           'products'=>$products

        ]);
    }
}
