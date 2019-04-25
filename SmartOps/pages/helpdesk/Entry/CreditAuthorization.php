<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: Credit Authorization
Purpose			: To authorization for Credit Role
Author			: Madushan Wikramaarachchi
Date & Time		: 02:30 A.M 19/02/2018
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/e/037";
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
<title>User Transfer Request</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../helpdesk_DEVELOPMENT/CSS/helpdesk_Style_Sheet.css"/>
    <link rel="stylesheet" href="jquery/jquery-ui.css" />
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../helpdesk_DEVELOPMENT/JAVASCRIPT_FUNCTION/helpdesk_js_function.js"></script>
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<!--END Common fumction Libariries-->

<script type="text/javascript"> 
//JAVASCRIPT FUNCTION START............................................................................................................................
function pageClose(){ //Page Close Function.......
	parent.location.href = parent.location.href;
    
}
function pageRef(){
   window.open('http://cdberp:8080/cdb/pages/helpdesk/Entry/CreditAuthorization.php?DispName=Credit%20Role%20Authorization','conectpage');
}

function isApprove(title){
    //alert('app'+title);
    var authUser = document.getElementById('logUser').value;
   // alert(authUser);
    var r = confirm('Are you sure you want to Approve this?')
    if (r==true){
        $.ajax({ 
        	type:'POST', 
        	data: {get_AR_user_aprove : title , get_AR_ath_aprove : authUser}, 
        	url: '../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_php_function.php', 
        	success: function(val_retn) { 
        	    alert(val_retn);
                pageRef();
                  
        	}
        });
    }
}

function isReject(title){
    //alert('rec'+title);
    var authUser = document.getElementById('logUser').value;
    //alert(authUser);
     var r = confirm('Are you sure you want to Reject this?')
    if (r==true){
        $.ajax({ 
        	type:'POST', 
        	data: {get_AR_user_reject : title , get_AR_ath_reject : authUser}, 
        	url: '../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_php_function.php', 
        	success: function(val_retn) { 
        	    alert(val_retn);
                pageRef();
                  
        	}
        });
    }
}

//JAVASCRIPT FUNCTION END............................................................................................................................
</script>
</head>
<body oncontextmenu="return false" onkeydown="keyEvent(event)" onkeyup="metaKeyUp(event)">
<form action="" method="post" name="schform" enctype="multipart/form-data"> 
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<span id="maneSpan">
<label class="linetop" style="margin-left: 80px; font-weight: bold;"><?php echo $_SESSION['user']." - ".$_SESSION['userID']; ?> </label><br /><br />
<div style='display: none;'>
    <input type='text' name='logUser' id='logUser' value='<?php echo $_SESSION['user']; ?>' onkeypress='return disableEnterKey(event)'/> 
