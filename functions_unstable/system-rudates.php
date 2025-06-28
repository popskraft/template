<?php namespace ProcessWire;

/**
 * DATE INCLUDES
 * ========================================
 */
function dateNorm(
  $dateSrc,
  $emSp =  "",
  $class = "",
  $noYear = "",
  $DClass = "",
  $Mclass = "",
  $Yclass = "",
  $tag = "span"
) {
  $output = "";

  $emSp = $emSp ? $emSp : "&emsp;";
  $class = $class ? $class : "";
  $DClass = $DClass ? $DClass : "fw-bold";
  $Mclass = $Mclass ? $Mclass : "fw-bold";
  $dateDay    = date("j", $dateSrc);
  $dateMonth  = rdate("F", $dateSrc, 1);
  $dateYear   = ($noYear == null) ? date("Y", $dateSrc) : "" ;

  if (isset($dateSrc)) {
    $output = "
      <$tag class='date $class'>
        <span class='day $DClass'>$dateDay</span> <span class='month $Mclass'>$dateMonth</span> <span class='$Yclass'>$dateYear</span>$emSp
      </$tag>
    ";
  }

  return $output;
}

/**
* RUSSIAN DATES 
* ========================================
* RUDATE http://in-coding.blogspot.ru/2012/02/php-date.html
* Example: echo rdate("j F", $event->event_date_open, 1);
*/
function rdate($format, $timestamp = null, $case = 0)
{
 if ( $timestamp === null )
  $timestamp = time();

 static $loc =
  'январ,ь,я,е,ю,ём,е
  феврал,ь,я,е,ю,ём,е
  март, ,а,е,у,ом,е
  апрел,ь,я,е,ю,ем,е
  ма,й,я,е,ю,ем,е
  июн,ь,я,е,ю,ем,е
  июл,ь,я,е,ю,ем,е
  август, ,а,е,у,ом,е
  сентябр,ь,я,е,ю,ём,е
  октябр,ь,я,е,ю,ём,е
  ноябр,ь,я,е,ю,ём,е
  декабр,ь,я,е,ю,ём,е';

 if ( is_string($loc) )
 {
  $months = array_map('trim', explode("\n", $loc));
  $loc = array();
  foreach($months as $monthLocale)
  {
   $cases = explode(',', $monthLocale);
   $base = array_shift($cases);
   $cases = array_map('trim', $cases);
   $loc[] = array(
    'base' => $base,
    'cases' => $cases,
   );
  }
 }
 $m = (int)date('n', $timestamp)-1;
 $F = $loc[$m]['base'].$loc[$m]['cases'][$case];
 $format = strtr($format, array(
  'F' => $F,
  'M' => substr($F, 0, 3),
 ));
 return date($format, $timestamp);
}