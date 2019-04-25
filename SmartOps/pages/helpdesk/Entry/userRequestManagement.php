<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: User Request Management
Purpose			: To manag to User request barnch and changing user role
Author			: Madushan Wikramaarachchi
Date & Time		: 10.19 A.M 29/03/2016
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/e/020";
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
   window.open('http://cdberp:8080/cdb/pages/helpdesk/Entry/userRequestManagement.php?DispName=User%20Request%20Management','conectpage');
}

function isApprove_ar(title){
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

function isReject_ar(title){
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

function isApprove_tr(title){
    //alert('app'+title);
    var authUser = document.getElementById('logUser').value;
   // alert(authUser);
    var r = confirm('Are you sure you want to Approve this?')
    if (r==true){
        $.ajax({ 
        	type:'POST', 
        	data: {get_tran_user_aprove : title , get_tran_ath_aprove : authUser}, 
        	url: '../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_php_function.php', 
        	success: function(val_retn) { 
        	    alert(val_retn);
                pageRef();
                  
        	}
        });
    }
}

function isReject_tr(title){
    //alert('rec'+title);
    var authUser = document.getElementById('logUser').value;
    //alert(authUser);
     var r = confirm('Are you sure you want to Reject this?')
    if (r==true){
        $.ajax({ 
        	type:'POST', 
        	data: {get_tran_user_reject : title , get_tran_ath_reject : authUser}, 
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
<?php  	echo $_REQUEST['DispName']; ?> 
</p><hr/>
<span id="maneSpan">
<!--<label class="linetop" style="margin-left: 80px; font-weight: bold;"><?php echo $_SESSION['user']." - ".$_SESSION['userID']; ?> </label><br /><br />!-->

<div style='display: none;'>
    <input type='text' name='logUser' id='logUser' value='<?php echo $_SESSION['user']; ?>' onkeypress='return disableEnterKey(event)'/> 
</div>


<p style="margin: 5px; text-decoration: underline;">Acting User Role Requests</p>
<table border="1" cellpadding="0" cellspacing="0" id="myTable" style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
    <tr style="background-color: #BEBABA;">
        <td style="width:70px; text-align: right;"><span style="margin-right: 5px;">User ID</span></td>
        <td style="width:200px; text-align: left;"><span style="margin-left: 5px;">User Name</span></td>
        <td style="width:140px;text-align: left;"><span  style="margin-left: 5px;">Current Role</span></td>
        <td style="width:140px;text-align: left;"><span  style="margin-left: 5px;">Requested Role</span></td>
        <td style="width:90px;text-align: right;"><span  style="margin-right: 5px;">Effective Date</span></td>
        <td style="width:90px;text-align: right;"><span  style="margin-right: 5px;">Effective Time</span></td>
        <td style="width:90px;text-align: right;"><span  style="margin-right: 5px;">Entered By</span></td>
        <td style="width:90px;text-align: right;"><span  style="margin-right: 5px;">Entered On</span></td>
        <td style="width:200px; text-align: left;"><span style="margin-left: 5px;">Reason</span></td>
        <td style="width:100px; text-align: left;"><span style="margin-left: 5px;">Status</span></td>
    </tr>
    
    <?php
        $sql_get_gried = "SELECT car.index_id, 
       car.user_id, 
       ud.userID, 
       car.currant_user_role_dis,
       car.fromDateTime, 
       car.toDateTime,
       cr.role_dis , 
       car.reason, 
       car.done_by, 
       car.done_on,
       'Pending' as AuthType
FROM cdb_acting_user_role AS car , user AS u , cdb_acting_roles AS cr, branch brn, user AS ud
WHERE car.done_by = u.userName
  AND car.user_id = ud.userName
  AND car.req_user_role = cr.role_id 
  AND car.auth_by = '' 
  AND car.auth_on = '0000-00-00 00:00:00' 
  AND brn.branchNumber = u.branchNumber 
  AND car.br_code = brn.br_code 
  AND car.status = 0 
  AND u.userName = '".$_SESSION['user']."' /*car.done_by*/
union all      
SELECT car.index_id, 
       car.user_id, 
       ud.userID, 
       car.currant_user_role_dis,
       car.fromDateTime, 
       car.toDateTime,
       cr.role_dis , 
       car.reason, 
       car.done_by, 
       car.done_on,
       car.auth_type
FROM cdb_acting_user_role AS car , user AS u , cdb_acting_roles AS cr, branch brn,user AS ud
WHERE car.done_by = u.userName
  AND car.user_id = ud.userName
  AND car.req_user_role = cr.role_id 
  AND car.auth_by <> '' 
  AND date(car.auth_on) = date(now())
  AND brn.branchNumber = u.branchNumber 
  AND car.br_code = brn.br_code 
  AND car.status > 0 
  AND u.userName = '".$_SESSION['user']."';"; /*car.done_by*/
        $que_get_gried = mysqli_query($conn , $sql_get_gried);
        if(mysqli_num_rows($que_get_gried) != 0){
            while($rec_get_gried = mysqli_fetch_array($que_get_gried)){
                //echo $rec_get_gried[2];
               echo "<tr>";
               echo "<td style='width:70px; text-align: right;'><span style='margin-right: 5px;'>".$rec_get_gried[1]."</span></td>";
               echo "<td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$rec_get_gried[2]."</span></td>";
               echo "<td style='width:140px;text-align: left;'><span  style='margin-left: 5px;'>".$rec_get_gried[3]."</span></td>";
               echo "<td style='width:140px;text-align: left;'><span  style='margin-left: 5px;'>".$rec_get_gried[6]."</span></td>";
               echo "<td style='width:90px;text-align: right;'><span  style='margin-right: 5px;'>".$rec_get_gried[4]."</span></td>";
               echo "<td style='width:90px;text-align: right;'><span style='margin-right: 5px;'>".$rec_get_gried[5]."</span></td>";
               echo "<td style='width:90px;text-align: right;' title='".getUserDtl($rec_get_gried[8],$conn)."'><span  style='margin-right: 5px;'>".$rec_get_gried[8]."</span></td>";
               echo "<td style='width:90px;text-align: right;'><span style='margin-right: 5px;'>".$rec_get_gried[9]."</span></td>";
               echo "<td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$rec_get_gried[7]."</span></td>";
                echo "<td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$rec_get_gried[10]."</span></td>";
               echo "</tr>"; 
            }
        }else{
            echo "<tr>
                    <td style='width:70px;'>&nbsp;</td>
                    <td style='width:200px;'>&nbsp;</td>
                    <td style='width:140px;'>&nbsp;</td>
                    <td style='width:140px;'>&nbsp;</td>
                    <td style='width:90px;'>&nbsp;</td>
                    <td style='width:90px;'>&nbsp;</td>
                    <td style='width:90px;'>&nbsp;</td>
                    <td style='width:90px;'>&nbsp;</td>
                    <td style='width:200px;'></td> 
                    <td style='width:100px;'></td> 
                </tr>";
        }
        
    ?>
</table>
<br /><br />
<hr />
<span id="maneSpan_1">
<p style="margin: 5px; text-decoration: underline;">Branch Transfer Requests</p>
<table border="1" cellpadding="0" cellspacing="0" id="myTable" style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
    <tr style="background-color: #BEBABA;">
        <td style="width:70px;  text-align: right;"><span style="margin-right: 5px;">User ID</span></td>
        <td style="width:200px; text-align: left;"> <span style="margin-left: 5px;"> User Name</span></td>
        <td style="width:140px; text-align: left;"> <span style="margin-left: 5px;"> From Branch</span></td>
        <td style="width:140px; text-align: left;"> <span style="margin-left: 5px;"> To Branch</span></td>
        <td style="width:90px;  text-align: right;"><span style="margin-right: 5px;">Effective Date</span></td>
        <td style="width:90px;  text-align: right;"><span style="margin-right: 5px;">Effective Time</span></td>
        <td style="width:90px;  text-align: right;"><span style="margin-right: 5px;">Entered By</span></td>
        <td style="width:90px;  text-align: right;"><span style="margin-right: 5px;">Entered On</span></td>
        <td style="width:200px; text-align: left;"> <span style="margin-left: 5px;">Reason</span></td>
        <td style="width:200px; text-align: left;"> <span style="margin-left: 5px;">Status</span></td>   
    </tr>
    
    <?php
       /* $sql_get_gried = "SELECT cut.user_id ,
       u.userID, 
       cut.from_branch , 
       cut.to_branch,  
       DATE(cut.dateTime) , 
       TIME(cut.dateTime) , 
       cut.done_by , 
       cut.done_on , 
       cut.reason,
       cut.index_id,
       'Pending' AS AUTHTYPE
FROM cdb_user_transfer AS cut , user AS u , branch AS brn
WHERE	cut.user_id = u.userName AND
      brn.branchNumber = u.branchNumber AND 
      cut.from_branch = brn.br_code AND
		cut.auth_by = '' AND
		cut.auth_on = '0000-00-00 00:00:00' AND
		cut.status = 0 AND 
      u.userName = '".$_SESSION['user']."'
union all
SELECT cut.user_id ,
       u.userID, 
       cut.from_branch , 
       cut.to_branch,  
       DATE(cut.dateTime) , 
       TIME(cut.dateTime) , 
       cut.done_by , 
       cut.done_on , 
       cut.reason,
       cut.index_id,
       cut.auth_type
FROM cdb_user_transfer AS cut , user AS u , branch AS brn
WHERE	cut.user_id = u.userName AND
      brn.branchNumber = u.branchNumber AND 
      cut.from_branch = brn.br_code AND
			cut.auth_by <> '' AND
			date(cut.auth_on) = date(now()) AND
			cut.status > 0 AND 
      u.userName = '".$_SESSION['user']."';";*/
      $sql_get_gried = "SELECT cut.user_id ,
       u.userID, 
        brn2.branchName ,
       brn1.branchName ,  
       DATE(cut.dateTime) , 
       TIME(cut.dateTime) , 
       cut.done_by , 
       cut.done_on , 
       cut.reason,
       cut.index_id,
       'Pending' AS AUTHTYPE
FROM cdb_user_transfer AS cut , user AS u  , branch AS brn1 , branch AS brn2
WHERE	cut.user_id = u.userName AND
      cut.to_branch = brn1.br_code AND
      cut.from_branch = brn2.br_code AND
		cut.auth_by = '' AND
		cut.auth_on = '0000-00-00 00:00:00' AND
	   cut.status = 0 AND 
      u.userName = '".$_SESSION['user']."'
union all
SELECT cut.user_id ,
       u.userID, 
        brn2.branchName , 
        brn1.branchName,  
       DATE(cut.dateTime) , 
       TIME(cut.dateTime) , 
       cut.done_by , 
       cut.done_on , 
       cut.reason,
       cut.index_id,
       cut.auth_type
FROM cdb_user_transfer AS cut , user AS u  , branch AS brn1 , branch AS brn2
WHERE	cut.user_id = u.userName AND
      cut.to_branch = brn1.br_code AND
      cut.from_branch = brn2.br_code AND
			cut.auth_by <> '' AND
			date(cut.auth_on) = date(now()) AND
			cut.status > 0 AND 
      u.userName = '".$_SESSION['user']."';";
        $que_get_gried = mysqli_query($conn , $sql_get_gried);
        if(mysqli_num_rows($que_get_gried) != 0){
            $getFromBranch = "Un - Difind Branch";
            $getToBranch = "Un - Difind Branch";
            while($rec_get_gried = mysqli_fetch_array($que_get_gried)){
                //echo $rec_get_gried[2];
               $fromBranch = getBranchName($rec_get_gried[2],$conn);
               //echo $fromBranch;
               if($fromBranch == 'NOT'){
                  $getFromBranch = getDepartmentName($rec_get_gried[2],$conn);
               }else{
                    $getFromBranch = $fromBranch;
               }
               
               $toBranch = getBranchName($rec_get_gried[3],$conn);
               if($toBranch == 'NOT'){
                  $getToBranch = getDepartmentName($rec_get_gried[3],$conn);
               }else{
                    $getToBranch = $toBranch;
               }
               echo "<tr>";
               echo "<td style='width:70px; text-align: right;'><span style='margin-right: 5px;'>".$rec_get_gried[0]."</span></td>";
               echo "<td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$rec_get_gried[1]."</span></td>";
               echo "<td style='width:140px;text-align: left;'><span  style='margin-left: 5px;'>".$rec_get_gried[2]."</span></td>";
               echo "<td style='width:140px;text-align: left;'><span  style='margin-left: 5px;'>".$rec_get_gried[3]."</span></td>";
               echo "<td style='width:90px;text-align: right;'><span  style='margin-right: 5px;'>".$rec_get_gried[4]."</span></td>";
               echo "<td style='width:90px;text-align: right;'><span style='margin-right: 5px;'>".$rec_get_gried[5]."</span></td>";
               echo "<td style='width:90px;text-align: right;' title='".getUserDtl($rec_get_gried[6],$conn)."'><span  style='margin-right: 5px;'>".$rec_get_gried[6]."</span></td>";
               echo "<td style='width:90px;text-align: right;'><span style='margin-right: 5px;'>".$rec_get_gried[7]."</span></td>";
               echo "<td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$rec_get_gried[8]."</span></td>";
               echo "<td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$rec_get_gried[10]."</span></td>";
               echo "</tr>"; 
            }
        }else{
            echo "<tr>
                    <td style='width:70px;'>&nbsp;</td>
                    <td style='width:200px;'>&nbsp;</td>
                    <td style='width:140px;'>&nbsp;</td>
                    <td style='width:140px;'>&nbsp;</td>
                    <td style='width:90px;'>&nbsp;</td>
                    <td style='width:90px;'>&nbsp;</td>
                    <td style='width:90px;'>&nbsp;</td>
                    <td style='width:90px;'>&nbsp;</td>
                    <td style='width:200px;'>&nbsp;</td>
                    <td style='width:100px;'>&nbsp;</td>  
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
     function getBranchName($br_code,$conn){
        $sql_branch = "SELECT b.branchName FROM branch AS b WHERE b.br_code = '".$br_code."';";
        $que_branch = mysqli_query($conn,$sql_branch);
        if(mysqli_num_rows($que_branch) == 0){
            return 'NOT';
        }else{
            while($rec_branch = mysqli_fetch_array($que_branch)){
                return $rec_branch[0];
            }
        }
    } 
    function getDepartmentName($br_code,$conn){
        $sql_dep = "SELECT d.deparmentName FROM deparment d WHERE d.br_code = '".$br_code."' AND d.br_code != 0 ;";
        $que_dep = mysqli_query($conn,$sql_dep);
        if(mysqli_num_rows($que_dep) == 0){
            return 'NOT';
        }else{
            while($rec_dep = mysqli_fetch_array($que_dep)){
                return $rec_dep[0];
            }
        }
    } 
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
