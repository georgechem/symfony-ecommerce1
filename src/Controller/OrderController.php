<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\Order;
use App\Form\OrderType;
use App\Repository\OrderRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

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
    public function new(Request $request, SessionInterface $session): Response
    {
        $session->start();
        $cart = $session->get('shopping') ?? null;
        if(!$cart){
            return $this->redirectToRoute('app_homepage');
        }
        $uuid = $session->getId();
        //$isAddress = false;
        $address = $this->getDoctrine()->getRepository(Address::class)
            ->findOneBy([
                'uuidSession'=>$uuid
            ]);
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
            // create user address
            if(!$isError){
                $expire = (int) $this->getParameter('expire');
                // find is already address for that id and not expired
                $address = $this->getDoctrine()->getRepository(Address::class)
                    ->findOneBy([
                        'uuidSession'=>$uuid
                    ]);
                $isAddressExpired = true;
                if($address){
                    $activeAddressExpireAt = (int) $address->getExpireAt()->format('U');
                    //dd($activeAddressExpireAt, time());
                    if(time() < $activeAddressExpireAt){
                        $isAddressExpired = false;
                    }

                }
                if($isAddressExpired && $address){
                    $manager = $this->getDoctrine()->getManager();
                    $manager->remove($address);
                    $manager->flush();
                }

                if(!$address){
                    $address = new Address();
                    $address->setFirstName($data['firstName']);
                    $address->setLastName($data['lastName']);
                    $address->setStreetName($data['streetName']);
                    $address->setHouseNumber($data['houseNumber']);
                    $address->setPostCode($data['postCode']);
                    $address->setCity($data['city']);
                    $address->setCounty($data['county']);
                    $address->setPhone($data['phone']);
                    $address->setUuidSession($uuid);
                    $address->setExpireAt(DateTime::createFromFormat('U', (time()+$expire)));
                    $manager = $this->getDoctrine()->getManager();
                    $manager->persist($address);
                    $manager->flush();
                }

                //$isAddress = true;
                $this->addFlash('success', 'Address saved successfully');
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
            'address'=>$address,
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
