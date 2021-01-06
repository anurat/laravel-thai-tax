<?php

namespace Connectiv\ThaiTax\Tests\Unit;

use Connectiv\ThaiTax\Facades\ThaiTax;
use Connectiv\ThaiTax\TaxCalculation;
use Connectiv\ThaiTax\Tests\TestCase;

class CreateFacadeTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function testCreateFacade()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->netIncome(600000);

        $this->assertInstanceOf(TaxCalculation::class, $thaiTax);
    }

    public function testExcelImport()
    {
        $this->markTestIncomplete('test excel import');
        // ThaiTax::import();
    }
}
