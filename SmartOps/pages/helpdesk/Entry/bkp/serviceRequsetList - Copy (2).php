<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: Service Request List
Purpose			: To viwe Request list for Service
Author			: Madushan Wikramaarachchi
Date & Time		: 01.09 P.M 01/01/2015
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/e/002";
	include('../../pageasses.php');
	//echo $_SESSION['usergroupNumber'];
	$ass = cakepageaccess();
	//echo $ass;
	if($ass != 1){
		header('Location:../../home.php');
	}
	include('../../../php_con/includes/db.ini.php');
	include('../../../php_con/includes/Common.php');
	include('../../loguser.php');
    include('../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_php_function.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Courier Day Receive  Report</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../helpdesk_DEVELOPMENT/CSS/helpdesk_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../helpdesk_DEVELOPMENT/JAVASCRIPT_FUNCTION/helpdesk_js_function.js"></script>
<!--END Common fumction Libariries-->
<style type="text/css">
  #outer{
		visibility: hidden;
		position: fixed;
		left: 0px;
		top:0px;
		width: 100%;
		height: 100%;
		background: #6DA6E4;
		opacity: 0.7;
	}
	#conten{
		position: fixed;
		margin-top:-150px;
		margin-left: -200px;
		top:50%;
		left:50%;
		visibility: hidden;
		background: #ffffff;
		z-index: 5;
		height:275px;
		overflow-y: scroll;
		border:#000000 solid 1px;
	}
</style>
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script type="text/javascript">
function pageClose(){ //Page Close Function.......
	//parent.location.href = parent.location.href;
    window.open('http://cdberp:8080/cdb/pages/helpdesk/Entry/serviceRequsetList.php?DispName=Service%20Request%20List','conectpage');
}
function pageRef(){
   window.open('http://cdberp:8080/cdb/pages/helpdesk/Entry/serviceRequsetList.php?DispName=Service%20Request%20List','conectpage');
}

    function clientValidate(title){
        var helpAdmin = document.getElementById('txt_helpdeskadmin').value;
        var helpClose = document.getElementById('txt_helpdesk_close').value;
        var mydata;
        var getHI = document.getElementById(title).value;
        mydata= new XMLHttpRequest();
        mydata.onreadystatechange=function(){
            if(mydata.readyState==4){
                document.getElementById('maneSpan').innerHTML=mydata.responseText;           
            }
        }
        mydata.open("GET","../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_Ajax.php"+"?getHelpIDreq="+getHI+"&gettxt_helpdesk_close="+helpClose,true);
        mydata.send();
    }
    
    function getSolution(){
        var getsubHI = document.getElementById('txt_help_ID').value;
            mydata1= new XMLHttpRequest();
            mydata1.onreadystatechange=function(){
                if(mydata1.readyState==4){
                    document.getElementById('maneSpan').innerHTML=mydata1.responseText;           
                }
            }
            mydata1.open("GET","../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_Ajax.php"+"?getsubHelpIDreq="+getsubHI,true);
            mydata1.send();
    }
    
    function deleteRow(n){ // this fuction is Delete Row(s) in table
        //alert(n);
        var m=n.parentNode.parentNode.rowIndex;
        document.getElementById('myTable').deleteRow(m);
        var num1 = document.getElementById("myTable").rows.length;
        var num2 = num1 - 1;
        var y = 1;
        var  rowcount = document.getElementById("myTable").rows.length;
        document.getElementById('row_COUNT').value =  document.getElementById("myTable").rows.length-1;
        var i = rowcount-1;    
       	for(var mloop=2;mloop <=100;mloop++){
            var elementA =  document.getElementById('txta' + (mloop - 1));
            var elementB =  document.getElementById('txtb' + (mloop - 1));
            if (elementA != null){
                // Re-order the sequence of the table rows.............
                elementA.value = y;
                //Changing the element ID's to capture in the php
                elementA.id = 'txta' + y;				  
                elementB.id = 'txtb' + y;
                //Changing the element name's to capture in the php				  
                elementA.name = 'txta' + y;				  
                elementB.name = 'txtb' + y;
                y++;
            }			
        }
}

