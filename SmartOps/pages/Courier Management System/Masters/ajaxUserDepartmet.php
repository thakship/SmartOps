<?php
	$w = $_REQUEST['g1'];
	//echo $w;
	include('../../../php_con/includes/db.ini.php');
	//include('../../../php_con/includes/CommonGrid.php');
	$addDepartment = "SELECT `deparmentNumber`, `deparmentName` FROM `deparment` WHERE `branchNumber` = '$w'";
	$quary1 = mysqli_query($conn,$addDepartment);
	
?>
<select class="box_decaretion" name="selDepartmentNumber" id="selDepartmentNumber" onKeyPress="return disableEnterKey(event)"  required>
                	<option value="">--Select Department Name--</option>
				<?php
                     while ($rec = mysqli_fetch_array($quary1)){
                        echo "<option value='".$rec[0]."'>".$rec[1]."</option>";
                     }
                ?>
               </select>