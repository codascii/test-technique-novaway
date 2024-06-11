<?php
declare(strict_types=1);

namespace App\Helper;

final class VATCalculator
{
    public static function getPriceArray(float $price): array
    {
        return [
            'netPrice' => $price,
            'vat' => \round($price * 0.2, 2),
            'rawPrice' => \round($price * 0.8, 2)
        ];
    }
}
