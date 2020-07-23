<?php declare(strict_types=1);

namespace App;

class CsvGenerator
{
    public static function generatePaydayCsvFromArrayAsString( $dataArray ): string
    {
        $fullString = CsvGenerator::createColumnNamesRow();
        foreach ( $dataArray as $row )
        {
            $fullString .= CsvGenerator::getRowStringFromPaydayRow( $row );
        }
        return $fullString;
    }

    public static function saveCsvAsFile( $csvString, $savePath, $fileName ): void
    {
        $fullSavePath = $savePath . $fileName;
        file_put_contents( $fullSavePath, $csvString);
    }
    
    private static function createColumnNamesRow(): string
    {
        return "month_name,raw_payday_date,bonus_payday_date\n";
    }

    private function  getRowStringFromPaydayRow( $row ): string
    {
        return $row['month_name'] . "," . $row['raw_payday'] . "," . $row['bonus_payday'] . "\n";
    }
}