<?php
 //.........................................Databse Connection .......................................................
    function DatabaseConnectionCom(){
        $conn = mysqli_connect("localhost","root","1234","cdberp");
        return $conn;
    }

function auditupdate($conn,$auditrow,$table,$concat,$newContac){
		date_default_timezone_set('Asia/Colombo');
		$addsqlAud="INSERT INTO audittable(`auditNumber`,`auditDateTime`,`auditBy`,`tableName`,`authoriedBy`,`authoriedDateTime`,`oldData`,`newData`,`moduleCode`) VALUES('$auditrow',now(),'$_SESSION[user]' ,'$table', '$_SESSION[user]', now(),'$concat','$newContac', '$_SESSION[Module]')";
		$quaryadu = mysqli_query($conn,$addsqlAud) or die(mysqli_error($conn));
		return;
}
function FileMovementLogger($conn,$FileNumber,$logWhat){ 
	//Setting the time zone
	date_default_timezone_set('Asia/Colombo');
	$fileMove = "INSERT INTO `filemovement`(`fileNumber`, `createDateTime`, `action`, `doneby`) VALUES ('$FileNumber',now(),'$logWhat','$_SESSION[user]')";
	$sql_fileMove= mysqli_query($conn,$fileMove) or die(mysqli_error($conn));
}

function FileMovementLogger_USER($conn,$FileNumber,$logWhat,$SESSUSER){ 
	//Setting the time zone
	date_default_timezone_set('Asia/Colombo');
	$fileMove = "INSERT INTO `filemovement`(`fileNumber`, `createDateTime`, `action`, `doneby`) VALUES ('".$FileNumber."',now(),'".$logWhat."','".$SESSUSER."')";
	$sql_fileMove= mysqli_query($conn,$fileMove) or die(mysqli_error($conn));
}



function sendMail($email,$title,$mail){
	$to = $email;
	$sub = $title;
	$msg = $mail;
	mail($to,$sub,$msg);
	/*echo "<script> alert('Mail Sent!');</script>";*/
}

function sendMailNuw($toMail,$title,$mail,$fromMail){
    $conn = DatabaseConnectionCom();
	$to = $toMail;
	$subject = $title;
	$message = mysqli_real_escape_string($conn, $mail); ;
	$headers = $fromMail;
	//mail($to,$subject,$message,$headers);
	/*echo "<script> alert('Mail Sent!');</script>";*/
    $sender = "SYSTEM";
    $to_cc = "";
    if($to != ""){
         $inseet_mailBox = "INSERT INTO `mail_queue`( `jobIndateTime`, `sender`, `receivers_to`, `subject`, `body`, `receivers_cc`, `sendDateTime`) 
                VALUES (NOW(), '".$sender."', '".$to."', '".$subject."', '".$message."', '".$to_cc."', '0000-00-00 00:00:00');";
        //echo $inseet_mailBox;
        $que_mailBox = mysqli_query($conn,$inseet_mailBox) or die(mysqli_error($conn));  
    }
   
}

function GetFormattedException($ERROR_CODE,$UNFORMATTED_ERROR){
	switch ($ERROR_CODE) {
		case 1452:
			echo "<BR><p style='color:#CC3300; font-size:12px;'>Record(s) not saved : " ."Key field not available in master</br>".$UNFORMATTED_ERROR."</p>";
			break;
		case 1062:
			echo "<BR><p style='color:#CC3300; font-size:12px;'>Record(s) not saved : " ."Key field already exist</br>Internal Error : ".$UNFORMATTED_ERROR."</p>";
			break;
		default:
		   echo "<BR><p style='color:#CC3300; font-size:12px;'>Record(s) not saved : ".$UNFORMATTED_ERROR."</p>";
	}
}



