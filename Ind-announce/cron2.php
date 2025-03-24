<?php

class myMiniDate {
    var $myTimestamp;
    static private $dateComponent = array(
                                    'second' => 's',
                                    'minute' => 'i',
                                    'hour' => 'G',
                                    'day' => 'j',
                                    'month' => 'n',
                                    'year' => 'Y',
                                    'dow' => 'w',
                                    'timestamp' => 'U'
                                  );
    static private $weekday = array(
                                1 => 'monday',
                                2 => 'tuesday',
                                3 => 'wednesday',
                                4 => 'thursday',
                                5 => 'friday',
                                6 => 'saturday',
                                0 => 'sunday'
                              );

    function __construct($ts = NULL) { $this->myTimestamp = is_null($ts)?time():$ts; }

    function __set($var, $value) {
        list($c['second'], $c['minute'], $c['hour'], $c['day'], $c['month'], $c['year'], $c['dow']) = explode(' ', date('s i G j n Y w', $this->myTimestamp));
        switch ($var) {
            case 'dow':
                $this->myTimestamp = strtotime(self::$weekday[$value], $this->myTimestamp);
                break;

            case 'timestamp':
                $this->myTimestamp = $value;
                break;

            default:
                $c[$var] = $value;
                $this->myTimestamp = mktime($c['hour'], $c['minute'], $c['second'], $c['month'], $c['day'], $c['year']);
        }
    }


    function __get($var) {
        return date(self::$dateComponent[$var], $this->myTimestamp);
    }

    function modify($how) { return $this->myTimestamp = strtotime($how, $this->myTimestamp); }
}


$cron = new myMiniDate(time() + 60);
$cron->second = 0;
$done = 0;

echo date('Y-m-d H:i:s') . '<hr>' . date('Y-m-d H:i:s', $cron->timestamp) . '<hr>';

$Job = array(
            'Minute' => 5,
            'Hour' => 3,
            'Day' => 13,
            'Month' => null,
            'DOW' => 5,
       );

while ($done < 100) {
    if (!is_null($Job['Minute']) && ($cron->minute != $Job['Minute'])) {
        if ($cron->minute > $Job['Minute']) {
            $cron->modify('+1 hour');
        }
        $cron->minute = $Job['Minute'];
    }
    if (!is_null($Job['Hour']) && ($cron->hour != $Job['Hour'])) {
        if ($cron->hour > $Job['Hour']) {
            $cron->modify('+1 day');
        }
        $cron->hour = $Job['Hour'];
        $cron->minute = 0;
    }
    if (!is_null($Job['DOW']) && ($cron->dow != $Job['DOW'])) {
        $cron->dow = $Job['DOW'];
        $cron->hour = 0;
        $cron->minute = 0;
    }
    if (!is_null($Job['Day']) && ($cron->day != $Job['Day'])) {
        if ($cron->day > $Job['Day']) {
            $cron->modify('+1 month');
        }
        $cron->day = $Job['Day'];
        $cron->hour = 0;
        $cron->minute = 0;
    }
    if (!is_null($Job['Month']) && ($cron->month != $Job['Month'])) {
        if ($cron->month > $Job['Month']) {
            $cron->modify('+1 year');
        }
        $cron->month = $Job['Month'];
        $cron->day = 1;
        $cron->hour = 0;
        $cron->minute = 0;
    }

    $done = (is_null($Job['Minute']) || $Job['Minute'] == $cron->minute) &&
            (is_null($Job['Hour']) || $Job['Hour'] == $cron->hour) &&
            (is_null($Job['Day']) || $Job['Day'] == $cron->day) &&
            (is_null($Job['Month']) || $Job['Month'] == $cron->month) &&
            (is_null($Job['DOW']) || $Job['DOW'] == $cron->dow)?100:($done+1);
}

echo date('Y-m-d H:i:s', $cron->timestamp) . '<hr>';
?>