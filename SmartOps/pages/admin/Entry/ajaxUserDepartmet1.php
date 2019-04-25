<?php
	$w = $_REQUEST['g2'];
	//echo $w;
	include('../../../php_con/includes/db.ini.php');
	//include('../../../php_con/includes/CommonGrid.php');
	$addDepartment = "SELECT `deparmentNumber`, `deparmentName` FROM `deparment` WHERE `branchNumber` = '$w'";
	$quary1 = mysqli_query($conn,$addDepartment);
	
?>
<select class="form-control" name="txtDepartmentNumber" id="txtDepartmentNumber" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
	<option value="">--Select Department Name--</option>
				<?php
                     while ($rec = mysqli_fetch_array($quary1)){
                        echo "<option value='".$rec[0]."'>".$rec[1]."</option>";
                     }
                ?>
               </select>
	<!--<p class="topline">Search departmen</p>-->
     <?php
	 		//trim($_POST['txtBranchNumber'])
			/*ShowGrid($conn,"SELECT `deparmentNumber`, `deparmentName` FROM `deparment` WHERE `branchNumber` = %1%",'txtDepartmentNumber','txtDepartmentNumber1','popup1(0)','department','txt3','txt4','0003');*/
			
     ?>