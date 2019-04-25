<?php
	$x=$_REQUEST['txt1'];
	include('../../../php_con/includes/db.ini.php');
	$addsql02="SELECT `deparmentNumber`,`deparmentName` 
			   FROM `deparment` 
			   where branchNumber = '".$x."' and deparmentNumber != 'UNDEF'";
	$quary102 = mysqli_query($conn,$addsql02);
?>
   &nbsp;&nbsp; <select class="box_decaretion" name="selDepartmentNumber" id="selDepartmentNumber" onKeyPress="return disableEnterKey(event)"  required>
                	<option value="">--Select Department Name--</option>
				<?php
                     while ($rec2 = mysqli_fetch_array($quary102)){
                        echo "<option value='".$rec2[0]."'>".$rec2[1]."</option>";
                     }
                ?>
               </select>
   
