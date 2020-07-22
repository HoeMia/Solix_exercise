<?php
namespace App;

require "vendor/autoload.php";

static $defaultFormat = "d-m-Y";
static $emptyPath = "";
static $emptyDate = "";

$val = getopt("d::f::p::");
$format = $val['f'] ?? $defaultFormat;
$date = $val['d'] ?? $emptyDate;
$path = $val['p'] ?? $emptyPath;

