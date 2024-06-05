<?php
declare(strict_types=1);

namespace App\Helper;

final class VATCalculator
{
    public static function getPriceArray(float $price): array
    {
        return [
            'netPrice' => $price,
            'vat' => $price * 0.2,
            'rawPrice' => $price * 0.8,
        ];
    }
}
