<?php
namespace App;

require "vendor/autoload.php";

static $defaultFormat = "d-m-Y";
static $emptyPath = "";
static $emptyDate = "";
static $emptyName = "";

$val = getopt("d::f::p::n::");
$format = $val['f'] ?? $defaultFormat;
$date = $val['d'] ?? $emptyDate;
$path = $val['p'] ?? $emptyPath;
$name = $val['n'] ?? $emptyName;

$paydayCallendar = new PaydayCallendar( $format, $date );
$callendarDate = $paydayCallendar->getDateAsString();
$paydayDataArray = $paydayCallendar->generatePaydayDatesForEachMonthTillEndOfYear();
$csvString = CsvGenerator::generatePaydayCsvFromArrayAsString( $paydayDataArray );


$fileName = ( $name != $emptyName ? $name : ("paydayDates_" . time() . "_" . $callendarDate)) . ".txt";
CsvGenerator::saveCsvAsFile( $csvString, $path, $fileName );