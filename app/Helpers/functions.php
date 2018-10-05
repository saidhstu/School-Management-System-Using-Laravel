<?php
function bn2en($number) {
    $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
    $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
    return str_replace($bn, $en, $number);
}

function en2bn($number) {
    $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
    $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
    return str_replace($en, $bn, $number);
}
function getMonth($month) {
    $months = array('Jan','Feb','March','April','May','Jun','July','Aug','Sep','Oct','Nov','Dec');
    return $months[$month];
}

function months() {
    $months = array('January','February','March','April','May','June','July','August','September','October','November','December');
    return $months;
}

function getMonth2($month) {
    $months = array('01' => 'January','02' => 'February','03' => 'March','04' => 'April','05' => 'May','06' => 'June','07' => 'July','08' => 'August','09' => 'September','10' => 'October','11' => 'November','12' => 'December');
    return $months[$month];
}

function is_leap_year($year) {
    return ((($year % 4) == 0) && ((($year % 100) != 0) || (($year %400) == 0)));
}

function getCurrentDay($date) {
    $now = time();
    $given_date = strtotime($date);
    $datediff = $now - $given_date;
    $current_date = floor($datediff / (60 * 60 * 24));
    return $current_date;
}

function getFutureDate($date) {
    $given_date = $date;
    $day_before = date( 'Y-m-d', strtotime( $given_date));
    return $day_before;
}

function getTotalDay($month,$year) {

    return cal_days_in_month(CAL_GREGORIAN, $month, $year);
}

function getDayNUmber($date1,$date2) {
    $datetime1 = date_create($date1);
    $datetime2 = date_create($date2);
    $interval = date_diff($datetime1, $datetime2);
    return $interval->days;
}

function formatedDate($date1,$date2) {
    $from = date("d",strtotime($date1))." ";
    $from .= getMonth(+date("m",strtotime($date1)) - 1)." ";
    $from .= date("y",strtotime($date1));
    $to = date("d",strtotime($date2))." ";
    $to .= getMonth(+date("m",strtotime($date2)) - 1)." ";
    $to .= date("y",strtotime($date2));
    return $from." To ".$to;
}

function formate_date($date) {
    $months = array("January","February","March","April","May","June","July","Auguest","September","October","November","December");

    $parts = explode("/", $date);
    $month = $parts[1]-1;
    $output = $parts[2]." ".$months[$month].", ".$parts[0];


    return $output;
}



function message($messages) {
    echo "<div class=\"alert alert-success\">";
    echo "<span class=\"glyphicon glyphicon-thumbs-up\"></span> $messages";
    echo "</div>";
}

function grade($mark,$mark_limit) {
    $mark = (($mark * 100) / $mark_limit);
    if(!empty($mark) && !empty($mark_limit)) {
        if($mark < 33) {
            return "F_0";
        } else if($mark >= 33 && $mark < 40) {
            return "D_1";
        } else if($mark >= 40 && $mark < 50) {
            return "C_2";
        } else if($mark >= 50 && $mark < 60) {
            return "B_3";
        } else if($mark >= 60 && $mark < 70) {
            return "A-_3.5";
        } else if($mark >= 70 && $mark < 80) {
            return "A_4";
        } else if($mark >= 80 && $mark <= 100) {
            return "A+_5";
        }
    } else {
        return false;
    }
}

function gpa($point) {
    if(!empty($point)) {
        if($point >= 5 ) {
            return "A+";
        } else if($point >= 4 && $point < 5) {
            return "A";
        } else if($point >= 3.50 && $point < 4) {
            return "A-";
        } else if($point >= 3 && $point < 3.50) {
            return "B";
        } else if($point >= 2 && $point < 3) {
            return "C";
        } else if($point >= 1 && $point < 2) {
            return "D";
        } else if($point < 1) {
            return "F";
        }
    } else {
        return false;
    }
}