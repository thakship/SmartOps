<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Security Printing System
Page Name		: Re-Generate Letter List
Purpose			: Re Generate for Letter Printing Disition
Author			: Madushan Wikramaarachchi
Date & Time		: 04.00 P.M 02/02/2017
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="sps/e/006";
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
    include('../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_function.php');
	//include('ajax_Gried.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Letter Printing</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../SPS_DEVELOPMENT/SPS_Style_Sheet.css" />
<style type="text/css">
	
</style>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../SPS_DEVELOPMENT/SPS_js_function.js"></script>
<!--END Common fumction Libariries-->
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script type="text/javascript">
   function pageRef(){
     window.open('http://cdberp:8080/cdb/pages/SecurityPrintingSystem/Entry/Re-GenerateLetterList.php?DispName=Re-Generate%20Letter%20List','conectpage');
   }
   function isChangeRowColoerOver(title){
        document.getElementById('tr'+title).style.backgroundColor = "#FDEEEE";
    }
    
    function isChangeRowColoerDown(title){
        document.getElementById('tr'+title).style.backgroundColor = "#FFFFFF";
    }
    
function isApprove_ar(title){
    //alert('app'+title);
    var authUser = document.getElementById('txtMyUserID').value;
   // alert(authUser);
    var r = confirm('Are you sure you want to Approve this?')
    if (r==true){
        $.ajax({ 
        	type:'POST', 
        	data: {get_approve_reprint_facNumber : title , get_reprint_ath_aprove : authUser}, 
        	url: '../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_function.php', 
        	success: function(val_retn) { 
        	    alert(val_retn);
                pageRef();
                  
        	}
        });
    }
}

function isReject_ar(title){
    //alert('rec'+title);
    var authUser = document.getElementById('txtMyUserID').value;
    //alert(authUser);
     var r = confirm('Are you sure you want to Reject this?')
    if (r==true){
        $.ajax({ 
        	type:'POST', 
        	data: {get_reject_reprint_facNumber: title , get_reprint_ath_reject : authUser}, 
        	url: '../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_function.php', 
        	success: function(val_retn) { 
        	    alert(val_retn);
                pageRef();
                  
        	}
        });
    }
}
</script>


</head>
<body oncontextmenu="return false">
<form action="" method="post" name="schform"  enctype="multipart/form-data"> 
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<div>
<table border="1" cellpadding="0" cellspacing="0" id="myTable" style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
    <tr style="background-color: #BEBABA;">
        <td style="width:70px; text-align: right;"><span style="margin-right: 5px;">#</span></td>
        <td style="width:200px; text-align: left;"><span style="margin-left: 5px;">Facility Number</span></td>
        <td style="width:250px; text-align: left;"><span style="margin-left: 5px;">Client Name</span></td>
        <td style="width:150px; text-align: left;"><span style="margin-left: 5px;">Request By</span></td>
        <td style="width:150px; text-align: left;"><span style="margin-left: 5px;">Request On</span></td>
        <td style="width:80px;"></td>
        
    </tr>
    
    <?php
      $sql_get_gried = "SELECT sr.fac_no ,sg.client_name,sr.requestBy , u.userID ,sr.requestOn 
                            FROM sps_regenerate AS sr , sps_po_gen AS sg , user AS u
                            WHERE sr.fac_no = sg.fac_no 
                            	AND sr.requestBy = u.userName
                            	AND sr.authOn = '000-00-00 00:00:00'";
        $que_get_gried = mysqli_query($conn , $sql_get_gried);
        if(mysqli_num_rows($que_get_gried) != 0){
            $x = 1;
            while($rec_get_gried = mysqli_fetch_array($que_get_gried)){
                //echo $rec_get_gried[2];
               echo "<tr>";
               echo "<td style='width:70px; text-align: right;'><span style='margin-right: 5px;'>".$x."</span></td>";
               echo "<td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$rec_get_gried[0]."</span></td>";
                echo "<td style='width:250px; text-align: left;'><span style='margin-left: 5px;'>".$rec_get_gried[1]."</span></td>";
               echo "<td style='width:150px;text-align: left;' title='".$rec_get_gried[3]."'><span  style='margin-left: 5px;'>".$rec_get_gried[2]."</span></td>";
                echo "<td style='width:150px;text-align: left;'><span  style='margin-left: 5px;'>".$rec_get_gried[4]."</span></td>";
               echo "<td style='width:80px;'>
               <img src='../../../img/ok.png' style='border: solid 1px #000000; margin-top:3px;' title='".$rec_get_gried[0]."' onclick='isApprove_ar(title);' />&nbsp;&nbsp;
               <img src='../../../img/dele.png' style='border: solid 1px #000000; margin-top:3px;' title='".$rec_get_gried[0]."' onclick='isReject_ar(title);' />&nbsp;&nbsp;
               </td>";
               echo "</tr>"; 
            }
        }else{
            echo "<tr>
                    <td style='width:70px;'>&nbsp;</td>
                    <td style='width:200px;'>&nbsp;</td>
                    <td style='width:250px;'>&nbsp;</td>
                    <td style='width:150px;'>&nbsp;</td>
                    <td style='width:80px;'>&nbsp;</td>  
                </tr>";
        }
        
    ?>
</table>
</div>
<div style="display: none;">
    <input type="text" id="txtMyUserID" name="txtMyUserID" value="<?php echo $_SESSION['user']; ?>" onkeypress="return disableEnterKey(event)" />
    <input type="text" id="txtMyUserGroup" name="txtMyUserGroup" value="<?php echo $_SESSION['usergroupNumber']; ?>" onkeypress="return disableEnterKey(event)" />
</div>

</form>
</body>
</html>