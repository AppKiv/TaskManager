CREATE 
    ALGORITHM = UNDEFINED 
    DEFINER = `ivan`@`%` 
    SQL SECURITY DEFINER
VIEW `tsk_manager`.`task_available` AS
    SELECT 
        `t`.`task_id` AS `task_id`,
        `t`.`subject` AS `subject`,
        `t`.`description` AS `description`,
        `sh`.`startdate` AS `startdate`,
        `sh`.`finishdate` AS `finishdate`,
        `sh`.`cost` AS `cost`,
        `shc`.`city_id` AS `city_id`,
        `c`.`name` AS `cityname`,
        NULL AS `user_id`,
        NULL AS `status_id`,
        NULL AS `statusname`,
        COALESCE(`stc`.`taskcnt`, 0) AS `taskusers`,
        `sh`.`maxuser` AS `taskmaxuser`
    FROM
        ((((`tsk_manager`.`task` `t`
        JOIN `tsk_manager`.`task_schedule` `sh` ON ((`t`.`task_id` = `sh`.`task_id`)))
        LEFT JOIN `tsk_manager`.`task_schedule_city` `shc` ON (((`shc`.`task_id` = `t`.`task_id`)
            AND (`shc`.`startdate` = `sh`.`startdate`))))
        LEFT JOIN `tsk_manager`.`city` `c` ON ((`c`.`city_id` = `shc`.`city_id`)))
        LEFT JOIN `tsk_manager`.`task_usercnt` `stc` ON (((`stc`.`task_id` = `t`.`task_id`)
            AND (`stc`.`city_id` = COALESCE(`shc`.`city_id`, 0))
            AND (`stc`.`startdate` = `sh`.`startdate`))))
    WHERE
        (SYSDATE() BETWEEN `sh`.`startdate` AND `sh`.`finishdate`)