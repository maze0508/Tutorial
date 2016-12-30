<?php
require_once 'Excel/reader.php';
include_once("php/root.php");
$data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('UTF-8');
$data->read('Book1.xls');

for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++)
{ 
for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++)
{
    //echo "\"".$data->sheets[0]['cells'][$i][$j]."\",";
}
   $query = "insert into student_data(account,pwd,name,unit,email,compet) values ('".$data->sheets[0]['cells'][$i][1]."','".$data->sheets[0]['cells'][$i][2]."','".$data->sheets[0]['cells'][$i][3]."','".$data->sheets[0]['cells'][$i][4]."','".$data->sheets[0]['cells'][$i][5]."','".$data->sheets[0]['cells'][$i][6]."')";
   $result = $mysqli->query($query);
}
?>