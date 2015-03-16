CREATE 
    ALGORITHM = UNDEFINED 
    DEFINER = `ivan`@`%` 
    SQL SECURITY DEFINER
VIEW `tsk_manager`.`task_active` AS
    SELECT 
        `ta`.`task_id` AS `task_id`,
        `ta`.`startdate` AS `startdate`,
        `sh`.`finishdate` AS `finishdate`,
        `sh`.`cost` AS `cost`,
        `ta`.`status_id` AS `status_id`,
        `ta`.`user_id` AS `user_id`,
        `ta`.`description` AS `description`,
        `ta`.`statusdate` AS `statusdate`,
        `ta`.`city_id` AS `city_id`,
        `c`.`name` AS `cityname`,
        `t`.`subject` AS `tasksubject`,
        `t`.`description` AS `taskdescription`,
        `s`.`name` AS `statusname`
    FROM
        ((((`tsk_manager`.`task_status` `ta`
        JOIN `tsk_manager`.`task` `t` ON ((`t`.`task_id` = `ta`.`task_id`)))
        JOIN `tsk_manager`.`task_schedule` `sh` ON (((`ta`.`task_id` = `sh`.`task_id`)
            AND (`sh`.`startdate` = `ta`.`startdate`))))
        LEFT JOIN `tsk_manager`.`city` `c` ON ((`c`.`city_id` = `ta`.`city_id`)))
        JOIN `tsk_manager`.`status` `s` ON ((`s`.`status_id` = `ta`.`status_id`)))