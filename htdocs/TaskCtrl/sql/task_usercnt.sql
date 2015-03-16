CREATE 
    ALGORITHM = UNDEFINED 
    DEFINER = `ivan`@`%` 
    SQL SECURITY DEFINER
VIEW `tsk_manager`.`task_usercnt` AS
    SELECT 
        COUNT(`tsk_manager`.`task_status`.`task_id`) AS `taskcnt`,
        `tsk_manager`.`task_status`.`task_id` AS `task_id`,
        `tsk_manager`.`task_status`.`city_id` AS `city_id`,
        `tsk_manager`.`task_status`.`startdate` AS `startdate`
    FROM
        `tsk_manager`.`task_status`
    WHERE
        (`tsk_manager`.`task_status`.`status_id` >= 1)
    GROUP BY `tsk_manager`.`task_status`.`task_id` , `tsk_manager`.`task_status`.`startdate` , `tsk_manager`.`task_status`.`city_id`