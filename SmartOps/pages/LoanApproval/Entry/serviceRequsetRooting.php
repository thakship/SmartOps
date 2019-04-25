<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: Service Request Change root
Purpose			: To Change fro rooting Request
Author			: Madushan Wikramaarachchi
Date & Time		: 12.29 A.M 09/03/2015
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/e/006";
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
<title>Service Request Change root</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../helpdesk_DEVELOPMENT/CSS/helpdesk_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../helpdesk_DEVELOPMENT/JAVASCRIPT_FUNCTION/helpdesk_js_function.js"></script>
<!--END Common fumction Libariries-->
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script type="text/javascript">
function pageClose(){ //Page Close Function.......
	parent.location.href = parent.location.href;
}

function is_getScat_01(getID,getTitle){
    var getCat = document.getElementById(getID).value;
    var cat1 = document.getElementById('sel_catagory').value;
    var cat2 = document.getElementById('sel_scat01').value;
    var cat3 = document.getElementById('sel_scat02').value;
    if(getTitle == 1){
        var divID = 'diva';
    }
    if(getTitle == 2){
        var divID = 'divb';
    }
    if(getTitle == 3){
        var divID = 'divc';
    }
    if(getTitle == 4){
        var divID = 'divz';
    }
    if(getCat == "" &&  getTitle == 1){
        document.getElementById('sel_scat01').value = "";
        document.getElementById('sel_scat02').value = "";
        document.getElementById('sel_scat03').value = "";
        document.getElementById('sel_scat01').disabled = true; 
        document.getElementById('sel_scat02').disabled = true;
        document.getElementById('sel_scat03').disabled = true; 
    }else if(getCat == "" &&  getTitle == 2){
        document.getElementById('sel_scat02').value = "";
        document.getElementById('sel_scat02').disabled = true;
        document.getElementById('sel_scat03').value = "";
        document.getElementById('sel_scat03').disabled = true; 
    }else if(getCat == "" &&  getTitle == 3){
        document.getElementById('txt_Department').value = "";
        document.getElementById('txt_Department').disabled = true; 
    }else{
        var mydata;
        mydata= new XMLHttpRequest();
        mydata.onreadystatechange=function(){
            if(mydata.readyState==4){
                document.getElementById(divID).innerHTML=mydata.responseText;
                if(getTitle == 1){
                   document.getElementById('sel_scat02').value = "";
                   document.getElementById('sel_scat02').disabled = true; 
                    document.getElementById('sel_scat03').value = "";
                   document.getElementById('sel_scat03').disabled = true;
                } 
                if(getTitle == 2){
                    document.getElementById('sel_scat03').value = "";
                   document.getElementById('sel_scat03').disabled = true;
                }                
            }
        }
        mydata.open("GET","ajax_serviceRequset_01.php"+"?txt1="+getCat+"&txt2="+getTitle,true);
        mydata.send();
    }
    
}    

function selcect_helpID_delels(){
    var getHI = document.getElementById('txt_HelpID').value;
    var getDeletsID;
        getDeletsID = new XMLHttpRequest();
        getDeletsID.onreadystatechange=function(){
            if(getDeletsID.readyState==4){
                document.getElementById('maneSpan').innerHTML = getDeletsID.responseText;     
                if(document.getElementById('txt_retun_cou').value == 1){
                    
                }else{
                    alert('Invalid Help ID.');
                }
                
            }
        }
        getDeletsID.open("GET","ajax_serviceRequset_root.php"+"?txt_Root_Help_ID="+getHI,true);
        getDeletsID.send();
}
</script>

</head>
<body oncontextmenu="return false" onsubmit="return chak()">
<form action="" method="post" name="schform" enctype="multipart/form-data"> 
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<table>
    <tr>
        <td style="width: 100px; text-align: right;"><label class="linetop">Help ID :</label></td>
        <td style="width: 150px;">
            <input class="box_decaretion" type="text" name="txt_HelpID" id="txt_HelpID" value="" onKeyPress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" required="required" />
        </td>
        <td>
           <input type="button" style="width: 100px;" class="buttonManage" value="Select" id="btn_select" name="btn_select" onclick="selcect_helpID_delels()" />
        </td>
    </tr>
</table>
<br />
<span id="maneSpan">
    
</span>
<?php
     if(isset($_POST['btnSave']) && $_POST['btnSave']=='Update'){
        mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine  
            if(trim($_POST['txt_get_helpid']) != "" && trim($_POST['sel_catagory']) != "" && trim($_POST['sel_scat01']) != "" && trim($_POST['sel_scat02']) != "" ){
                
                $sql_deff_user = "SELECT `DefuserID` FROM `scat_02` WHERE `cat_code` = '".trim($_POST['sel_catagory'])."' AND `scat_code_1` = '".trim($_POST['sel_scat01'])."' AND  `scat_code_2` = '".trim($_POST['sel_scat02'])."';";
                $que_deff_user = mysqli_query($conn,$sql_deff_user);
                while($res_deff_user = mysqli_fetch_assoc($que_deff_user)){
                   $sql_uapadte = "UPDATE `cdb_helpdesk` SET`cat_code`='".trim($_POST['sel_catagory'])."', `scat_code_1`='".trim($_POST['sel_scat01'])."', `scat_code_2`='".trim($_POST['sel_scat02'])."', `scat_code_3`='".trim($_POST['sel_scat03'])."', `asing_by`='".$res_deff_user['DefuserID']."'  WHERE `helpid` = '".trim($_POST['txt_get_helpid'])."';";
                   //echo $sql_uapadte;
                   isHelpDeskHistory(trim($_POST['txt_get_helpid']));
                   $que_upadate = mysqli_query($conn, $sql_uapadte) or die(mysqli_error($conn));
                   mysqli_commit($conn);
                    $sql_email = "SELECT `email` FROM `user` WHERE `userName`='".$res_deff_user['DefuserID']."';";
                    $que_email = mysqli_query($conn,$sql_email);
                    if(mysqli_num_rows($que_email) != 0){
                        while($res_email = mysqli_fetch_assoc($que_email)){
                            $getmail = $res_email['email'];
                            //echo $getmail;
                            $title = "CDB Help Desk : New service request";
                            $mail = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<table border='1'>
	<tr>
        <td style='width:200px; text-align:left; padding-left:5px'>New Service Request</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".trim($_POST['txt_get_helpid'])."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Issue</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".trim($_POST['txt_get_issue'])."</td>
    </tr>
     <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>From (User)</td> 
        <td style='width:400px; text-align:left; padding-left:5px'>".trim($_POST['txt_get_enterBy'])."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>&nbsp;</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".trim($_POST['txt_get_enterdis'])."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Branch</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".trim($_POST['txt_get_branch'])."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Department</td> 
        <td style='width:400px; text-align:left; padding-left:5px'>".trim($_POST['txt_get_department'])."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>User IP</td> 
        <td style='width:400px; text-align:left; padding-left:5px'>".trim($_POST['txt_get_IP'])."</td>
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
                }
                
                
                $stringMessage = "Service request Update. \\n\\n SR Number : ".trim($_POST['txt_get_helpid']);
                echo "<script> alert('". $stringMessage ."');pageClose();</script>";
            }else{
                echo "<script> alert('Some Values are missing.');</script>";  
            }
            
        }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
        }
    }
?>
</form>
</body>
</html>