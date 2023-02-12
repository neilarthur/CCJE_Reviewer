<?php


$host = "localhost";
$username = "root";
$password = "";
$database_name = "ccjeexam";

$sqlcon = mysqli_connect($host,$username,$password,$database_name);


$sqlcon->set_charset("utf8");

$tables = array();

$sql = "SHOW TABLES";

$result = mysqli_query($sqlcon,$sql);


while ($row = mysqli_fetch_row($result)) {

	$tables[] = $row[0];

}

$sqlscript = "";

foreach ($tables as $table) {


	$queryes = "SHOW CREATE TABLE $table";
	$result = mysqli_query($sqlcon,$queryes);
	$row = mysqli_fetch_row($result);

	$sqlscript .= "\n\n".$row[1].";\n\n";


	$queryes = "SELECT * FROM $table";

	$result = mysqli_query($sqlcon,$queryes);

	$columncount = mysqli_num_fields($result);


	for ($i=0; $i < $columncount ; $i++) { 
		
		while ($row = mysqli_fetch_row($result)) {
			
			$sqlscript .="INSERT INTO $table VALUES (";

			for ($j=0; $j < $columncount ; $j++) { 
				
				$row[$j] = $row[$j];

				if (isset($row[$j])) {
					$sqlscript .='"'.$row[$j].'"';
				}
				else {
					$sqlscript .='""';
				}
				if ($j < ($columncount - 1)) {
					
					$sqlscript .=',';
				}

			}
			$sqlscript .=");\n";
		}
	}

	$sqlscript .= "\n";
}


if (!empty($sqlscript)) {

	$backup_file_name =  $database_name .='_backup_'.time().'.sql';
	$file_handler =  fopen($backup_file_name,'w+');
	$number_of_lines = fwrite($file_handler, $sqlscript);
	fclose($file_handler);

	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename=' . basename($backup_file_name));
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	header('Content-Length: ' . filesize($backup_file_name));
	ob_clean();
	flush();
	readfile($backup_file_name);
	exec('rm ' . $backup_file_name);
}
?>