function GetParamValue($para,$conn){
	$paramValue = "";
	if ($result = mysqli_query($conn,"SELECT `para_value` FROM `erp_sys_param` WHERE `para_code`='$para' AND `para_status`='A'")) 
		$paramValue = mysqli_fetch_array($result, MYSQLI_ASSOC)["para_value"];
	return $paramValue;	
}

function ShowGrid($conn,$sql,$OutputCode,$OutputDescription,$pop,$funcname,$txt,$txta,$relationship){
	$sql = str_replace('%1%', "'".$relationship."'", $sql);
	$sql_grid= mysqli_query($conn,$sql) or die(mysqli_error($conn));
    echo "<table border='1'>
            <tr>
               <td style='text-align:center; padding-top:5px; padding-bottom:5;width:200px;'>Code</td>
               <td style='text-align:center; padding-top:5px; padding-bottom:5;width:200px;'>Description</td>
               <td style='text-align:center; padding-top:5px; padding-bottom:5;width:100px;'>Access</td> 
            </tr>";				
	$a = 1 ;					
	while ($recs = mysqli_fetch_array($sql_grid)){
		if ($a==1){
			echo "<script>
					function ".$funcname."(obj,title){
						var [m,n]= title.split('|');
						var m1 = [m];
						var n1 = [n];
						if(obj == 'btnselect'){ 
							var id1 = document.getElementById(m1).value;
							var id2 = document.getElementById(n1).value;
							document.getElementById('".$OutputCode."').value = id1;
							document.getElementById('".$OutputDescription."').value = id2;
							var mydata;
							mydata= new XMLHttpRequest();
							mydata.onreadystatechange=function(){
								if(mydata.readyState==4){
									document.getElementById('test').innerHTML=mydata.responseText;
								}
							}
							mydata.open('GET','ajaxUserDepartmet.php'+'?g1='+id1,true);
							mydata.send();
						}else{
							alert('else my code');
						}
					} 
				</script>";
		}
        echo "<tr style='background-color:#FFFFFF;'>";
        echo "<td style='width:200px;'><div style='display:none;'><input class='txt' type='text' name='$txt".$a."' id='$txt".$a."' value='".$recs[0]."'/></div> 
                              <input style='width:200px;' type='text' name='$txt".$a."' id='$txt".$a."' value='".$recs[0]."' disabled='disabled'/></td>";
        echo "<td style='width:200px;'> <div style='display:none;'><input class='txt' type='text' name='$txta".$a."' id='$txta".$a."' value='".$recs[1]."'/></div>
                              <input style='width:200px;' type='text' name='$txta".$a."' id='$txta".$a."' value='".$recs[1]."' disabled='disabled'/></td>";
        echo "<td style='width:100px;'>";
        echo "<input style='font-size: 12px;' type='button' id='btnselect' name='btnselect' title='$txt".$a."|$txta".$a."' value='Select' onclick='".$funcname."(this.id,title);".$pop.";'/>";
        echo "</td></tr>";
    	$a++;
    } //while
	echo "</table>";
}

function commenTable($conn,$getsql){
		echo "<table border='1' id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 100px;'>
            	<tr style='background-color: #BEBABA;'>
                <td style='width:100px;'>Code ID</td>
                <td style='width:500px;'>Code Name</td>
            </tr>";
                $q_Select_cat = mysqli_query($conn,$getsql);
				$i = 1;
                while($RESelect_cat = mysqli_fetch_array($q_Select_cat)){
                   echo "<tr>";
                   echo "<td style='width:100px;'><input style='width:100px;' type='text' name='txta".$i."' id='txta".$i."' value='".$RESelect_cat[0]."'  onKeyPress='return disableEnterKey(event)' readonly = 'readonly'/></td>";
                   echo "<td style='width:500px;'><input style='width:500px;' type='text' name='txtb".$i."' id='txtb".$i."' value='".$RESelect_cat[1]."'  onKeyPress='return disableEnterKey(event)' readonly = 'readonly' /></td>";
                   echo "</tr>"; 
                }
        echo "</table>";
}
?>

