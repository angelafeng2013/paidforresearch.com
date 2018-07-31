<?php
	if(session_id() == '') {
	    session_start();
	}

	// Database Constants
	define("DB_HOST", "engageiqdb.cqywnyprvqpq.us-west-1.rds.amazonaws.com");
	define("DB_DATABASE", "anuradb");
	define("DB_USER", "anurauser");
	define("DB_PASSWORD", "8@mkpx*2");

	function checkConnection()
	{
		$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
		// Check connection
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
	}

	function logUser($d)
	{
		$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

		$query = "INSERT INTO user_info VALUES('', $d[affiliate_id], $d[revenue_tracker_id], '$d[first_name]', '$d[last_name]', '$d[email]', '$d[birthdate]', '$d[gender]', '$d[zip]', '$d[city]', '$d[state]', '$d[address]', '$d[phone]', '$d[source_url]', '$d[ip]','$d[is_mobile]','$d[browseragent]', '$d[localdatetime]', '$d[anurastatus]', '$d[anura_id]', '$d[created_at]')";

		// $_SESSION['log_user_sql'] = $query;

		mysqli_query($connection, $query);

		mysqli_close($connection);
	}

	function logUserNoStatus($id, $status)
	{
		$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

		$query = "INSERT INTO status_checker VALUES('$id', '$status')";

		mysqli_query($connection, $query);

		mysqli_close($connection);
	}

	function selectUsers($inputs) {

		//datatable columns
		$columns = array(
			'anura_id',
			'affiliate_id',
			'revenue_tracker_id',
			'first_name',
			'last_name',
			'email',
			'zip',
			'ip',
			'source_url',
			'anurastatus',
			'created_at'
		);

		$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

		//get total count
		// $query = 'SELECT COUNT(*) FROM user_info';
		// $result = mysqli_query($connection, $query);
		// $row = mysqli_fetch_row($result);
		// $returns['total_count'] = $row[0];

		$query = 'SELECT * FROM user_info ';

		$where_statements = array();

		if(isset($inputs['affiliate_id']) && $inputs['affiliate_id'] != '') {
			$where_statements[] = "affiliate_id = $inputs[affiliate_id]";
		}

		if(isset($inputs['revenue_tracker_id']) && $inputs['revenue_tracker_id'] != '') {
			$where_statements[] =  "revenue_tracker_id = $inputs[revenue_tracker_id]";
		}

		if(isset($inputs['anura_id']) && $inputs['anura_id'] != '') {
			$where_statements[] = "anura_id = '$inputs[anura_id]'";
		}

		if(isset($inputs['email']) && $inputs['email'] != '') {
			$where_statements[] = "email = '$inputs[email]'";
		}

		if(isset($inputs['status']) && $inputs['status'] != '') {
			$where_statements[] = "anurastatus = $inputs[status]";
		}

		if(isset($inputs['gender']) && $inputs['gender'] != '') {
			$where_statements[] = "gender = '$inputs[gender]'";
		}

		if(isset($inputs['zip']) && $inputs['zip'] != '') {
			$where_statements[] = "email = '$inputs[email]'";
		}

		if(isset($inputs['source_url']) && $inputs['source_url'] != '') {
			$where_statements[] = "source_url = '$inputs[source_url]'";
		}

		if(isset($inputs['date_from'], $inputs['date_to']) && $inputs['date_from'] != '' && $inputs['date_to'] != '') {
			$where_statements[] = "(date(created_at) BETWEEN '$inputs[date_from]' AND '$inputs[date_to]')";
		}

		if(count($where_statements) > 0) {
			$where_qry = implode(',', $where_statements);
			$where_qry = str_replace(',', ' AND ', $where_qry);
			$query .= 'WHERE '.$where_qry.' ';
		}

		//get total count
		$total_query = str_replace('SELECT * FROM user_info', 'SELECT COUNT(*) FROM user_info', $query);
		$result = mysqli_query($connection, $total_query);
		$row = mysqli_fetch_row($result);
		$returns['total_count'] = $row[0];
		$_SESSION['total_query'] = $total_query;

		if(isset($inputs['order'])) {
			$col = $columns[$inputs['order'][0]['column']];
			$dir = $inputs['order'][0]['dir'];
			$query .= "ORDER BY $col $dir ";
		}
		$_SESSION['download_query'] = $query;

		//get 
		$query .= "limit $inputs[length] offset $inputs[start]";

		$_SESSION['query'] = $query;
		$result = mysqli_query($connection, $query);
		$return_count = 0;
		$users = array();

		if(mysqli_num_rows($result) > 0) {
			// $return_count = mysqli_num_rows($result);
			// $users = mysqli_fetch_all($result,MYSQLI_ASSOC);
			while($data = mysqli_fetch_assoc($result)) {
				$users[] = $data;
			}
			// $users = mysqli_fetch_assoc($result);
		}

		$returns['return_count'] = $return_count;
		$returns['users'] = $users;

		mysqli_close($connection);

		// $_SESSION['test'] = $returns;
		return $returns;
	}

	function selectQuery($query) {
		$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
		$result = mysqli_query($connection, $query);
		$returns = array();
		if(mysqli_num_rows($result) > 0) {
			while($data = mysqli_fetch_assoc($result)) {
				$returns[] = $data;
			}
		}
		mysqli_close($connection);

		return $returns;
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		if(isset($_GET['type'])) {
			if($_GET['type'] == 'save_user') {
				$result = 0;
				switch($_GET['result']) {
					case 'good':
						$result = 1;
						break;
					case 'warn':
						$result = 2;
						break;
					case 'bad':
						$result = 3;
						break;
					default:
						logUserNoStatus($_GET['id'], $_GET['result']);
						break;
				}
				$rt = isset($_SESSION['rev_tracker']) ? $_SESSION['rev_tracker'] : 1;
				$dt = new DateTime("now", new DateTimeZone('America/Los_Angeles'));

				$localdt = date_create($_GET['dt']);
				$local = date_format($localdt, 'Y-m-d H:i:s');

				$user_info = array(
					'affiliate_id' => $_POST['affiliate_id'],
					'revenue_tracker_id' => $rt,
					'first_name' => $_POST['firstname'],
					'last_name' => $_POST['lastname'],
					'email' => $_POST['email'],
					'birthdate' => $_POST['dobyear'].'-'.$_POST['dobmonth'].'-'.$_POST['dobday'],
					'gender' => $_POST['gender'],
					'zip' => $_POST['zip'],
					'city' => $_POST['city'],
					'state' => $_POST['state'],
					'address' => $_POST['address'],
					'phone' => $_POST['phone'],
					'source_url' => $_POST['source_url'],
					'ip' => $_POST['ip'],
					'is_mobile' => $_SESSION['device']['isMobile'] == 1 ? 1 : 0,
					'browseragent' => $_POST['browser_agent'],
					'localdatetime' => $local,
					'anurastatus' => $result,
					'anura_id' => $_GET['id'],
					'created_at' => $dt->format('Y-m-d H:i:s')
				);

				logUser($user_info);

				echo json_encode($user_info);
			}else if($_GET['type'] == 'get_user') {
				$anura_status = array(
					1 => 'Good',
					2 => 'Warning',
					3 => 'Bad'
				);
				$users = array();

				// $_SESSION['get_user_post'] = $_POST;

				$results = selectUsers($_POST);

				foreach($results['users'] as $user) {

					$user['status'] = isset($anura_status[$user['anurastatus']]) ? $anura_status[$user['anurastatus']] : '';
					$user['mobile'] = $user['is_mobile'] == 1 ? 'Yes' : 'No';
					$details = '<textarea id="user-'.$user['id'].'-details" class="hidden">'.json_encode($user).'</textarea>';
					$editBTn = '<button class="more-details btn btn-primary" data-id="'.$user['id'].'"><span class="glyphicon glyphicon-list-alt"></span></button>';

					$su_ex = explode('?', $user['source_url']);
					$source_url = $su_ex[0];
					if(isset($su_ex[1])) $source_url .= '...';

					$users[] = array(
						$user['anura_id'],
						$user['affiliate_id'],
						$user['revenue_tracker_id'],
						$user['first_name'],
						$user['last_name'],
						$user['email'],
						$user['zip'],
						$user['ip'],
						$user['status'],
						$source_url,
						$user['created_at'],
						$details.$editBTn
					);
				}

				$responseData = array(
		            "draw"            => intval($_POST['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
		            "recordsTotal"    => $results['total_count'],  // total number of records
		            "recordsFiltered" => $results['total_count'], // total number of records after searching, if there is no searching then totalFiltered = totalData
		            "data"            => $users,   // total data array
		        );
		        echo json_encode($responseData);
			}
		}
	}else {
		if(isset($_GET['type'])) {
			if($_GET['type'] == 'test_connection') {
				$dt = new DateTime("now", new DateTimeZone('America/Los_Angeles'));
				$user_info = array(
					'affiliate_id' => 1,
					'revenue_tracker_id' => 1,
					'first_name' => 'Test',
					'last_name' => 'Test',
					'email' => 'test@engageiq.com',
					'birthdate' => '1994-10-05',
					'gender' => 'F',
					'zip' => '10001',
					'city' => 'New York',
					'state' => 'NY',
					'address' => '125 Broadway',
					'phone' => '7897897898',
					'source_url' => 'http://cur_pfr.test/dynamic_live/?affiliate_id=18447&campaign_id=32819&offer_id=175&s1=surveymobile',
					'ip' => '192.168.10.1',
					'is_mobile' => 0,
					'browseragent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36',
					'localdatetime' => '2018-05-23 18:59:52',
					'anurastatus' => 1,
					'anura_id' => '1234564789',
					'created_at' => $dt->format('Y-m-d H:i:s')
				);

				logUser($user_info);
			}
		}
	}
?>