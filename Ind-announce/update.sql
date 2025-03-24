ALTER TABLE `events` CHANGE `department` `priority` INT(11) NOT NULL;
ALTER TABLE `events` ADD `department` INT NOT NULL AFTER `title`;