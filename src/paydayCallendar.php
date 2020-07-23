<?php declare(strict_types=1);

namespace App;

use Carbon\Carbon;

class PaydayCallendar
{
    private $date;
    private $dateFormat;
    private $noDayForThisMonthMessage;

    public function __construct( $date_format = "d-m-Y", $formatted_date = "") 
    {
        $this->noDayForThisMonthMessage = "NONE";
        $this->dateFormat = $date_format;
        $formatted_date == "" ?
            $this->date = Carbon::now()
                :
            $this->date = Carbon::createFromFormat( $this->dateFormat, $formatted_date );
    }

    public function getDateAsString() : string 
    {
        return $this->date->format( $this->dateFormat );
    }

    public function generatePaydayDatesForEachMonthTillEndOfYear()
    {
        $staticDate = clone $this->date;
        $responseArray = [];
        while( $staticDate->isSameYear( $this->date ) )
        {
            array_push( $responseArray, $this->getPaydaysForActualMonth() );
            $this->goToNextMothFromActualDate(); 
        }
        return $responseArray;
    }

    public function getPaydaysForActualMonth()
    {
        $bonusPayday = $this->findBonusPaydayDateInActualMonth();
        $rawPayday = $this->findRawPaydayDateInActualMonth();
        $monthName = $this->date->monthName;
        return ['month_name' => $monthName, 'raw_payday' => $rawPayday, 'bonus_payday' => $bonusPayday ];
    }

    public function findRawPaydayDateInActualMonth() : string
    {
        $endOfMonthDate = $this->getLastWorkingDayDateOfTheGivenDate( clone $this->date );

        if( $this->isActualDateGreaterThanGivenDate( $endOfMonthDate ) ) 
        {
            return $this->noDayForThisMonthMessage;
        }

        $endOfMonth = $endOfMonthDate->format( $this->dateFormat );
        return $endOfMonth;
    }

    public function findBonusPaydayDateInActualMonth() : string
    {
        $bonusPaydayOfMonthDate = $this->getFifteenthDayOfMonth( clone $this->date );

        if( $bonusPaydayOfMonthDate->isWeekend() ) 
        {
            $bonusPaydayOfMonthDate = $this->findNextWednesdayForGivenDate( clone $bonusPaydayOfMonthDate );
        }

        if( $this->isActualDateGreaterThanGivenDate( $bonusPaydayOfMonthDate ) ) 
        {
            return $this->noDayForThisMonthMessage;
        }

        $bonusPaydayOfMonth = $bonusPaydayOfMonthDate->format( $this->dateFormat );
        return $bonusPaydayOfMonth;
    }

    private function isActualDateGreaterThanGivenDate( $date ): bool
    {
        return $this->date->greaterThan( $date );
    }

    private function getLastWorkingDayDateOfTheGivenDate( $date )
    {
        $endOfMonth = $date->endOfMonth()->format( $this->dateFormat ); 
        $endOfMonthDate = Carbon::createFromFormat( $this->dateFormat, $endOfMonth );
        while( $endOfMonthDate->isWeekend() )
        {
            $endOfMonthDate->subDay();
        }
        return $endOfMonthDate;
    }

    public function goToNextMothFromActualDate(): void
    {
        $this->date->startOfMonth();
        $this->date->addMonth();
    }

    public function getNoDayForGivenMonthMessage(): string
    {
        return $this->noDayForThisMonthMessage;
    }

    private function getFifteenthDayOfMonth( $date )
    {
        $fifteenthOfMonth = $date->day(15);
        return $fifteenthOfMonth;
    }

    private function findNextWednesdayForGivenDate( $date )
    {
        $date->next('Wednesday');
        return $date;
    }
}