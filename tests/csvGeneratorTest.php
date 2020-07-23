<?php declare(strict_types=1);

namespace App;

use PHPUnit\Framework\TestCase;

final class PaydayCsvGeneratorTest extends TestCase
{
    public function testGeneratePaydayCsvFromArrayAsString(): void
    {
        $actual = CsvGenerator::generatePaydayCsvFromArrayAsString([["month_name" => "mock", "raw_payday" => "a", "bonus_payday" => "c"]]);
        $expected = "month_name,raw_payday_date,bonus_payday_date\nmock,a,c\n";
        $this->assertEquals( $actual, $expected );
    }
}