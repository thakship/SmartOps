<?php
	$f=$_REQUEST['b1']; //file number
	//echo $f;
	include('../../../php_con/includes/db.ini.php');
	$subselect = "SELECT `subdoc` FROM `courier_files` WHERE `fileNumber`='$f'";
	$sqlsubselct = mysqli_query($conn,$subselect);
	while($chekSts = mysqli_fetch_array($sqlsubselct)){
	//echo $chekSts[0];
	if($chekSts[0] == "NO"){
		$sub2 = "SELECT `documentNumber`,`documentName`,`receiveDateTime` FROM `courier_document` WHERE `fileNumber`='$f' AND `receiveDateTime` = '0000-00-00 00:00:00'";
		$sqlSub2 = mysqli_query($conn,$sub2);
		$_SESSION['rowDec'] = mysqli_num_rows($sqlSub2);
		$fileSub = "SELECT `fileName`,`preFileNumber` FROM `courier_files` WHERE `fileNumber`='$f'";
		$sql_fileSub = mysqli_query($conn,$fileSub);
	
?>

        <table class="tbl4" border="1">
              <tr>
                <td style="text-align:center; padding-top:5px; padding-bottom:5; width:350px;">File Name</td>
                <td style="text-align:center; padding-top:5px; padding-bottom:5; width:150px;">Document Number</td>
                <td style="text-align:center; padding-top:5px; padding-bottom:5;width:150px;">Document Name</td>
                <td style="text-align:center; padding-top:5px; padding-bottom:5;width:100px;">Access</td>
                <td style="text-align:center; padding-top:5px; padding-bottom:5;width:150px;">Previous File num</td>
              </tr>
<?php
		$a=1;
		while($recfileSub = mysqli_fetch_array($sql_fileSub)){
			while($recSub2 = mysqli_fetch_array($sqlSub2)){
				echo "<tr style='background-color:#FFFFFF;'>";
				echo "<td style='width:350px;'>
					  <div id='diva".$a."' style='display:none;'>
					  <input type='text' name='txtj".$a."' id='txtj".$a."' value='".$recfileSub[0]."'/>
					  </div> 
					  <input style='width:350px;' type='text' name='txt' id='txt' value='".$recfileSub[0]."' disabled='disabled'/></td>";
				echo "<td style='width:150px;'>
					  <div id='diva".$a."' style='display:none;'>
					  <input type='text' name='txtg".$a."' id='txtg".$a."' value='".$recSub2[0]."'/>
					  </div> 
					  <input style='width:150px;' type='text' name='txt' id='txt' value='".$recSub2[0]."' disabled='disabled'/></td>";
				echo "<td style='width:150px;'>
					  <div id='diva".$a."' style='display:none;'>
					  <input type='text' name='txth".$a."' id='txth".$a."' value='".$recSub2[1]."'/>
					  </div>
					  <input style='width:150px;' type='text' name='txt' id='txt' value='".$recSub2[1]."' disabled='disabled'/></td>";
				echo "<td style='width:100px;'>";
						if($recSub2[2] != "0000-00-00 00:00:00"){
							echo "<input type='checkbox' style='text-align:center;' name='chkx".$a."' id='chkx".$a."' checked='checked'/>";
						}else{
							echo "<input type='checkbox' style='text-align:center;' name='chkx".$a."' id='chkx".$a."'/>";
						}
				echo "</td>";
				echo "<td style='width:150px;'>
					  <div id='diva".$a."' style='display:none;'>
					  <input type='text' name='txtu".$a."' id='txtu".$a."' value='".$recfileSub[1]."'/>
					  </div>
					  <input style='width:150px;' type='text' name='txt' id='txt' value='".$recfileSub[1]."' disabled='disabled'/></td>";
				echo "</tr>";
				$a++;
			}
		}
		
?>
        <div style='display:none;'>
            <input type='text' name='txtd' id='txtd' value='<?php echo $_SESSION['rowDec']; ?>' required/>
            <input type='text' name='txtx' id='txtx' value='<?php echo $f; ?>' required/>
        </div>
<?php
	}else{
		$sub2 = "SELECT `subDocumentNumber`,`subDocumentName`,`receiveDateTime` FROM `courier_document_sub` WHERE `fileNumber`='$f' AND `receiveDateTime` = '0000-00-00 00:00:00'";
		$sqlSub2 = mysqli_query($conn,$sub2);
		$_SESSION['rowDec'] = mysqli_num_rows($sqlSub2);
		$fileSub = "SELECT `fileName`,`preFileNumber` FROM `courier_files` WHERE `fileNumber`='$f'";
		$sql_fileSub = mysqli_query($conn,$fileSub);
	
?>

        <table class="tbl4" border="1">
              <tr>
                <td style="text-align:center; padding-top:5px; padding-bottom:5; width:150px;">File Name</td>
                <td style="text-align:center; padding-top:5px; padding-bottom:5; width:150px;">Document Number</td>
                <td style="text-align:center; padding-top:5px; padding-bottom:5;width:150px;">Document Name</td>
                <td style="text-align:center; padding-top:5px; padding-bottom:5;width:100px;">Access</td>
                <td style="text-align:center; padding-top:5px; padding-bottom:5;width:150px;">Previous File num</td>
              </tr>
<?php
    	$a=1;
		while($recfileSub = mysqli_fetch_array($sql_fileSub)){
			while($recSub2 = mysqli_fetch_array($sqlSub2)){
				echo "<tr style='background-color:#FFFFFF;'>";
				echo "<td style='width:150px;'>
					  <div id='diva".$a."' style='display:none;'>
					  <input type='text' name='txtj".$a."' id='txtj".$a."' value='".$recfileSub[0]."'/>
					  </div> 
					  <input style='width:150px;' type='text' name='txt' id='txt' value='".$recfileSub[0]."' disabled='disabled'/></td>";
				echo "<td style='width:150px;'>
					  <div id='diva".$a."' style='display:none;'>
					  <input type='text' name='txtg".$a."' id='txtg".$a."' value='".$recSub2[0]."'/>
					  </div> 
					  <input style='width:150px;' type='text' name='txt' id='txt' value='".$recSub2[0]."' disabled='disabled'/></td>";
				echo "<td style='width:150px;'>
					  <div id='diva".$a."' style='display:none;'>
					  <input type='text' name='txth".$a."' id='txth".$a."' value='".$recSub2[1]."'/>
					  </div>
					  <input style='width:150px;' type='text' name='txt' id='txt' value='".$recSub2[1]."' disabled='disabled'/></td>";
				echo "<td style='width:100px;'>";
						if($recSub2[2] != "0000-00-00 00:00:00"){
							echo "<input type='checkbox' style='text-align:center;' name='chkx".$a."' id='chkx".$a."' checked='checked'/>";
						}else{
							echo "<input type='checkbox' style='text-align:center;' name='chkx".$a."' id='chkx".$a."'/>";
						}
				echo "</td>";
				echo "<td style='width:150px;'>
					  <div id='diva".$a."' style='display:none;'>
					  <input type='text' name='txtu".$a."' id='txtu".$a."' value='".$recfileSub[1]."'/>
					  </div>
					  <input style='width:150px;' type='text' name='txt' id='txt' value='".$recfileSub[1]."' disabled='disabled'/></td>";
				echo "</tr>";
				$a++;
			}
		}
	
?>
        <div style='display:none;'>
            <input type='text' name='txtd' id='txtd' value='<?php echo $_SESSION['rowDec']; ?>' required/>
            <input type='text' name='txtx' id='txtx' value='<?php echo $f; ?>' required/>
        </div>
<?php
	}
}
?>