<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Product;
use App\Service\FilesystemService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    private $session;
    private $files;

    public function __construct(FilesystemService $filesystemService, SessionInterface $session){

        $this->session = $session;
        $this->files = $filesystemService
            ->getFilesFromDirectory('/src/Entity');

    }
    /**
     * @Route("/", name="app_homepage")
     * //@IsGranted("ROLE_USER")
     */
    public function index(): Response
    {

        if(!$this->session->isStarted()){
            // do if session is not yet started
            $this->session->start();
            //$this->session->invalidate();
            $cart = new Cart();
            $cart->setCreatedAt(new \DateTime());
            $cart->setIsCompleted(false);
            $cart->setUuid($this->session->getId());
            $this->session->set('shopping', $cart);

        }else{
            $this->session->start();
        }

        //return new Response(print_r($this->session->get('shopping')));

        //dd($test);

        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAll();


        return $this->render('default/index.html.twig', [
           'products'=>$products

        ]);
    }
}
