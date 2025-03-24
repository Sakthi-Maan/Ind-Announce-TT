Class for easy calculation of UNIX timestamps from cron scheduling definitions

Created:   May 27th 2013
Author:    Volwerk, C
Contact:   vollie [at] vollie [dot] net
License:   LGPLv3



About
================================================================================
This class can calculate a (range of) unix timestamp(s) of either future or past
occurences relative to a given time considering a single or a combination of
multiple scheduling definitions.

I made this class after finding most classes capable of parsing cron scheduling
definitions either bloated or lacking in functionality. This was written to be
completely independent of other classes, non-standard functionalities and frame-
works, be bug-free, calculate reasonably fast and have little overhead.



Features
================================================================================
- Full support of 'traditional' crontab format including ranges, increments and
  multiple list items, allowing for advanced statements, e.g.:
  5-10 12 1-10/2,*/5 * 2,3 2013
- Support for combining multiple statements using an or like approach.
  e.g.: "0 10 * * *" combined with "0 0 5 * *" would run every day at 10 and
  once a month at 0:00 on the 5th.
- Get both future and paste times by offset (e.g. 5 crons from now).
- Get a range of times (e.g. from now untill one month from now).
- Support for named entries (e.g. "monday" or "mon" instead of 1, or "june" or
  "jun" instead of 6).
- Identifies error in definitions and trows 'regular' (supressable) errors for
  them identifying the list item and line in the error.
- Overlaps, duplicates or out of range entries are corrected.
- Calculate relative to an optionally provided (custom) time



Usage
================================================================================
You can use either a static approach or create a new parser. E.g the below two
options both fetch $which runtime(s) of $cron_string relative to $start_point.

csd_parser::calc($cron_string, $which, $start_point);
$parser = new csd_parser($cron_string, $start_point);
$parser->get($which);

For more (advanced) examples (and explanation of what they'll do) glance over
the example.php file. It can be easily adjusted to run some tests as well.

It is worth noting that the static approach always reparses and recalculates. So
if you want multiple times, creating a new object will be (slightly) faster.



Who can use this class?
================================================================================
Anyone who wants to use cron-like scheduling for anything other than 'pure' cron
jobs, or who wants to avoid the relative hassle of creating (seperate) crons for
every scheduled task.

e.g.: Our own system simply runs one cron every minute which in turn picks and
reschedules jobs that can easily be scheduled, configured and even written
using forms in the administrative area.



changes
================================================================================
Sep 1st 2014
    - Fixed issue that may occur when calculating into the future stemming from
      compensation for leap years
    - Slightly increased performance
Jul 31st 2017
    - Fixed issue relating to weekday numbers which led to skipping an entire
      week instead of resuming on the earliest next weekday