</div>
<table border="1" cellpadding="0" cellspacing="0" id="myTable" style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
    <tr style="background-color: #BEBABA;">
        <td style="width:70px; text-align: right;"><span style="margin-right: 5px;">User ID</span></td>
        <td style="width:200px; text-align: left;"><span style="margin-left: 5px;">User Name</span></td>
        <td style="width:150px; text-align: left;"><span style="margin-left: 5px;">User Branch</span></td>
        <td style="width:140px;text-align: left;"><span  style="margin-left: 5px;">Currant Role</span></td>
        <td style="width:140px;text-align: left;"><span  style="margin-left: 5px;">Request Role</span></td>
        <td style="width:90px;text-align: right;"><span  style="margin-right: 5px;">From on</span></td>
        <td style="width:90px;text-align: right;"><span  style="margin-right: 5px;">To on</span></td>
        <td style="width:90px;text-align: right;"><span  style="margin-right: 5px;">Entry By</span></td>
        <td style="width:90px;text-align: right;"><span  style="margin-right: 5px;">Entry On</span></td>
        <td style="width:200px; text-align: left;"><span style="margin-left: 5px;">Reason</span></td>
        <td style="width:80px;"></td>
        
    </tr>
    
    <?php
        $sql_get_gried = "SELECT car.index_id, 
                                   car.user_id, 
                                   u.userID, 
                                   car.currant_user_role_dis,
                                   car.fromDateTime, 
                                   car.toDateTime,
                                   cr.role_dis , 
                                   car.reason, 
                                   car.done_by, 
                                   car.done_on ,
                                   (select brn.branchName from branch brn where brn.branchNumber = car.br_code) as curbrnname
                            FROM cdb_acting_user_role AS car , user AS u , cdb_acting_roles AS cr
                            WHERE car.user_id = u.userName AND
                                  car.req_user_role = cr.role_id AND
                                  car.req_user_role IN ('SAIOFF')  AND
                                  car.auth_by = '' AND
                                  car.auth_on = '0000-00-00 00:00:00' AND
                                  car.status = 0;";
        $que_get_gried = mysqli_query($conn , $sql_get_gried);
        if(mysqli_num_rows($que_get_gried) != 0){
            while($rec_get_gried = mysqli_fetch_array($que_get_gried)){
                //echo $rec_get_gried[2];
               echo "<tr>";
               echo "<td style='width:70px; text-align: right;'><span style='margin-right: 5px;'>".$rec_get_gried[1]."</span></td>";
               echo "<td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$rec_get_gried[2]."</span></td>";
                echo "<td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$rec_get_gried[10]."</span></td>";
               echo "<td style='width:140px;text-align: left;'><span  style='margin-left: 5px;'>".$rec_get_gried[3]."</span></td>";
               echo "<td style='width:140px;text-align: left;'><span  style='margin-left: 5px;'>".$rec_get_gried[6]."</span></td>";
               echo "<td style='width:90px;text-align: right;'><span  style='margin-right: 5px;'>".$rec_get_gried[4]."</span></td>";
               echo "<td style='width:90px;text-align: right;'><span style='margin-right: 5px;'>".$rec_get_gried[5]."</span></td>";
               echo "<td style='width:90px;text-align: right;' title='".getUserDtl($rec_get_gried[8],$conn)."'><span  style='margin-right: 5px;'>".$rec_get_gried[8]."</span></td>";
               echo "<td style='width:90px;text-align: right;'><span style='margin-right: 5px;'>".$rec_get_gried[9]."</span></td>";
               echo "<td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$rec_get_gried[7]."</span></td>";
               echo "<td style='width:80px;'>
               <img src='../../../img/ok.png' style='border: solid 1px #000000; margin-top:3px;' title='".$rec_get_gried[0]."' onclick='isApprove(title);' />&nbsp;&nbsp;
               <img src='../../../img/dele.png' style='border: solid 1px #000000; margin-top:3px;' title='".$rec_get_gried[0]."' onclick='isReject(title);' />&nbsp;&nbsp;
               </td>";
               echo "</tr>"; 
            }
        }else{
            echo "<tr>
                    <td style='width:70px;'>&nbsp;</td>
                    <td style='width:200px;'>&nbsp;</td>
                    <td style='width:150px;'>&nbsp;</td>
                    <td style='width:140px;'>&nbsp;</td>
                    <td style='width:140px;'>&nbsp;</td>
                    <td style='width:90px;'>&nbsp;</td>
                    <td style='width:90px;'>&nbsp;</td>
                    <td style='width:90px;'>&nbsp;</td>
                    <td style='width:90px;'>&nbsp;</td>
                    <td style='width:200px;'></td>
                    <td style='width:80px;'>&nbsp;</td>  
                </tr>";
        }
        
    ?>
</table>
<br /><br />
<div style="margin-left: 10px;">
    <input class="buttonManage" style="width: 100px;" type="button" id="btnUsergroupSave" name="btnUsergroupSave" onclick="pageRef();" value="Refresh"/>
    <input class="buttonManage" style="width: 100px;" type="button" id="btnUsergroupSave" name="btnUsergroupSave" onclick="pageClose();" value="Close"/>
</div>


</span>
<!-- ****************************************************************************************************************************************************** -->
<span id="getGried"></span>
<?php 
    function getUserDtl($user,$conn){
        $v_sql_getUsreNAme = "SELECT `userID` , `GSMNO` , `email` FROM `user` WHERE `userName` =  '".$user."';";
        $que_getUsreNAme = mysqli_query($conn,$v_sql_getUsreNAme);
        while($RES_getUsreNAme = mysqli_fetch_array($que_getUsreNAme)){
            return $RES_getUsreNAme[0]."\n".$RES_getUsreNAme[1]."\n".$RES_getUsreNAme[2];
        }
    }
?>
</form>
</body>
</html>
