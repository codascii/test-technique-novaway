<?php
declare(strict_types=1);

namespace App\Helper;

use App\Interface\PriceInterface;

final class CartHelper
{
    public static function getTotalPrice($cart): float
    {
        return \array_sum(\array_map(function ($item) {
            /** @var PriceInterface $cartItem */
            $cartItem = $item['item'];

            return $cartItem->getPrice() * $item['qty'];
        }, $cart));
    }
}
