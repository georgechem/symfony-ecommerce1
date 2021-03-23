<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/api/products", name="api_product", methods={"GET"})
     */
    public function index(): JsonResponse
    {

        //$path = "/ecommerce/public";
        $path = "";

        $products = [
            [
                'id'=>1,
                'name'=>'camera',
                'price'=>rand(100, 10000)/100,
                'inStock'=> 3,
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
                'img'=>"{$path}/images/cam0a1.jpg",
                'description'=>'Praesent sodales vulputate sem, eu porttitor odio aliquet eu. Integer ut sapien a enim commodo tempus et a mauris. Fusce metus erat, faucibus et lobortis a, molestie vitae erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque sit amet viverra purus. Nam vitae urna vel libero euismod auctor. Cras sit amet lacus tortor. Suspendisse potenti. Suspendisse potenti. Integer tincidunt accumsan mollis.',

            ],
            [
                'id'=>2,
                'name'=>'camera',
                'price'=>rand(100, 10000)/100,
                'inStock'=> rand(0, 15),
                'rating'=>rand(5,50)/10,
                'numRating'=>rand(10, 200),
                'category'=>'electronics',
                'colors'=>[
                    '#000',
                    '#f0a',
                    '#0f0',
                    '#00f',
                    '#faf'
                ],
                'deliveryIn'=>rand(1, 7),
                'img'=>"{$path}/images/camera01.jpg",
                'description'=>'Praesent sodales vulputate sem, eu porttitor odio aliquet eu. Integer ut sapien a enim commodo tempus et a mauris. Fusce metus erat, faucibus et lobortis a, molestie vitae erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque sit amet viverra purus. Nam vitae urna vel libero euismod auctor. Cras sit amet lacus tortor. Suspendisse potenti. Suspendisse potenti. Integer tincidunt accumsan mollis.',

            ],
            [
                'id'=>3,
                'name'=>'camera',
                'price'=>rand(100, 10000)/100,
                'inStock'=> rand(0, 15),
                'rating'=>rand(5,50)/10,
                'numRating'=>rand(10, 200),
                'category'=>'electronics',
                'colors'=>[
                    '#000',
                    '#f00',
                    '#0f0',
                    '#00f',
                    '#fff'
                ],
                'deliveryIn'=>rand(1, 7),
                'img'=>"{$path}/images/camera02a.jpg",
                'description'=>'Praesent sodales vulputate sem, eu porttitor odio aliquet eu. Integer ut sapien a enim commodo tempus et a mauris. Fusce metus erat, faucibus et lobortis a, molestie vitae erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque sit amet viverra purus. Nam vitae urna vel libero euismod auctor. Cras sit amet lacus tortor. Suspendisse potenti. Suspendisse potenti. Integer tincidunt accumsan mollis.',

            ],
            [
                'id'=>4,
                'name'=>'Processor',
                'price'=>rand(100, 10000)/100,
                'inStock'=> rand(0, 15),
                'rating'=>rand(5,50)/10,
                'numRating'=>rand(10, 200),
                'category'=>'electronics',
                'colors'=>[
                    '#000',
                    '#f00',
                    '#5f0',
                    '#00f',
                    '#fff'
                ],
                'deliveryIn'=>rand(1, 7),
                'img'=>"{$path}/images/cpu01.jpg",
                'description'=>'Praesent sodales vulputate sem, eu porttitor odio aliquet eu. Integer ut sapien a enim commodo tempus et a mauris. Fusce metus erat, faucibus et lobortis a, molestie vitae erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque sit amet viverra purus. Nam vitae urna vel libero euismod auctor. Cras sit amet lacus tortor. Suspendisse potenti. Suspendisse potenti. Integer tincidunt accumsan mollis.',

            ],
            [
                'id'=>5,
                'name'=>'Processor',
                'price'=>rand(100, 10000)/100,
                'inStock'=> rand(0, 15),
                'rating'=>rand(5,50)/10,
                'numRating'=>rand(10, 200),
                'category'=>'electronics',
                'colors'=>[
                    '#000',
                    '#f05',
                    '#0f0',
                    '#00f',
                    '#fff'
                ],
                'deliveryIn'=>rand(1, 7),
                'img'=>"{$path}/images/cpu02.jpg",
                'description'=>'Praesent sodales vulputate sem, eu porttitor odio aliquet eu. Integer ut sapien a enim commodo tempus et a mauris. Fusce metus erat, faucibus et lobortis a, molestie vitae erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque sit amet viverra purus. Nam vitae urna vel libero euismod auctor. Cras sit amet lacus tortor. Suspendisse potenti. Suspendisse potenti. Integer tincidunt accumsan mollis.',

            ],
            [
                'id'=>6,
                'name'=>'Flashlight',
                'price'=>rand(100, 10000)/100,
                'inStock'=> rand(0, 15),
                'rating'=>rand(5,50)/10,
                'numRating'=>rand(10, 200),
                'category'=>'electronics',
                'colors'=>[
                    '#000',
                    '#f00',
                    '#8f0',
                    '#00f',
                    '#fff'
                ],
                'deliveryIn'=>rand(1, 7),
                'img'=>"{$path}/images/flashlight01.jpg",
                'description'=>'Praesent sodales vulputate sem, eu porttitor odio aliquet eu. Integer ut sapien a enim commodo tempus et a mauris. Fusce metus erat, faucibus et lobortis a, molestie vitae erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque sit amet viverra purus. Nam vitae urna vel libero euismod auctor. Cras sit amet lacus tortor. Suspendisse potenti. Suspendisse potenti. Integer tincidunt accumsan mollis.',

            ],
            [
                'id'=>7,
                'name'=>'Headphones',
                'price'=>rand(100, 10000)/100,
                'inStock'=> rand(0, 15),
                'rating'=>rand(5,50)/10,
                'numRating'=>rand(10, 200),
                'category'=>'electronics',
                'colors'=>[
                    '#000',
                    '#f00',
                    '#0f0',
                    '#16f',
                    '#fff'
                ],
                'deliveryIn'=>rand(1, 7),
                'img'=>"{$path}/images/headphones01.jpg",
                'description'=>'Praesent sodales vulputate sem, eu porttitor odio aliquet eu. Integer ut sapien a enim commodo tempus et a mauris. Fusce metus erat, faucibus et lobortis a, molestie vitae erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque sit amet viverra purus. Nam vitae urna vel libero euismod auctor. Cras sit amet lacus tortor. Suspendisse potenti. Suspendisse potenti. Integer tincidunt accumsan mollis.',

            ],
            [
                'id'=>8,
                'name'=>'Ipad',
                'price'=>rand(100, 10000)/100,
                'inStock'=> rand(0, 15),
                'rating'=>rand(5,50)/10,
                'numRating'=>rand(10, 200),
                'category'=>'electronics',
                'colors'=>[
                    '#000',
                    '#f30',
                    '#0f0',
                    '#00f',
                    '#fff'
                ],
                'deliveryIn'=>rand(1, 7),
                'img'=>"{$path}/images/ipad01.jpg",
                'description'=>'Praesent sodales vulputate sem, eu porttitor odio aliquet eu. Integer ut sapien a enim commodo tempus et a mauris. Fusce metus erat, faucibus et lobortis a, molestie vitae erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque sit amet viverra purus. Nam vitae urna vel libero euismod auctor. Cras sit amet lacus tortor. Suspendisse potenti. Suspendisse potenti. Integer tincidunt accumsan mollis.',

            ],
            [
                'id'=>9,
                'name'=>'Jackplug',
                'price'=>rand(100, 10000)/100,
                'inStock'=> rand(0, 15),
                'rating'=>rand(5,50)/10,
                'numRating'=>rand(10, 200),
                'category'=>'electronics',
                'colors'=>[
                    '#000',
                    '#f00',
                    '#0f0',
                    '#00f',
                    '#fff'
                ],
                'deliveryIn'=>rand(1, 7),
                'img'=>"{$path}/images/jackplug01.jpg",
                'description'=>'Praesent sodales vulputate sem, eu porttitor odio aliquet eu. Integer ut sapien a enim commodo tempus et a mauris. Fusce metus erat, faucibus et lobortis a, molestie vitae erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque sit amet viverra purus. Nam vitae urna vel libero euismod auctor. Cras sit amet lacus tortor. Suspendisse potenti. Suspendisse potenti. Integer tincidunt accumsan mollis.',

            ],
            [
                'id'=>10,
                'name'=>'Keyboard',
                'price'=>rand(100, 10000)/100,
                'inStock'=> rand(0, 15),
                'rating'=>rand(5,50)/10,
                'numRating'=>rand(10, 200),
                'category'=>'electronics',
                'colors'=>[
                    '#000',
                    '#f00',
                    '#0f0',
                    '#00f',
                    '#fff'
                ],
                'deliveryIn'=>rand(1, 7),
                'img'=>"{$path}/images/keyboard01.jpg",
                'description'=>'Praesent sodales vulputate sem, eu porttitor odio aliquet eu. Integer ut sapien a enim commodo tempus et a mauris. Fusce metus erat, faucibus et lobortis a, molestie vitae erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque sit amet viverra purus. Nam vitae urna vel libero euismod auctor. Cras sit amet lacus tortor. Suspendisse potenti. Suspendisse potenti. Integer tincidunt accumsan mollis.',

            ],
            [
                'id'=>11,
                'name'=>'Memory',
                'price'=>rand(100, 10000)/100,
                'inStock'=> rand(0, 15),
                'rating'=>rand(5,50)/10,
                'numRating'=>rand(10, 200),
                'category'=>'electronics',
                'colors'=>[
                    '#000',
                    '#f00',
                    '#0f0',
                    '#00f',
                    '#fff'
                ],
                'deliveryIn'=>rand(1, 7),
                'img'=>"{$path}/images/memory01.jpg",
                'description'=>'Praesent sodales vulputate sem, eu porttitor odio aliquet eu. Integer ut sapien a enim commodo tempus et a mauris. Fusce metus erat, faucibus et lobortis a, molestie vitae erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque sit amet viverra purus. Nam vitae urna vel libero euismod auctor. Cras sit amet lacus tortor. Suspendisse potenti. Suspendisse potenti. Integer tincidunt accumsan mollis.',

            ],
            [
                'id'=>12,
                'name'=>'Memory',
                'price'=>rand(100, 10000)/100,
                'inStock'=> rand(0, 15),
                'rating'=>rand(5,50)/10,
                'numRating'=>rand(10, 200),
                'category'=>'electronics',
                'colors'=>[
                    '#000',
                    '#f00',
                    '#0f0',
                    '#00f',
                    '#fff'
                ],
                'deliveryIn'=>rand(1, 7),
                'img'=>"{$path}/images/memory02.jpg",
                'description'=>'Praesent sodales vulputate sem, eu porttitor odio aliquet eu. Integer ut sapien a enim commodo tempus et a mauris. Fusce metus erat, faucibus et lobortis a, molestie vitae erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque sit amet viverra purus. Nam vitae urna vel libero euismod auctor. Cras sit amet lacus tortor. Suspendisse potenti. Suspendisse potenti. Integer tincidunt accumsan mollis.',

            ],
            [
                'id'=>13,
                'name'=>'Microphone',
                'price'=>rand(100, 10000)/100,
                'inStock'=> rand(0, 15),
                'rating'=>rand(5,50)/10,
                'numRating'=>rand(10, 200),
                'category'=>'electronics',
                'colors'=>[
                    '#000',
                    '#f00',
                    '#0f0',
                    '#00f',
                    '#fff'
                ],
                'deliveryIn'=>rand(1, 7),
                'img'=>"{$path}/images/mic01b.jpg",
                'description'=>'Praesent sodales vulputate sem, eu porttitor odio aliquet eu. Integer ut sapien a enim commodo tempus et a mauris. Fusce metus erat, faucibus et lobortis a, molestie vitae erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque sit amet viverra purus. Nam vitae urna vel libero euismod auctor. Cras sit amet lacus tortor. Suspendisse potenti. Suspendisse potenti. Integer tincidunt accumsan mollis.',

            ],
            [
                'id'=>14,
                'name'=>'Mouse',
                'price'=>rand(100, 10000)/100,
                'inStock'=> rand(0, 15),
                'rating'=>rand(5,50)/10,
                'numRating'=>rand(10, 200),
                'category'=>'electronics',
                'colors'=>[
                    '#000',
                    '#f00',
                    '#0f0',
                    '#00f',
                    '#fff'
                ],
                'deliveryIn'=>rand(1, 7),
                'img'=>"{$path}/images/mouse01.jpg",
                'description'=>'Praesent sodales vulputate sem, eu porttitor odio aliquet eu. Integer ut sapien a enim commodo tempus et a mauris. Fusce metus erat, faucibus et lobortis a, molestie vitae erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque sit amet viverra purus. Nam vitae urna vel libero euismod auctor. Cras sit amet lacus tortor. Suspendisse potenti. Suspendisse potenti. Integer tincidunt accumsan mollis.',

            ],
            [
                'id'=>15,
                'name'=>'Mouse',
                'price'=>rand(100, 10000)/100,
                'inStock'=> rand(0, 15),
                'rating'=>rand(5,50)/10,
                'numRating'=>rand(10, 200),
                'category'=>'electronics',
                'colors'=>[
                    '#000',
                    '#f00',
                    '#0f0',
                    '#00f',
                    '#fff'
                ],
                'deliveryIn'=>rand(1, 7),
                'img'=>"{$path}/images/mouse02.jpg",
                'description'=>'Praesent sodales vulputate sem, eu porttitor odio aliquet eu. Integer ut sapien a enim commodo tempus et a mauris. Fusce metus erat, faucibus et lobortis a, molestie vitae erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque sit amet viverra purus. Nam vitae urna vel libero euismod auctor. Cras sit amet lacus tortor. Suspendisse potenti. Suspendisse potenti. Integer tincidunt accumsan mollis.',

            ],
            [
                'id'=>16,
                'name'=>'MP3 Player',
                'price'=>rand(100, 10000)/100,
                'inStock'=> rand(0, 15),
                'rating'=>rand(5,50)/10,
                'numRating'=>rand(10, 200),
                'category'=>'electronics',
                'colors'=>[
                    '#000',
                    '#f00',
                    '#0f0',
                    '#00f',
                    '#fff'
                ],
                'deliveryIn'=>rand(1, 7),
                'img'=>"{$path}/images/mp3player01.jpg",
                'description'=>'Praesent sodales vulputate sem, eu porttitor odio aliquet eu. Integer ut sapien a enim commodo tempus et a mauris. Fusce metus erat, faucibus et lobortis a, molestie vitae erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque sit amet viverra purus. Nam vitae urna vel libero euismod auctor. Cras sit amet lacus tortor. Suspendisse potenti. Suspendisse potenti. Integer tincidunt accumsan mollis.',

            ],
            [
                'id'=>17,
                'name'=>'Multimeter',
                'price'=>rand(100, 10000)/100,
                'inStock'=> rand(0, 15),
                'rating'=>rand(5,50)/10,
                'numRating'=>rand(10, 200),
                'category'=>'electronics',
                'colors'=>[
                    '#000',
                    '#f00',
                    '#0f0',
                    '#00f',
                    '#fff'
                ],
                'deliveryIn'=>rand(1, 7),
                'img'=>"{$path}/images/multimeter01.jpg",
                'description'=>'Praesent sodales vulputate sem, eu porttitor odio aliquet eu. Integer ut sapien a enim commodo tempus et a mauris. Fusce metus erat, faucibus et lobortis a, molestie vitae erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque sit amet viverra purus. Nam vitae urna vel libero euismod auctor. Cras sit amet lacus tortor. Suspendisse potenti. Suspendisse potenti. Integer tincidunt accumsan mollis.',

            ],
            [
                'id'=>18,
                'name'=>'Notebook',
                'price'=>rand(100, 10000)/100,
                'inStock'=> rand(0, 15),
                'rating'=>rand(5,50)/10,
                'numRating'=>rand(10, 200),
                'category'=>'electronics',
                'colors'=>[
                    '#000',
                    '#f00',
                    '#0f0',
                    '#00f',
                    '#fff'
                ],
                'deliveryIn'=>rand(1, 7),
                'img'=>"{$path}/images/notebook01.jpg",
                'description'=>'Praesent sodales vulputate sem, eu porttitor odio aliquet eu. Integer ut sapien a enim commodo tempus et a mauris. Fusce metus erat, faucibus et lobortis a, molestie vitae erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque sit amet viverra purus. Nam vitae urna vel libero euismod auctor. Cras sit amet lacus tortor. Suspendisse potenti. Suspendisse potenti. Integer tincidunt accumsan mollis.',

            ],
            [
                'id'=>19,
                'name'=>'Record Player',
                'price'=>rand(100, 10000)/100,
                'inStock'=> rand(0, 15),
                'rating'=>rand(5,50)/10,
                'numRating'=>rand(10, 200),
                'category'=>'electronics',
                'colors'=>[
                    '#000',
                    '#f00',
                    '#0f0',
                    '#00f',
                    '#fff'
                ],
                'deliveryIn'=>rand(1, 7),
                'img'=>"{$path}/images/recordplayer01.jpg",
                'description'=>'Praesent sodales vulputate sem, eu porttitor odio aliquet eu. Integer ut sapien a enim commodo tempus et a mauris. Fusce metus erat, faucibus et lobortis a, molestie vitae erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque sit amet viverra purus. Nam vitae urna vel libero euismod auctor. Cras sit amet lacus tortor. Suspendisse potenti. Suspendisse potenti. Integer tincidunt accumsan mollis.',

            ],
            [
                'id'=>20,
                'name'=>'Retro TV',
                'price'=>rand(100, 10000)/100,
                'inStock'=> rand(0, 15),
                'rating'=>rand(5,50)/10,
                'numRating'=>rand(10, 200),
                'category'=>'electronics',
                'colors'=>[
                    '#000',
                    '#f00',
                    '#0f0',
                    '#00f',
                    '#fff'
                ],
                'deliveryIn'=>rand(1, 7),
                'img'=>"{$path}/images/retrotv01.jpg",
                'description'=>'Praesent sodales vulputate sem, eu porttitor odio aliquet eu. Integer ut sapien a enim commodo tempus et a mauris. Fusce metus erat, faucibus et lobortis a, molestie vitae erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque sit amet viverra purus. Nam vitae urna vel libero euismod auctor. Cras sit amet lacus tortor. Suspendisse potenti. Suspendisse potenti. Integer tincidunt accumsan mollis.',

            ],
            [
                'id'=>21,
                'name'=>'Speaker',
                'price'=>rand(100, 10000)/100,
                'inStock'=> rand(0, 9),
                'rating'=>rand(5,50)/10,
                'numRating'=>rand(10, 200),
                'category'=>'electronics',
                'colors'=>[
                    '#000',
                    '#f00',
                    '#0f0',
                    '#00f',
                    '#fff'
                ],
                'deliveryIn'=>rand(1, 7),
                'img'=>"{$path}/images/speaker01.jpg",
                'description'=>'Praesent sodales vulputate sem, eu porttitor odio aliquet eu. Integer ut sapien a enim commodo tempus et a mauris. Fusce metus erat, faucibus et lobortis a, molestie vitae erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque sit amet viverra purus. Nam vitae urna vel libero euismod auctor. Cras sit amet lacus tortor. Suspendisse potenti. Suspendisse potenti. Integer tincidunt accumsan mollis.',

            ],


        ];

        return new JsonResponse($products);

    }
}
