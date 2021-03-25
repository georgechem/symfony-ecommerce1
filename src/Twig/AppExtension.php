<?php


namespace App\Twig;


use App\Entity\Cart;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('total', [$this,'getTotal'])
        ];
    }

    public function getTotal(Cart $cart)
    {
        $ids = array_keys($cart->getProductAmount());
        $sum = 0.0;
        foreach($cart->getProductList() as $product){
            if(in_array($product->getId(), $ids)){
                $sum += $product->getPrice() * $cart->getProductAmount()[$product->getId()];
            }
        }

        return $sum;
    }

}
