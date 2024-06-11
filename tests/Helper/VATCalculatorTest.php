<?php

namespace App\Tests\Helper;

use App\Helper\VATCalculator;
use PHPUnit\Framework\TestCase;

final class VATCalculatorTest extends TestCase
{

    public function testGetPriceArray()
    {
        // Raw : 80 €
        // VAT = 80 * 20 % = 16 €
        // Net = 96 €
        $this->assertEquals(
            VATCalculator::getPriceArray(96),
            ['netPrice' => 96, 'vat' => 19.2, 'rawPrice' => 76.8]
        );

        // Raw : 3141.59 €
        // VAT = 3141.59 * 20 % = 628.32 €
        // Net = 3769.91 €
        $this->assertEquals(
            VATCalculator::getPriceArray(3769.91),
            ['netPrice' => 3769.91, 'vat' => 753.98, 'rawPrice' => 3015.93]
        );

        // Raw : 16 €
        // VAT = 16 * 20 % = 3.20 €
        // Net = 19.20 €
        $this->assertEquals(
            VATCalculator::getPriceArray(19.20),
            ['netPrice' => 19.20, 'vat' => 3.84, 'rawPrice' => 15.36]
        );

        // Raw : 10287.5 €
        // VAT = 10287.5 * 20 % = 2057.50 €
        // Net = 12345 €
        $this->assertEquals(
            VATCalculator::getPriceArray(12345),
            ['netPrice' => 12345, 'vat' => 2469, 'rawPrice' => 9876]
        );
    }
}
