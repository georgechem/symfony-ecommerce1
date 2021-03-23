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

        $products = [
            [
                'id'=>1,
                'name'=>'camera',
                'price'=>rand(100, 10000)/100,
                'inStock'=> rand(0,7),
                'rating'=>rand(5,50)/10,
                'numRating'=>rand(10, 200),
                'category'=>'electronics',
                'colors'=>[
                    '#0a0',
                    '#f00',
                    '#af0',
                    '#00f',
                    '#fff'
                ],
                'deliveryIn'=>rand(1, 7),
                'img'=>"/images/cam0a1.jpg",
                'prefix'=>'/ecommerce/public',
                'description'=>'Praesent sodales vulputate sem, eu porttitor odio aliquet eu. Integer ut sapien a enim commodo tempus et a mauris. Fusce metus erat, faucibus et lobortis a, molestie vitae erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque sit amet viverra purus. Nam vitae urna vel libero euismod auctor. Cras sit amet lacus tortor. Suspendisse potenti. Suspendisse potenti. Integer tincidunt accumsan mollis.',

            ]];

        return $this->render('default/index.html.twig', [
           'products'=>$products

        ]);
    }
}
