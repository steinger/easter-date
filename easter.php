<?php
/**
 * Easter Date PHP Class 
 * Gregorian and/or Julian calendar 
 *
 * @author  Marcel Steinger <github@steinger.ch>
 */

class Easter
{
    public $year;
    
    public function __construct() 
    {
    /**
     * Class constructor
     */
        $year = date("Y");
    }
    
    public function GetGregorian($year) 
    { 
    /**
     * Calculation Easter sunday for Gregorian calendar.
     * According to physicist Carl Friedrich Gauss and additional Lichtenberg
     * 
     * @param   int         $year    Year
     * @return  string      Unixtime tzone
     */
        $J = date("Y", mktime(0, 0, 0, 1, 1, $year));
        $K = floor( $J/ 100 );
        $M = 15 + floor(( 3*$K+3 ) / 4 ) - floor(( 8*$K+13 ) / 25 );
        $S = 2 - floor(( 3*$K+3 ) / 4 );
        $A = $J%19;
        $D = ( 19 * $A + $M) % 30;
        $R = floor( $D / 29 ) + ( floor( $D / 28 ) - floor( $D / 29 )) * floor( $A / 11 );
        $OG = 21 + $D - $R; // March date of Easter full moon (= 14. days of the first month in the moon calendar, called Nisanu)
        $SZ = 7 - ( ($J + floor( $J / 4 ) + $S ) % 7 ); // Date first Sunday of March
        $OE = 7 - ( ($OG - $SZ) % 7 );
        $OS = $OG + $OE;
        $easter = mktime(0,0,0,3,$OS,$J);
        return $easter;
    }
    
    public function GetJulian($year) 
    { 
    /**
     * Calculation Easter sunday for Julian calendar after Orthodox.
     * According to physicist Carl Friedrich Gauss and additional Lichtenberg
     * 
     * @param   int         $year    Year
     * @return  string      Unixtime tzone
     */
        $J = date("Y", mktime(0, 0, 0, 1, 1, $year));
        $K = floor( $J/ 100 );
        $M = 15; // Julian
        $S = 0;  // Julian
        $A = $J%19;
        $D = ( 19 * $A + $M) % 30;
        $R = floor( $D / 29 ) + ( floor( $D / 28 ) - floor( $D / 29 )) * floor( $A / 11 );
        $OG = 21 + $D - $R; // March date of Easter full moon (= 14. days of the first month in the moon calendar, called Nisanu)
        $SZ = 7 - ( ($J + floor( $J / 4 ) + $S ) % 7 ); // Date first Sunday of March
        $OE = 7 - ( ($OG - $SZ) % 7 );
        $OS = $OG + $OE;
        $easter = mktime(0,0,0,3,$OS,$J);
        // Julian part converts to Julian date to Gregorian Calendar for Easter after Orthodox
        $gregoriantime = jdtogregorian(juliantojd(date("m", $easter),date("d", $easter),date("Y", $easter)));
        $month = date('m', strtotime($gregoriantime));
        $day = date('d', strtotime($gregoriantime)); 
        $year = date('Y', strtotime($gregoriantime)); 
        $easter = mktime (0, 0, 0, $month, $day, $year);
        return $easter;
    }
}
?>