function is_add_row(){
    var x = document.getElementById("myTable").rows.length;
    var getVal = document.getElementById('txtb'+(x-1)).value;
    if(getVal != ""){
        var table=document.getElementById("myTable");
        var row=table.insertRow(-1);
        var cell1=row.insertCell(0);
        var cell2=row.insertCell(1);
        var cell3=row.insertCell(2);
        var cell4=row.insertCell(3);
        var cell5=row.insertCell(4);
        cell1.innerHTML="<input style='width:50px;text-align: right;' type='text' name='txta"+(x)+"' id='txta"+(x)+"' value='"+(x)+"'  onKeyPress='return disableEnterKey(event)' readonly='readonly'/>";
        cell2.innerHTML="<input style='width:600px;' type='text' name='txtb"+(x)+"' id='txtb"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)'/>";
        cell3.innerHTML="<input style='width:100px;' type='text' name='txtUse"+(x)+"' id='txtUse"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)' readonly='readonly' />";
        cell4.innerHTML="<input style='width:150px;' type='text' name='txtOn"+(x)+"' id='txtOn"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)' readonly='readonly' />";
        cell5.innerHTML="<img src='../../../img/dele.png' style='width:15px;' onclick='deleteRow(this)'/><div style='display: none;'><input class='box_decaretion' type='text' name='txt_c_n"+(x)+"' id='txt_c_n"+(x)+"' value='1' onKeyPress='return disableEnterKey(event)' readonly='readonly'/></div>";
        document.getElementById('row_COUNT').value =  document.getElementById("myTable").rows.length-1;
    }else{
       alert('Note text box empty.');
    }
}
 function popup(x){
		if(x==1){
			var mydataGried;
			mydataGried= new XMLHttpRequest();
			mydataGried.onreadystatechange=function(){
				if(mydataGried.readyState==4){
					document.getElementById('getGried').innerHTML=mydataGried.responseText;  
					document.getElementById('outer').style.visibility = "visible";
					document.getElementById('conten').style.visibility = "visible";           
				}
			}
			mydataGried.open("GET","ajax_Gried.php"+"?sr_gried="+x,true);
			mydataGried.send();
			/*document.getElementById('outer').style.visibility = "visible";
			document.getElementById('conten').style.visibility = "visible";*/
		
	  }else{
		document.getElementById('outer').style.visibility = "hidden";
		document.getElementById('conten').style.visibility = "hidden";
	  }	
	}
	
	function selectDB(xx){
			var id1 = document.getElementById('txt1'+xx).value;
			var id2 = document.getElementById('txt2'+xx).value;
			//alert(id1);
			//alert(id2);
			document.getElementById('txt_inner_User1').value = id1;
			document.getElementById('txt_inner_User2').value = id2;
	}
	
	function fileSelect(){
		var mydata5;
		mydata5= new XMLHttpRequest();
		mydata5.onreadystatechange=function(){
			if(mydata5.readyState==4){
				document.getElementById('getNewtblPopup').innerHTML=mydata5.responseText;
			}
		}
		var searchup=document.getElementById('popupsearch').value;
		mydata5.open('GET','ajaxEntryPopu1.php'+'?txtsearch='+searchup,true);
		mydata5.send();
  }
function removeUsreID(){
    document.getElementById('txt_inner_User1').value = '';
    document.getElementById('txt_inner_User2').value = '';
}    
</script>

</head>
<body oncontextmenu="return false">
<form action="" method="post" name="schform" enctype="multipart/form-data"> 
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<span id="maneSpan">

<!-- added by Rizvi on 9:48 AM 29/01/2015 -->
<?php
    $v_sql_det_detelsCNT = "SELECT COUNT(1) FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `cmb_states`, `branch`, `deparment`,`cdb_help_user_oth`
 WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
       `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
       `cdb_helpdesk`.`cmb_code` = `cmb_states`.`cmb_code` AND
       `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
       `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
       `cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND 
       `cdb_helpdesk`.`cmb_code` = '5001' AND
       `cdb_help_user_oth`.`user_group` = '".$_SESSION['usergroupNumber']."'
       ORDER BY `cdb_helpdesk`.`helpid`;";
    $v_que_det_detelsCNT = mysqli_query($conn,$v_sql_det_detelsCNT);
    $index = 0;
    while($rec_det_detelsCNT = mysqli_fetch_array($v_que_det_detelsCNT)){
	echo "<h3>Total record(s) : ". $rec_det_detelsCNT[0]. " </h3>";
    }

