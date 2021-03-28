<?php

namespace App\Controller;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalHttp\HttpException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PayPalController extends AbstractController
{
    /**
     * @Route("/paypal", name="pay_pal")
     */
    public function index(): Response
    {
        $environment = new SandboxEnvironment($_ENV['PAYPAL_CLIENT_ID'], $_ENV['PAYPAL_SECRET']);
        $client = new PayPalHttpClient($environment);

        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
            "intent"=>"CAPTURE",
            "purchase_units"=>[[
                "reference_id"=>"test_ref_id1",
                "amount"=>[
                    "value"=>"1.00",
                    "currency_code"=>"EUR"
                ]
            ]],
            "application_context"=>[
                "cancel_url"=>"https://example.com/cancel",
                "return_url"=>"https://example.com/return"
            ]
        ];

        try {
            $response = $client->execute($request);
            $links = $response->result->links;
            //print_r($links);
        }catch(HttpException $ex){
            echo $ex->statusCode;
            print_r($ex->getMessage());
        }

        //dd('ok');
        return $this->render('pay_pal/index.html.twig', [
            'links'=>$links
        ]);
    }
}
