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
        // check is shopping cart exist - if no Redirect
        $cart = $session->get('shopping') ?? null;
        $user = $this->getUser();
        if(!$cart){
            return $this->redirectToRoute('app_homepage');
        }
        // which method used POST or GET
        $em = $this->getDoctrine()->getManager();
        if($request->isMethod('post')){
            // method POST
            $isError = false;
            foreach($request->request->all() as $key => $item)
            {
                $data[$key] = filter_var($item, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                if(!$item && !$isError){
                    $this->addFlash('error', 'All fields are required');
                    $isError = true;

                }
            }
            // check is User logged in or NOT
            if($user && !$isError){
                //user LOGGED IN - POST
                // GET User from DB as it is logged
                if($encoder->isPasswordValid($user, $data['password'])){
                    /**
                     * Email & Password shouldn't be overridden here
                     * for Password & Email Separate logic - as it is good Practice
                     */
                    // Password valid allow override data
                    $user->setFirstName($data['firstName']);
                    $user->setLastName($data['lastName']);
                    $user->setStreetName($data['streetName']);
                    $user->setHouseNumber($data['houseNumber']);
                    $user->setPostCode($data['postCode']);
                    $user->setCity($data['city']);
                    $user->setCounty($data['county']);
                    $user->setPhone($data['phone']);
                    $em->persist($user);
                    $em->flush();
                    $this->addFlash('success', 'User data saved successfully');
                }else{
                    // Display message that Password is not valid
                    $this->addFlash('error','Invalid Password');
                }

            }elseif(!$isError){
                //user NOT LOGGED IN - POST
                $email = $em->getRepository(User::class)
                    ->findOneBy([
                        'email'=>$data['email']
                    ]);
                if($email){
                    $this->addFlash('error', 'User with that email is already registered');
                }else{
                    $user = new User();
                    $user->setEmail($data['email']);
                    $user->setPassword($encoder->encodePassword($user,$data['password']));
                    $user->setFirstName($data['firstName']);
                    $user->setLastName($data['lastName']);
                    $user->setStreetName($data['streetName']);
                    $user->setHouseNumber($data['houseNumber']);
                    $user->setPostCode($data['postCode']);
                    $user->setCity($data['city']);
                    $user->setCounty($data['county']);
                    $user->setPhone($data['phone']);
                    $em->persist($user);
                    $em->flush();
                    $redirectionTime = (int) $this->getParameter('redirectionDelay');
                    $this->addFlash('success',"Registration successful - please Log In redirection after {$redirectionTime}s");
                    $urlRedirect = $this->generateUrl('app_login');
                    header("Refresh: {$redirectionTime}; {$urlRedirect}");

                }

            }
        }
        /**
         * For Both methods GET and POST
         */
        $order = new Order();
        $order->setProductList($cart->getProductList());
        $order->setProductAmount($cart->getProductAmount());
        $order->setUuidSession($session->getId());
        $order->setCreatedAt(new DateTime());
        $metaData = $session->getMetadataBag();
        $expire = $metaData->getCreated() + $metaData->getLifetime();
        $order->setExpireAt(DateTime::createFromFormat('U', $expire));
        $order->setIsPaid(false);
        $order->setUuidSession($session->getId());
        // check is User logged in or NOT
        if($user){
            //user LOGGED IN
            $order->setUuidUserId($user->getId());
        }

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