?>
<!-- End of added by Rizvi on 9:48 AM 29/01/2015 -->

<table border="1" cellpadding="0" cellspacing="0" id="myTable"  style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
        <tr style="background-color: #BEBABA;">
            <td style="width:60px;text-align: right;"><span style="margin-right: 5px;">Help ID</span></td>
            <td style="width:80px;text-align: right;"><span style="margin-right: 5px;">Entry Date</span></td>
            <td style="width:300px;text-align: left;"><span style="margin-left: 5px;">Issue</span></td>
            <td style="width:80px;text-align: left;"><span style="margin-left: 5px;">States</span></td>
            <td style="width:150px;text-align: left;"><span style="margin-left: 5px;">Req. Branch</span></td>
            <td style="width:150px;text-align: left;"><span style="margin-left: 5px;">Req. Department</span></td>
            <td style="width:80px;text-align: right;"><span style="margin-right: 5px;">Enter By</span></td>
            <td style="width:100px;text-align: left;"><span style="margin-left: 5px;">Urgency</span></td>
            <td style="width:80px;text-align: left;"><span style="margin-left: 5px;">Priority</span></td>
            <td style="width:80px;text-align: right;"><span style="margin-right: 5px;">Assign User</span></td>
            <td style="width:50px;"></td>
        </tr>
<?php
    $v_sql_det_detels = "SELECT `cdb_helpdesk`.`helpid` , DATE(`cdb_helpdesk`.`enterDateTime`), `cdb_helpdesk`.`issue`,`scat_02`.`scat_discr_2`, `branch`.`branchName`, `deparment`.`deparmentName`, `cdb_helpdesk`.`enterBy`, `urgency_states`.`ur_discr`, `priority_states`.`pr_discr` , `cdb_helpdesk`.`asing_by` 
 FROM `cdb_helpdesk`, `urgency_states`, `priority_states`, `scat_02` , `branch`, `deparment`,`cdb_help_user_oth`
 WHERE `cdb_helpdesk`.`ur_code` = `urgency_states`.`ur_code` AND
       `cdb_helpdesk`.`pr_code` = `priority_states`.`pr_code` AND
       `cdb_helpdesk`.`scat_code_2` = `scat_02`.`scat_code_2` AND
       `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`AND
       `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber` AND
       `cdb_helpdesk`.`cat_code` = `cdb_help_user_oth`.`cat_code` AND 
       `cdb_helpdesk`.`cmb_code` = '5001' AND
       `cdb_help_user_oth`.`user_group` = '".$_SESSION['usergroupNumber']."'
       ORDER BY `cdb_helpdesk`.`helpid`;";
    $v_que_det_detels = mysqli_query($conn,$v_sql_det_detels);
    $index = 0;
    while($rec_det_detels = mysqli_fetch_array($v_que_det_detels)){
        $entryBy = getUserNameGenaral($rec_det_detels[6],$conn);
        $asingBy = getUserNameGenaral($rec_det_detels[9],$conn);
        $index++;
        if($rec_det_detels[8]=='Highest'){
            $col = "#000000";
        }else{
            $col = "#000000";
        }
        $MyRow = "";
        if ($_SESSION['user'] == $rec_det_detels[9]){
           $MyRow = "background-color:lightblue;";
        }
        echo "<tr style='color: ".$col.";'>";
        echo "<td style='width:60px;text-align: right;".$MyRow ."'><div style='display: none;'><input style='width:60px;color:#999999;text-align: right;' type='text' name='txta".$index."' id='txta".$index."' value='".$rec_det_detels[0]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-left: 2px;'>".$rec_det_detels[0]."</span></td>";
        echo "<td style='width:80px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[1]."</span></td>";
        echo "<td style='width:300px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[2]."</span></td>";
        echo "<td style='width:150px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[3]."</span></td>";
        echo "<td style='width:150px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[4]."</span></td>";
        echo "<td style='width:80px;text-align: right;".$MyRow ."'><span style='margin-right: 2px;'>".$rec_det_detels[5]."</span></td>";
        echo "<td style='width:100px;text-align: left;".$MyRow ."' title = '".$entryBy."'><span style='margin-left: 2px;'>".$rec_det_detels[6]."</span></td>";
        echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[7]."</span></td>";
        echo "<td style='width:80px;text-align: left;".$MyRow ."'><span style='margin-left: 2px;'>".$rec_det_detels[8]."</span></td>";
        echo "<td style='width:80px;text-align: right;".$MyRow ."' title = '".$asingBy."'><span style='margin-right: 2px;'>".$rec_det_detels[9]."</span></td>";
        echo "<td style='width:50px;'><input type='button' class='buttonManage' id='btn_Validate' name='btn_Validate' value='...' title='txta".$index."' onclick='clientValidate(title);'/></td>";
        echo "</tr>";
    }
