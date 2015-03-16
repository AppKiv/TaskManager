CREATE DEFINER=`ivan`@`%` PROCEDURE `task_delcity`(
	 in v_task_id int
	,in v_startdate datetime
	,in v_city_id int
)
BEGIN
	DELETE FROM task_schedule_city WHERE 
			task_id = v_task_id
		and startdate = v_startdate
		and city_id = v_city_id;
END