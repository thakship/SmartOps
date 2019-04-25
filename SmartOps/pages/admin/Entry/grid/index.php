
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DataTables</title>
<script type="text/javascript">
function pageClose(){ //Page Close Function.......
	parent.location.href = parent.location.href;
}
</script>
<style type="text/css">
	.tbl1{
		width:600px;
		background: #eeeeee;
		background: -moz-linear-gradient(top, #eeeeee 0%, #cccccc 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#eeeeee), color-stop(100%,#cccccc)); 
		background: -webkit-linear-gradient(top, #eeeeee 0%,#cccccc 100%); 
		background: -o-linear-gradient(top, #eeeeee 0%,#cccccc 100%); 
		background: -ms-linear-gradient(top, #eeeeee 0%,#cccccc 100%); 
		background: linear-gradient(to bottom, #eeeeee 0%,#cccccc 100%);
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#eeeeee', endColorstr='#cccccc',GradientType=0 );
	}
</style>

</head>
<body>
<form action="" method="post" >
<?php

echo '<table  class="tbl1" border="1">
<tr>
<th align="center" width="8%"></th>
<th align="center" width="23%">User Name</th>
<th align="center" width="23%">User ID</th>
<th align="center" width="23%">Account State</th>
<th align="center" width="23%">Action</th>
</tr>';
$command = "SELECT `userName`,`userID`,`accountStat` FROM user_active  WHERE `accountStat` = 'L' ORDER BY userName DESC";
$result = mysqli_query($conn,$command);
$command2= "SELECT DISTINCT `userName`,`userID`,`accountStat` FROM user_active  WHERE `accountStat` = 'L' ORDER BY userName ASC";
$result2 = mysqli_query($conn,$command2);
$_SESSION['rownum'] = mysqli_num_rows($result2);
if ($result2 && mysqli_num_rows($result2) > 0) {
	echo  '<tbody>';
	$a=1;
	while ($row = mysqli_fetch_assoc($result2)) {
	echo "<script>
				document.getElementById('ye".$a."').onclick = null;
				function show".$a."(){
					if(document.getElementById('ye".$a."').checked!=true){
							
							document.getElementById('btnUserHandlingUpdate".$a."').disabled=true;
						}else{
							document.getElementById('btnUserHandlingUpdate".$a."').disabled=false;	
					}
				}
		</script>";
		echo '<tr style="background-color:#FFFFFF;">
				<td width="8%" align="center">
				<input type="checkbox" name="chaa'.$a.'" value="" id="ye'.$a.'" onclick="show'.$a.'()"/>
				</td>
				<td width="23%">
				<input style="width:200px;" type="text" name="selaa'.$a.'" id="selaa'.$a.'" value="'.$row['userName'].'" disabled="disabled"/>
				<div id="diva'.$a.'" style="display:none;"><input type="text" name="txta'.$a.'" id="txta'.$a.'" value="'.$row['userName'].'"/></div>
				</td>
				<td width="23%"><input style="width:200px;" type="text" name="selbb'.$a.'" id="selbb'.$a.'" value="'.$row['userID'].'"  disabled="disabled"/>
				<div id="divb'.$a.'" style="display:none;"><input type="text" name="txtb'.$a.'" id="txtb'.$a.'" value="'.$row['userID'].'"/></div></td>
		<td width="23%"><input style="width:200px;" type="text" name="selcc'.$a.'" id="selcc'.$a.'" value="'.$row['accountStat'].'" disabled="disabled"/>
		<div id="divc'.$a.'" style="display:none;"><input type="text" name="txtc'.$a.'" id="txtc'.$a.'" value="'.$row['accountStat'].'"/></div></td>
		<td width="23%"><input style="font-size: 12px;" type="button" name="btnUserHandlingUpdate'.$a.'" id="btnUserHandlingUpdate'.$a.'" value="Update" onclick="return confirmUpdate'.$a.'()" disabled="disabled"/>
		</td>
		</tr>';
echo "<script>
    function confirmUpdate".$a."() {
	
		var b =document.getElementById('txta".$a."').value;
		//alert(b);
		//var c  =document.getElementById('txtc".$a."').value;
		//alert(c);
		
		//var b =document.getElementById('lbla".$a."').innerHTML;
		//alert(b);
		var c =document.getElementById('lblus').innerHTML;
		//alert(c);
		var r = confirm('Are you sure you want to Unlock this?')
        if (r==true){
			$.ajax({ 
				type:'POST', 
				data: {id : b,value:c}, 
				url: 'grid/aa.php', 
				success: function() { 
 				alert('updated success!');     
			}
			});	
        }else{
			//alert('BBBBB');		
		}

    }
</script>"; 
		$a++;
		}						
	echo '</tbody></table>';
}
?>
</form>
</body>
</html>
