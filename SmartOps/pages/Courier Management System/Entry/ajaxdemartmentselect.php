<?php
	$x=$_REQUEST['txt1'];
	include('../../../php_con/includes/db.ini.php');
	$addsql02="SELECT `deparmentNumber`,`deparmentName` 
			   FROM `deparment` 
			   where branchNumber = '".$x."' and 
                     deparmentNumber NOT IN ('UNDEF','01004' , '9517' , '9521' , '1212' , '40401' , '9506' , '9516','9523')";
	$quary102 = mysqli_query($conn,$addsql02);
?>
   &nbsp;&nbsp; <select class="box_decaretion" name="selDepartmentNumber" id="selDepartmentNumber" onkeypress="return disableEnterKey(event)" >
                	<option value="">--Select Department Name--</option>
				<?php
                     while ($rec2 = mysqli_fetch_array($quary102)){
                        echo "<option value='".$rec2[0]."'>".$rec2[1]."</option>";
                     }
                ?>
               </select>
   
