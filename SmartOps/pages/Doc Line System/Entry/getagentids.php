<?php
error_reporting(0); // turns off error reporting
include('../../../php_con/includes/db.ini.php');

$param1=$_GET['param1']; 
$param3=$_GET['param3'];
if(strlen($param1) > 0){
	$result1 = mysqli_query($conn,"SELECT `box_number`,`doc_number`,`doc_type`,`seq_in_out`,`seq_branch` FROM `doc_line_file_stack` WHERE `doc_type`='".$param3."' AND `action_stat` = 'ST' AND `doc_number` = '".$param1."'");
    if (mysqli_num_rows($result1) == 1) {
        while ($myrow1 = mysqli_fetch_array($result1)) {
            
            $box_number = $myrow1["box_number"];
            $doc_number = $myrow1["doc_number"];
			$doc_type = $myrow1["doc_type"];
            $seq_in_out = $myrow1["seq_in_out"];
            $seq_branch = $myrow1["seq_branch"];
            $textout1 .= $box_number. "|".$doc_number."|".$doc_type."|".$seq_in_out."|".$seq_branch;
        }
    } else {
        $textout1 = " | | | | | |" . $param1;
    }
}
echo $textout1;

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$param4=$_GET['param4']; 
$param5=$_GET['param5'];
if(strlen($param4) > 0){
    if($param5 != "BO"){
		$result2 = mysqli_query($conn,"SELECT `box_number`,`doc_number`,`doc_type` FROM `doc_line_file_stack` WHERE `doc_number` = '".$param4."' AND `doc_type`='".$param5."' AND `action_stat`='RF'");
        if (mysqli_num_rows($result2) == 1) {
            while ($myrow2 = mysqli_fetch_array($result2)) {
                $box_number = $myrow2["box_number"];
                $doc_number = $myrow2["doc_number"];
                $doc_type = $myrow2["doc_type"];
                $textout2 .= $box_number. "|".$doc_number."|".$doc_type;
            }
        } else {
            $textout2 = " | | | | | " . $param4;
        }
    }else{
        $textout2 .= "a|b|c";
	}
}
echo $textout2;

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$param7=$_GET['param7']; 
$param8=$_GET['param8'];
if(strlen($param7) > 0){
		$result3 = mysqli_query($conn,"SELECT `seq_in_out`,`seq_branch` FROM `doc_line_file_stack` WHERE `doc_number` = '".$param7."' AND `doc_type`= '".$param8."' AND `action_stat` = 'ST';");
        if (mysqli_num_rows($result3) == 1) {
            while ($myrow3 = mysqli_fetch_array($result3)) {
                $seq_in_out = $myrow3["seq_in_out"];
                $seq_branch = $myrow3["seq_branch"];
                $textout3 .= $seq_in_out. "|".$seq_branch;
            }
        } else {
            $textout3 = " | | | | | " . $param7;
        }
}
echo $textout3;


?>