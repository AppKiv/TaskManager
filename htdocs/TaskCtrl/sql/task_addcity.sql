CREATE DEFINER=`ivan`@`%` PROCEDURE `task_addcity`(
	 in v_task_id int
	,in v_startdate datetime
	,in v_city_id int
)
BEGIN

	/* обновляем текущий статус */
	IF not exists(SELECT 1 FROM task_schedule_city WHERE 
			task_id = v_task_id
		and startdate = v_startdate
		and city_id = v_city_id
	) 
	THEN
		INSERT INTO task_schedule_city(task_id,startdate,city_id)
		VALUES( v_task_id,v_startdate,v_city_id);
	END IF;
END