?>
</table>
</span>
<div style="display: none;">
    <input type="text" name="txt_helpdeskadmin" id="txt_helpdeskadmin" value="<?php echo  $_SESSION['helpdeskadmin']; ?>" />
    <input type="text" name="txt_helpdesk_close" id="txt_helpdesk_close" value="<?php echo  $_SESSION['helpdesk_close']; ?>" />
    <input type="text" name="txt_USERgROUP" id="txt_USERgROUP" value="<?php echo  $_SESSION['usergroupNumber']; ?>" />
</div>
<?php
    if(isset($_POST['btnReq']) && $_POST['btnReq']=='Submit'){
        mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            if(trim($_POST['get_help_ID']) != "" && trim($_POST['txtarea_Resulution']) != "" && trim($_POST['txtarea_Solution']) != ""){
                //$getmail = 0;
                $getStateList = isServiceRequsetListInsert(trim($_POST['get_help_ID']),trim($_POST['txtarea_Resulution']),trim($_POST['txtarea_Solution']),$_SESSION['user']);	
                
                $sql_email = "SELECT `email` FROM `user` WHERE `userName` = '".trim($_POST['get_help_Ent'])."';";
                $que_email = mysqli_query($conn,$sql_email);
                if(mysqli_num_rows($que_email) > 0){
					while($RES_email = mysqli_fetch_assoc($que_email)){
                    	$getmail = $RES_email['email'];
                	}
                    $title = "CDB Help Desk : Solved Issue";
                    //$mail = "Your service request << ".trim($_POST['get_help_ID'])." >> - <<".trim($_POST['get_help_Iss']).">> States changed to solved. Please check and confirm to close the job. \nCDB SmartOps --> Help Desk -- >Service Request Acknowledge";
                    //sendMail($getmail,$title,$mail);
                    $mail = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<table border='1'>
	<tr>
        <td style='width:200px; text-align:left; padding-left:5px'>New Service Request</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".trim($_POST['get_help_ID'])."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Issue</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".trim($_POST['get_help_Iss'])."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Solution</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".trim($_POST['txtarea_Solution'])."</td>
    </tr>
 </table><br/>
 States changed to solved. Please check and confirm to close the job.<br/>
 CDB SmartOps --> Help Desk -- >Service Request Acknowledge
 
</body>
</html>";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		
						// More headers
                        $headers .= 'From: <cdberp@cdbnet.lk>' . "\r\n";
                //sendMail($getmail,$title,$mail,$headers);    
                sendMailNuw($getmail,$title,$mail,$headers); 
                }
                if($getStateList == 1){
                    echo "<script> alert('Issue  solved.');
                              pageClose();
        			     </script>";	
                    mysqli_commit($conn);
                }else{
                    echo "<script> alert('Some Values Not Update.');</script>";  
                }
            }else{
                echo "<script> alert('Some Values are missing.');</script>";  
            }
            
        }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
        }
    }
    
    if(isset($_POST['btnUpdate']) && $_POST['btnUpdate']=='Update'){
        mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            $sql_update_asing = "UPDATE `cdb_helpdesk` SET `asing_by`= '".trim($_POST['txt_inner_User1'])."' WHERE `helpid` = '".trim($_POST['txt_help_ID'])."';";
            $que_update_asing = mysqli_query($conn,$sql_update_asing) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
            isHelpDeskHistory(trim($_POST['txt_help_ID'])); // Helpdesk History
            //$v_delete_note = "DELETE FROM `cdb_help_note` WHERE `helpid` = '".trim($_POST['txt_help_ID'])."';";
            //$que_delete_note = mysqli_query($conn,$v_delete_note) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
            for($y = 1 ; $y <= trim($_POST['row_COUNT']) ; $y++){
                if(trim($_POST['txtb'.$y])!= ""){
                    if(trim($_POST['txt_c_n'.$y] == 1)){
                        $v_getSQL_Note =  "INSERT INTO `cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`) VALUES ('".trim($_POST['txt_help_ID'])."','".$y."','".trim($_POST['txtb'.$y])."','".$_SESSION['user']."',now());";
                        $que_getSQL_Note = mysqli_query($conn,$v_getSQL_Note) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
                    }                 
                 }
            }
                if(time($_POST['txt_UserGetMail']) != ""){
                    $sql_emailEnter = "SELECT `email` FROM `user` WHERE `userName` = '".trim($_POST['txt_UserGetMail'])."';";
                    $que_emailEnter = mysqli_query($conn,$sql_emailEnter);
                    if(mysqli_num_rows($que_emailEnter) > 0){
        			    while($RES_emailEnter = mysqli_fetch_assoc($que_emailEnter)){
           	                $getmailEnter = $RES_emailEnter['email'];
           	            }
                        $title1 = "CDB Help Desk : Service Request - Notes";
                        date_default_timezone_set('Asia/Colombo');
                        $mail1 = "<html>
                                    <head>
                                    <title>HTML email</title>
                                    </head>
                                    <body>
                                    <h3>CDB Help Desk : Service Request - Notes</h3>
                                    <table border='1'>
                                    	<tr>
                                            <td style='width:200px; text-align:left; padding-left:5px'>Service Request - Add Note</td>
                                            <td style='width:400px; text-align:left; padding-left:5px'>".trim($_POST['txt_help_ID'])."</td>
                                        </tr>
                                        <tr>
                                            <td style='width:200px; text-align:left; padding-left:5px'>Issue</td>
                                            <td style='width:400px; text-align:left; padding-left:5px'>".trim($_POST['txt_issue'])."</td>
                                        </tr>
                                     </table>
                                     </hr>
                                     <br/>
                                     Date : ".date('Y-m-d h:i:s')."
                                     <br/>
                                     <table border='1'>
                                     <tr>
                                        <td style='width:50px; text-align:right; padding-right:5px'>#</td>
                                        <td style='width:400px; text-align:left; padding-left:5px'>Notes</td>
                                        <td style='width:100px; text-align:left; padding-left:5px'>Enterd User</td>
                                        <td style='width:150px; text-align:left; padding-left:5px'>Enterd On</td>
                                     </tr>
                                     ";
                                        for($t = 1 ; $t <= trim($_POST['row_COUNT']) ; $t++){
                                                if(trim($_POST['txt_c_n'.$t] == 0)){
                                                  $mail1 .=  "<tr>
                                                                <td style='width:50px; text-align:right; padding-right:5px'>".$t."</td>
                                                                <td style='width:400px; text-align:left; padding-left:5px'>".trim($_POST['txtb'.$t])."</td>
                                                                <td style='width:100px; text-align:left; padding-left:5px'>".trim($_POST['txtUse'.$t])."</td>
                                                                <td style='width:150px; text-align:left; padding-left:5px'>".trim($_POST['txtOn'.$t])."</td>
                                                            </tr> ";
                                                }else if(trim($_POST['txt_c_n'.$t] == 1)){
                                                  $mail1 .=  "<tr>
                                                                <td style='width:50px; text-align:right; padding-right:5px'>".$t."</td>
                                                                <td style='width:400px; text-align:left; padding-left:5px'>".trim($_POST['txtb'.$t])."</td>
                                                                <td style='width:100px; text-align:left; padding-left:5px'>".$_SESSION['user']."</td>
                                                                <td style='width:150px; text-align:left; padding-left:5px'>".date('Y-m-d h:i:s')."</td>
                                                            </tr> ";
                                                }else{
                                                    
                                                }
                                        }
                                        
                                     $mail1 .= "</table>
                                    </body>
                                    </html>";
                                      $headers1 = "MIME-Version: 1.0" . "\r\n";
                                    $headers1 .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    		
                    						// More headers
                                    $headers1 .= 'From: <cdberp@cdbnet.lk>' . "\r\n";
                                    //sendMail($getmail,$title,$mail,$headers);    
                                    sendMailNuw($getmailEnter,$title1,$mail1,$headers1);
                    }
                }
                if(trim($_POST['txt_inner_User1'])!= $_SESSION['user']){
                                $sql_email = "SELECT `email` FROM `user` WHERE `userName` = '".trim($_POST['txt_inner_User1'])."';";
                                $que_email = mysqli_query($conn,$sql_email);
                                if(mysqli_num_rows($que_email) > 0){
                    			    while($RES_email = mysqli_fetch_assoc($que_email)){
                       	                $getmail = $RES_email['email'];
                       	            }
                                    $sql_bandD = "SELECT `branch`.`branchName`,`deparment`.`deparmentName`
                                                    FROM `cdb_helpdesk`,`branch`,`deparment`
                                                    WHERE `cdb_helpdesk`.`entry_branch` = `branch`.`branchNumber`
                                                    AND `cdb_helpdesk`.`entry_department` = `deparment`.`deparmentNumber`
                                                    AND `cdb_helpdesk`.`helpid` = '".trim($_POST['txt_help_ID'])."';";
                                    $que_bandD = mysqli_query($conn,$sql_bandD);
                                    while($RES_bandD = mysqli_fetch_array($que_bandD)){
                       	                $ebranchName = $RES_bandD[0];
                                        $eDepartmnet = $RES_bandD[1];
                       	            }
                                    $title = "CDB Help Desk : New service request";
                                    //$mail = "New Service Request : ".trim($_POST['txt_help_ID'])."<<".trim($_POST['txt_issue']).">>\n\n";
                                   /* $mail .= "Branch :".$_SESSION['userBranchName']."\\n\\n";
                                    $mail .= "Department :".$getUBranch;*/
                                    $mail = "
                    <html>
                    <head>
                    <title>HTML email</title>
                    </head>
                    <body>
                    <table border='1'>
                    	<tr>
                            <td style='width:200px; text-align:left; padding-left:5px'>New Service Request</td>
                            <td style='width:400px; text-align:left; padding-left:5px'>".trim($_POST['txt_help_ID'])."</td>
                        </tr>
                        <tr>
                            <td style='width:200px; text-align:left; padding-left:5px'>Issue</td>
                            <td style='width:400px; text-align:left; padding-left:5px'>".trim($_POST['txt_issue'])."</td>
                        </tr>
                        <tr>
                            <td style='width:200px; text-align:left; padding-left:5px'>From Branch </td>
                            <td style='width:400px; text-align:left; padding-left:5px'>".$ebranchName."</td>
                        </tr>
                        <tr>
                            <td style='width:200px; text-align:left; padding-left:5px'>From Department</td>
                            <td style='width:400px; text-align:left; padding-left:5px'>".$eDepartmnet."</td>
                        </tr>
                     </table>
                    </body>
                    </html>";
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    		
                    						// More headers
                                            $headers .= 'From: <cdberp@cdbnet.lk>' . "\r\n";
                                    //sendMail($getmail,$title,$mail,$headers);    
                                    sendMailNuw($getmail,$title,$mail,$headers); 
                }
            }
            mysqli_commit($conn);
            echo "<script> alert('Update Successful');</script>";
             
        }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
        }
    }
?>
<!-- ****************************************************************************************************************************************************** -->
<span id="getGried"></span>
</form>
</body>
</html>
