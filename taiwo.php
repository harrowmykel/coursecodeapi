<?php 
  include 'api/v1_2/spreadsheet-reader-master/php-excel-reader/excel_reader2.php';
  include 'api/v1_2/spreadsheet-reader-master/SpreadsheetReader.php';

$Reader = new SpreadsheetReader('marking_scheme/apique.xlsx');//stu
$Reader2 = new SpreadsheetReader('assignment/apique/bb_copy6125235.xlsx');//teacg
// var_dump(json_encode($Reader2));
$array=$array2=array();

$q=0;
$num=0;

foreach ($Reader2 as $key => $value) {
	array_push($array, $value);
}

foreach ($Reader as $key => $value) {
	array_push($array2, $value);
}

foreach ($array as $key => $value) {
	$value2=isset($array2[$key])?$array2[$key]:array("","");

	if($value[0]==$value2[0]){
		$t_ans=$value[1];
		$s_ans=$value2[1];

		if((strcasecmp(trim($t_ans), trim($s_ans)))==0){
			echo $value[0]." ".$value2[1]."<br>";
			$q++;
		}
	}
	$num++;
}
echo $q." of ".$num;
 
?>