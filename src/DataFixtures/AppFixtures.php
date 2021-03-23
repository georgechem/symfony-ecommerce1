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
         * 0 - 2 camera | 3-4 cpu | 5 - flashback | 6 - headphones
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
        $productColors = ['#000','#f00','#0f0','#00f','#fff','#777'];

        $prefix = "/ecommerce/public";
        $product = new Product();



        $manager->flush();
    }
}
