<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        /**
         * PRODUCTS 0 - 15
         * 0 - cam | 1 - cpu | 2 - flashlight | 3 - headphones
         * 4 - ipad | 5 - jackplug | 6 - keyboard | 7 - memory
         * 8 - mic | 9 - mouse | 10 - mp3 player | 11 - multimeter
         * 12 - notebook, 13 - record player | 14 - retro tv, 15 - speaker
         */
        $productNames = ['camera','processor','flashlight','Headphones',
            'Ipad','Jackplug','Keyboard','Memory','Microphone','Mouse',
            'MP3 Player', 'Multimeter','Notebook', 'Record Player',
            'Retro TV', 'Speaker'];
        /**
         * IMAGES 0 - 20
         * 0 - 2 camera | 3-4 cpu | 5 - flashlight | 6 - headphones
         * 7 - ipad, 8 - jackplug | 9 - keyboard | 10 - 11 - memory
         * 12 - mic | 13 - 14 -mouse | 15 - mp3 player | 16 - multimeter
         * 17 - notebook | 18 - record player | 19 - tv | 20 - speaker
         */
        $productImages = ['/images/cam0a1.jpg','/images/camera01.jpg',
            '/images/camera02a.jpg','/images/cpu01.jpg','/images/cpu02.jpg',
            '/images/flashlight01.jpg','/images/headphones01.jpg',
            '/images/ipad01.jpg','/images/jackplug01.jpg','/images/keyboard01.jpg',
            'images/memory01.jpg','/images/memory02.jpg','/images/mic01b.jpg',
            '/images/mouse01.jpg','/images/mouse02.jpg','/images/mp3player01.jpg',
            '/images/multimeter01.jpg','/images/notebook01.jpg','/images/recordplayer01.jpg',
            '/images/retrotv01.jpg','/images/speaker01.jpg'];
        /**
         * COLORS
         * 0 - black | 1 - red | 2- green | 3-blue | 4 - white | 5 - grey
         */
        $productColors = ['#000','#f00','#0f0','#00f','#fff','#777'];
        $product_categories = ['electronics','memory','cpu','audio'];

        $prefix = "/ecommerce1/public";

        for($i=0; $i < 20; $i++){
            $product = new Product();
            $rNo = rand(0, 15);
            $product->setName($productNames[$rNo]);
            $product->setPrice(rand(100, 10000)/100);
            $product->setInStock(rand(0,20));
            $product->setRating(rand(5,50)/10);
            $product->setNumRating(rand(5,50));
            $product->setDeliveryIn(rand(1,7));
            $color1 = $productColors[rand(0,5)];
            do {
                $color2 = $productColors[rand(0,5)];
            }while($color2 === $color1);

            $product->setColors([
               $color1, $color2
            ]);
            $product->setPrefix($prefix);

            $product->setDescription('Praesent sodales vulputate sem, eu porttitor odio aliquet eu. Integer ut sapien a enim commodo tempus et a mauris. Fusce metus erat, faucibus et lobortis a, molestie vitae erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque sit amet viverra purus. Nam vitae urna vel libero euismod auctor. Cras sit amet lacus tortor. Suspendisse potenti. Suspendisse potenti. Integer tincidunt accumsan mollis.');
            $catNo = ($rNo >= 10 && $rNo <=11) ? 1
                : ($rNo >= 3 && $rNo <=4) ? 2
                    : ($rNo === 6 || $rNo === 12 || $rNo === 20) ? 3 : 0;
            $product->setCategory($product_categories[$catNo]);
            $imgNo = ($rNo === 0) ? rand(0,2)
                : ($rNo === 1) ? rand(3,4)
                    : ($rNo === 2) ? 5 : ($rNo === 3) ? 6
                        : ($rNo === 4) ? 7 : ($rNo === 5) ? 8
                            : ($rNo === 6) ? 9 : ($rNo === 7) ? rand(10,11)
                                : ($rNo === 8) ? 12 : ($rNo === 9) ? rand(13,14)
                                    : ($rNo === 10) ? 15 : ($rNo === 11) ? 16
                                        : ($rNo === 12) ? 17 : ($rNo === 13) ? 18
                                            : ($rNo === 14) ? 19 : ($rNo === 15) ? 20 : 0;
            $product->setImg($productImages[$imgNo]);

            $manager->persist($product);
        }

        $manager->flush();
    }
}
