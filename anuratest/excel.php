<?php
require '../vendor/autoload.php';
include_once("../includes/anura.php"); 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

if(isset($_SESSION['download_query'])) {

	//get users
	$users = selectQuery($_SESSION['download_query']);

	if(count($users) > 0) {
		$spreadsheet = new Spreadsheet();
		$Excel_writer = new Xls($spreadsheet);

		$spreadsheet->setActiveSheetIndex(0);
		$sheet = $spreadsheet->getActiveSheet();

		$headers = array(
			'ID',
			'Status',
			'Affiliate',
			'Revenue Tracker',
			'First Name',
			'Last Name',
			'Email',
			'Birthdate',
			'Gender',
			'Zip',
			'State',
			'City',
			'Address',
			'Phone',
			'IP',
			'Source URL',
			'Is Mobile',
			'Browser Agent',
			'Local Date Time (Browser Time)',
			'Created At (PST Time)'

		);
		$sheet->fromArray($headers);
		$sheet->getStyle('A1:U1')->getFont()->setBold(true);

		$rows = array();
		$anura_status = array(
			1 => 'Good',
			2 => 'Warning',
			3 => 'Bad'
		);
		foreach($users as $user) {
			$row = array(
				$user['anura_id'],
				isset($anura_status[$user['anurastatus']]) ? $anura_status[$user['anurastatus']] : '',
				$user['affiliate_id'],
				$user['revenue_tracker_id'],
				$user['first_name'],
				$user['last_name'],
				$user['email'],
				$user['birthdate'],
				$user['gender'],
				$user['zip'],
				$user['state'],
				$user['city'],
				$user['address'],
				$user['phone'],
				$user['ip'],
				$user['source_url'],
				$user['is_mobile'] == 1 ? 'Yes' : 'No',
				$user['browseragent'],
				$user['localdatetime'],
				$user['created_at']
			);
			// $sheet->fromArray($row);
			$rows[] = $row;
		}

		$sheet->fromArray($rows, NULL, 'A2');

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="anurastatistics.xls"'); /*-- $filename is  xsl filename ---*/
		header('Cache-Control: max-age=0');
		 
		$Excel_writer->save('php://output');	
	}else {
		echo 'No Users Found';
	}	
}else {
	echo 'No query found. Reload Search.';
}
?>