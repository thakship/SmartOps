<?php

error_reporting(0); // turns off error reporting
include('../../../php_con/includes/db.ini.php');

$param1=$_GET['param1']; 
if(strlen($param1) > 0){
	$result1 = mysqli_query($conn,"SELECT `box_number`,`box_opn_date`,`box_opn_by`,`box_clo_date`,`box_clo_by`,`box_disp_date`,`box_disp_by` FROM `doc_line_box_mast` WHERE `box_number`='$param1'");
    if (mysqli_num_rows($result1) == 1) {
        while ($myrow1 = mysqli_fetch_array($result1)) {
            $box_number = $myrow1["box_number"];
            $box_opn_date = $myrow1["box_opn_date"];
			$box_opn_by = $myrow1["box_opn_by"];
			$box_clo_date = $myrow1["box_clo_date"];
			$box_clo_by = $myrow1["box_clo_by"];
			$box_disp_date = $myrow1["box_disp_date"];
			$box_disp_by = $myrow1["box_disp_by"];
          $textout1 .= $box_number. ", ".$box_opn_date.", ".$box_opn_by.", ".$box_clo_date.", ".$box_clo_by.", ".$box_disp_date.", ".$box_disp_by;
        }
    } else {
        $textout1 = " , , , , , , , , , , " . $param1;
    }
}
echo $textout1;

$param2=$_GET['param2']; 
if(strlen($param2) > 0){
	$result2 = mysqli_query($conn,"SELECT `doc_number`,`doc_name` FROM `doc_line_doc_mast` WHERE  `doc_number`='$param2'");
    if (mysqli_num_rows($result2) == 1) {
        while ($myrow2 = mysqli_fetch_array($result2)) {
            $doc_number = $myrow2["doc_number"];
            $doc_name = $myrow2["doc_name"];
          $textout2 .= $doc_number. ", ".$doc_name;
        }
    } else {
        $textout2 = " , , , , , , " . $param2;
    }
}
echo $textout2;
?>