<?php

$format    = 'D d-m-y H:i'; // Will output dates like this in example
$basetime  = date('d-m-Y H:00'); // A (default) base time for consistancy in example
$schedule  = '1 3 2-8/6 * 2,3'; // A (default) scheduling definition
$schedule2 = '0 0 15 * *'; // A (2nd default) scheduling definition
$output    = '';

if(isset($_GET['schedule'])) {

    function echo_errors($errno, $message) {
        echo '<h1>Error:</h1><pre>'.$message.'</pre>';
    }

    error_reporting(E_ALL);
    set_error_handler('echo_errors');

    ob_start();
    require('csd_parser.php');
    $basetime  = $_GET['basetime'];
    $schedule  = $_GET['schedule'];
    $schedule2 = $_GET['schedule2'];

    // Create a new parser, basetime is optional by thw way, it will default to the current time
    try {
        $parser = new csd_parser($schedule, $basetime);
        echo '<div style="margin: 5px 0 0; color: gray;">$parser = new csd_parser($schedule, $basetime)</div>';

        // Output next time cron should run, 3 different ways ("next" is default)
        echo '<h3>Next runtime, 3 different ways</h3>';
        echo date($format, $parser->get()).' <span style="margin-left: 20px; color: gray">$parser->get()</span><br />';
        echo date($format, $parser->get('next')).' <span style="margin-left: 20px; color: gray">$parser->get(\'next\')</span><br />';
        echo date($format, $parser->get(0)).' <span style="margin-left: 20px; color: gray">$parser->get(0)</span><br />';

        // And the last time it was supposed to run, 3 different ways
        echo '<h3>Last runtime, 3 different ways</h3>';
        echo date($format, $parser->get('last')).' <span style="margin-left: 20px; color: gray">$parser->get(\'last\')</span><br />';
        echo date($format, $parser->get('prev')).' <span style="margin-left: 20px; color: gray">$parser->get(\'prev\')</span><br />';
        echo date($format, $parser->get(-1)).' <span style="margin-left: 20px; color: gray">$parser->get(-1)</span><br />';

        // The next 3 times it's supposed to run
        echo '<h3>The next 3 runtimes</h3>';
        for($i = 0; $i < 3; $i++) {
            echo date($format, $parser->get($i)).' <span style="margin-left: 20px; color: gray">$parser->get('.$i.')</span><br />';
        }

        // Try a different schedule
        echo '<h3>The next 3 runtimes, with 2<sup>nd</sup> schedule</h3>';
        $parser = new csd_parser($schedule2, $basetime);
        for($i = 0; $i < 3; $i++) {
            echo date($format, $parser->get($i)).' <span style="margin-left: 20px; color: gray">$parser->get('.$i.')</span><br />';
        }

        try {

            // And now with both combined
            //   Note that you can also use text, separating schedules with newlines (allows for input trough e.g. a textarea)
            echo '<h3 style="margin-bottom: 0px">Combine the above two schedules and calc next 3 runtimes</h3>';
            echo '<div style="margin: 5px 0 12px; color: gray;">$parser = new csd_parser(array($schedule, $schedule2), $basetime)</div>';
            $parser = new csd_parser(array($schedule, $schedule2), $basetime);
            for($i = 0; $i < 3; $i++) {
                echo date($format, $parser->get($i)).' <span style="margin-left: 20px; color: gray">$parser->get('.$i.')</span><br />';
            }

            // All runtimes of the next past months
            //   Note the use of (string) to indicate this is NOT an offset
            echo '<h3 style="margin-bottom: 0px">All the runtimes of the past 3 months</h3>';
            echo '<div style="margin: 5px 0 12px; color: gray;">$parser->get( (string) strtotime(\'-3 month\', strtotime($basetime)) )</div>';
            $untill = strtotime('-3 month', strtotime($basetime));
            $times  = $parser->get((string)$untill);
            foreach($times as $time) {
                echo date($format, $time).'<br />';
            }

            // Quickly fetch with static function csd_parser::calc
            //   Note that each call to the static function parses AND calculates everything anew
            //   it will thus be slower if you want to calculate subsequent times
            echo '<h3 style="margin-bottom: 0px">Calc next runtime using the static function</h3>';
            echo '<div style="margin: 5px 0 12px; color: gray;">csd_parser::calc($schedule, 0, $basetime)</div>';
            $time = csd_parser::calc($schedule, 0, $basetime);
            echo date($format, $time);
        } catch(Exception $e) {
            echo '<h1>Exception:</h1><pre>'.$e->getMessage().'</pre>';
        }
    } catch(Exception $e) {
        echo '<h1>Exception:</h1><pre>'.$e->getMessage().'</pre>';
    }

    $output = '<hr>'.ob_get_clean();
}

echo <<<EOF
<html>
<body style="font-family: monospace;">
<h3>Generate examples with</h3>
<form>
  <span style="display: inline-block; width: 100px">Schedule:</span><input type="text" value="$schedule" name="schedule" style="width: 200px;	font-family: monospace" /> [<a href="http://en.wikipedia.org/wiki/Cron#CRON_expression" target=_blank">Help</a>]<br />
  <span style="display: inline-block; width: 100px">2<sup>nd</sup> Schedule:</span><input type="text" value="$schedule2" name="schedule2" style="width: 200px;	font-family: monospace" ><br />
  <span style="display: inline-block; width: 100px">Time:</span><input type="text" value="$basetime" name="basetime" style="width: 200px;	font-family: monospace" >
  <input type="submit" value="Generate" />
  <a href="examples.php"><button type="button">Reset</button></a>
</form>
$output
</body>
</html>
EOF;
