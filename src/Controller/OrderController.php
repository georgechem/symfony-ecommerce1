<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\User;
use App\Form\OrderType;
use App\Repository\OrderRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/order")
 */
class OrderController extends AbstractController
{
    /**
     * @Route("/", name="order_index", methods={"GET"})
     */
    public function index(OrderRepository $orderRepository): Response
    {
        return $this->render('order/index.html.twig', [
            'orders' => $orderRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="order_new", methods={"GET","POST"})
     */
    public function new(Request $request, SessionInterface $session, UserPasswordEncoderInterface $encoder): Response
    {
        $session->start();
        $cart = $session->get('shopping') ?? null;
        if(!$cart){
            return $this->redirectToRoute('app_homepage');
        }
        $user = $this->getUser();


        if($request->isMethod('post')){
            // handling user form
            $isError = false;
            foreach($request->request->all() as $key => $item)
            {
                $data[$key] = filter_var($item, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                if(!$item && !$isError){
                    $this->addFlash('error', 'All fields are required');
                    $isError = true;

                }
            }
            // create user with Address
            if(!$isError){
                // check is user already in DB
                if(!$user){
                    $user = $this->getDoctrine()->getRepository(User::class)
                    ->findOneBy([
                        'email'=>$data['email'],
                    ]);
                }

                if(!$user){
                    $user = new User();
                    $user->setEmail($data['email']);
                    $user->setPassword($encoder->encodePassword($user,$data['password']));

                }
                $user->setFirstName($data['firstName']);
                $user->setLastName($data['lastName']);
                $user->setStreetName($data['streetName']);
                $user->setHouseNumber($data['houseNumber']);
                $user->setPostCode($data['postCode']);
                $user->setCity($data['city']);
                $user->setCounty($data['county']);
                $user->setPhone($data['phone']);
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($user);
                $manager->flush();
                if($this->getUser()){
                    $this->addFlash('success', 'Address saved successfully');
                }

            }


        }


        $order = new Order();
        $order->setProductList($cart->getProductList());
        $order->setProductAmount($cart->getProductAmount());
        $order->setUuidSession($session->getId());
        if($user = $this->getUser()){
            $order->setUuidUserId($user->getId());
        }
        $order->setCreatedAt(new \DateTime());
        $metaData = $session->getMetadataBag();
        $expire = $metaData->getCreated() + $metaData->getLifetime();
        $order->setExpireAt(DateTime::createFromFormat('U', $expire));
        $order->setIsPaid(false);


        return $this->render('order/new.html.twig', [
            'order'=>$order,

        ]);
    }

    /**
     * @Route("/{id}", name="order_show", methods={"GET"})
     */
    public function show(Order $order): Response
    {
        return $this->render('order/show.html.twig', [
            'order' => $order,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="order_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Order $order): Response
    {
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('order_index');
        }

        return $this->render('order/edit.html.twig', [
            'order' => $order,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="order_delete", methods={"POST"})
     */
    public function delete(Request $request, Order $order): Response
    {
        if ($this->isCsrfTokenValid('delete'.$order->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($order);
            $entityManager->flush();
        }

        return $this->redirectToRoute('order_index');
    }
}
