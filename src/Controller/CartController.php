<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Product;
use App\Form\CartType;
use App\Repository\CartRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cart")
 */
class CartController extends AbstractController
{

    /**
     * @Route("/display", name="cart_display", methods={"GET"})
     */
    public function display(SessionInterface $session):Response
    {
        $session->start();
        $cart = null;
        if($session->get('shopping')){
            $cart = $session->get('shopping');

        }

        return $this->render('cart/display.html.twig',[
            'cart' => $cart
        ]);
    }

    /**
     * @Route("/add", name="cart_add", methods="GET")
     */
    public function modify(Request $request, SessionInterface $session, int $id = 0):Response
    {
        $id = $request->query->getInt('product') ?? null;
        if(!$id){
            return new Response('Product does not exist');
        }
        // query product in Db by Id
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findOneBy([
                'id'=>$id
            ]);
        if(!$product){
            return new Response('Product does not exist');
        }

        $session->start();

        if($session->get('shopping')){
            $cart = $session->get('shopping');
            $products = $cart->getProductList();
            // Add product to cart if stock > 0
            $inStock = $product->getInStock();
            if($inStock > 0){
                $products[] = $product;
            }
            // Update and check stock in DB - do that when product is bought
            // if stock updated now user block that stock - and holds in cart
            // for hours/ days preventing others from buying.

            $cart->setProductList($products);
            $session->set('shopping', $cart);
            return $this->redirectToRoute('app_homepage');

        }

        return new Response('no cart');
    }

    /**
     * @Route("/", name="cart_index", methods={"GET"})
     */
    public function index(CartRepository $cartRepository): Response
    {
        return $this->render('cart/index.html.twig', [
            'carts' => $cartRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cart_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cart = new Cart();
        $form = $this->createForm(CartType::class, $cart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cart);
            $entityManager->flush();

            return $this->redirectToRoute('cart_index');
        }

        return $this->render('cart/new.html.twig', [
            'cart' => $cart,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cart_show", methods={"GET"})
     */
    public function show(Cart $cart): Response
    {
        return $this->render('cart/show.html.twig', [
            'cart' => $cart,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cart_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cart $cart): Response
    {
        $form = $this->createForm(CartType::class, $cart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cart_index');
        }

        return $this->render('cart/edit.html.twig', [
            'cart' => $cart,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cart_delete", methods={"POST"})
     */
    public function delete(Request $request, Cart $cart): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cart->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cart);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cart_index');
    }
}
