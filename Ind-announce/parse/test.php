<?
ob_start();
$format    = 'Y-m-d H:i:s';
    require('csd_parser.php');
   $basetime  = date('Y-m-10 H:i:s');
    $schedule  = '0 15 * * *';
    
    // Create a new parser, basetime is optional by thw way, it will default to the current time
        $parser = new csd_parser($schedule, $basetime);
        
        // Output next time cron should run, 3 different ways ("next" is default)
        echo date($format, $parser->get('next')).'sssss';
	
	
        
?>