<?php

namespace App\Tests\Helper;

use App\Helper\VATCalculator;
use PHPUnit\Framework\TestCase;

class VATCalculatorTest extends TestCase
{

    public function testGetPriceArray()
    {
        // Raw : 80 €
        // VAT = 80 * 20 % = 16 €
        // Net = 96 €
        $this->assertEquals(
            VATCalculator::getPriceArray(96),
            ['netPrice' => 96, 'vat' => 16, 'rawPrice' => 80,],
            '',
            0.01
        );

        // Raw : 3141.59 €
        // VAT = 3141.59 * 20 % = 628.32 €
        // Net = 3769.91 €
        $this->assertEquals(
            VATCalculator::getPriceArray(3769.91),
            ['netPrice' => 3769.91, 'vat' => 628.32, 'rawPrice' => 3141.59,],
            '',
            0.01
        );

        // Raw : 16 €
        // VAT = 16 * 20 % = 3.20 €
        // Net = 19.20 €
        $this->assertEquals(
            VATCalculator::getPriceArray(19.20),
            ['netPrice' => 19.20, 'vat' => 3.2, 'rawPrice' => 16,],
            '',
            0.01
        );

        // Raw : 10287.5 €
        // VAT = 10287.5 * 20 % = 2057.50 €
        // Net = 12345 €
        $this->assertEquals(
            VATCalculator::getPriceArray(12345),
            ['netPrice' => 12345, 'vat' => 2057.50, 'rawPrice' => 10287.5,],
            '',
            0.01
        );
    }
}
