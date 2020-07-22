<?php declare(strict_types=1);

namespace App;

use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

final class PaydayCallendarTest extends TestCase
{
    protected static $callendar;
    protected static $format;

    public static function setUpBeforeClass(): void
    {
        self::$format = "d-m-Y";
        self::$callendar = new PaydayCallendar( self::$format, "22-07-2020" );
    }

    public function testFindRawPaydayDateInActualMonth(): void
    {
        $actual = self::$callendar->findRawPaydayDateInActualMonth();
        $expected = "31-07-2020";
        $this->assertEquals( $actual, $expected );
    }

    public function testFindBonusPaydayDateInActualMonth(): void
    {
        $actual = self::$callendar->findBonusPaydayDateInActualMonth();
        $expected = self::$callendar->getNoDayForGivenMonthMessage();
        $this->assertEquals( $actual, $expected );
    }

    public function testCanGetActualDate(): void
    {
        $actual = self::$callendar->getDateAsString();
        $expected = Carbon::now()->format( self::$format );
        $this->assertEquals( $actual, $expected );
    }

    public function testGoToNextMonth(): void
    {
        self::$callendar->goToNextMothFromActualDate();
        $actual = self::$callendar->getDateAsString();
        $expected = "01-08-2020";
        $this->assertEquals( $actual, $expected );
    }

    public function testGeneratePaydayDatesForEachMonthTillEndOfYear(): void
    {
        $actual = self::$callendar->generatePaydayDatesForEachMonthTillEndOfYear();
        echo $actual;
        $expected = '[{"month_name":"August","raw_payday":"31-08-2020","bonus_payday":"19-08-2020"},{"month_name":"September","raw_payday":"30-09-2020","bonus_payday":"15-09-2020"},{"month_name":"October","raw_payday":"30-10-2020","bonus_payday":"15-10-2020"},{"month_name":"November","raw_payday":"30-11-2020","bonus_payday":"18-11-2020"},{"month_name":"December","raw_payday":"31-12-2020","bonus_payday":"15-12-2020"}]';
        $this->assertEquals( $actual, $expected );
    }
}