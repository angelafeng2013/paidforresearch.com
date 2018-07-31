<?php
	
	// Database Constants
	define("DB_HOST", "engageiqdb.cqywnyprvqpq.us-west-1.rds.amazonaws.com");
	define("DB_DATABASE", "pfr_log");
	define("DB_USER", "pfr_logger");
	define("DB_PASSWORD", "p@1swmz67");

	function checkConnection()
	{
		$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
		// Check connection
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
	}

	function logExecutionTime($details)
	{
		$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

		$query = 'INSERT INTO load_speed(page_no,start_time,end_time,time_interval,full_url,email) VALUES("'.$details['page'].'", "'.$details['start_time'].'", "'.$details['end_time'].'", "'.$details['interval'].'","'.$details['url'].'","'.$details['email'].'")';

		mysqli_query($connection, $query);

		mysqli_close($connection);
	}
?>