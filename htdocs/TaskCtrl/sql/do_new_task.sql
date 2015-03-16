CREATE DEFINER=`ivan`@`%` PROCEDURE `do_new_task`(
	 in v_task_id int
	,in v_city_id int
	,in v_startdate datetime
	,in v_user_id int
	,in v_newstatus int
	,in v_description text
)
BEGIN
	/* всё в лог*/
	INSERT INTO task_status_log(task_id,startdate,status_id,user_id,statusdate,city_id,description)
	VALUES( v_task_id,v_startdate,v_newstatus,v_user_id,sysdate(),v_city_id,v_description);

	/* обновляем текущий статус */
	IF exists(SELECT 1 FROM task_status WHERE 
			task_id = v_task_id
		and user_id = v_user_id
		and city_id = v_city_id
		and startdate = v_startdate
	) 
	THEN
		UPDATE task_status SET 
			 statusdate = sysdate()
			,status_id = v_newstatus
			,description = v_description
		WHERE
			task_id = v_task_id and user_id = v_user_id and city_id = v_city_id and startdate = v_startdate;
	ELSE
		INSERT INTO task_status(task_id,startdate,status_id,user_id,statusdate,city_id,description)
		VALUES( v_task_id,v_startdate,v_newstatus,v_user_id,sysdate(),v_city_id,v_description);
	END IF;
END