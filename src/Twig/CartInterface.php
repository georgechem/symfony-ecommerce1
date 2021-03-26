<?php


namespace App\Twig;


interface CartInterface
{
    public function getProductList();

    public function getProductAmount();
}
