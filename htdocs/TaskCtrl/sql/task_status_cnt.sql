CREATE 
    ALGORITHM = UNDEFINED 
    DEFINER = `ivan`@`%` 
    SQL SECURITY DEFINER
VIEW `tsk_manager`.`task_status_cnt` AS
    SELECT 
        `tsk_manager`.`task_status`.`user_id` AS `user_id`,
        SUM((CASE
            WHEN (`tsk_manager`.`task_status`.`status_id` = 1) THEN 1
            ELSE 0
        END)) AS `TaskStart`,
        SUM((CASE
            WHEN (`tsk_manager`.`task_status`.`status_id` = 10) THEN 1
            ELSE 0
        END)) AS `TaskFinish`,
        SUM((CASE
            WHEN (`tsk_manager`.`task_status`.`status_id` = 5) THEN 1
            ELSE 0
        END)) AS `TaskSend`,
        SUM((CASE
            WHEN (`tsk_manager`.`task_status`.`status_id` = 6) THEN 1
            ELSE 0
        END)) AS `TaskReturn`,
        SUM((CASE
            WHEN (`tsk_manager`.`task_status`.`status_id` = 0) THEN 1
            ELSE 0
        END)) AS `TaskFail`
    FROM
        `tsk_manager`.`task_status`
    GROUP BY `tsk_manager`.`task_status`.`user_id`