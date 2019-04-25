<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: Help Desk User Group Management
Purpose			: To create user Group for Help Desk
Author			: Madushan Wikramaarachchi
Date & Time		: 11.55 A.M 14/01/2015
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/m/001";
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
  
</style>
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script type="text/javascript">
function pageClose(){ //Page Close Function.......
	parent.location.href = parent.location.href;
}

function getGiedCat(){
    var getcatID = document.getElementById('sel_userGroup').value;
    mydata1= new XMLHttpRequest();
    mydata1.onreadystatechange=function(){
        if(mydata1.readyState==4){
            document.getElementById('maneSpan').innerHTML=mydata1.responseText;           
        }
    }
    mydata1.open("GET","../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_Ajax.php"+"?getAthUserGroup="+getcatID,true);
    mydata1.send();
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

<table>
  <tr>
    <td style="width: 100px; text-align: right;"><label class="linetop">User Group :</label></td>
    <td>
         <select class="box_decaretion"  style="width: 200px;" name="sel_userGroup" id="sel_userGroup" onKeyPress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onchange="getGiedCat();">
            <option value="">--Select User Group --</option>
            <?php
                $v_sql_userGroup = "SELECT `usergroupNumber`, `usergroupName` FROM `usergroup`;";
                $que_userGroup = mysqli_query($conn,$v_sql_userGroup);
                while($RES_userGroup = mysqli_fetch_array($que_userGroup)){
                    echo "<option value=".$RES_userGroup[0].">".$RES_userGroup[1]."</option>";
                }
            ?>
         </select>
    </td>
  </tr>
</table>
<br /><br />
<span id="maneSpan">
<table border="1" id="myTable" style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 25px;">
            <tr style="background-color: #BEBABA;">
                <td style="width:50px; text-align: right;"><span style="margin-right: 5px;">#</span></td>
                <td style="width:100px;text-align: right;"><span style="margin-right: 5px;">Cat Code</span></td>
                <td style="width:300px;text-align: left;"><span style="margin-left: 5px;">Cat Name</span></td>
                <td style="width:50px;"></td>
            </tr>
 <?php
                $v_sql_Category = "SELECT `cat_code`,`cat_discr` FROM `cat_states`;";
                $que_Category = mysqli_query($conn,$v_sql_Category);
                $index = 0;
                while($RES_Category = mysqli_fetch_array($que_Category)){
                    $index++;
                   echo "<tr>";
                   echo "<td style='width:50px;text-align: right;'><span style='margin-right: 5px;'>".$index."</span></td>";
                   echo "<td style='width:100px;text-align: right;'><div style='display: none;'><input type='text' name='txtCatID".$index."' id='txtCatID".$index."' value='".$RES_Category[0]."'  onKeyPress='return disableEnterKey(event)'/></div><span style='margin-right: 5px;'>".$RES_Category[0]."</span></td>";
                   echo "<td style='width:300px;text-align: left;'><span style='margin-left: 5px;'>".$RES_Category[1]."</span></td>";
                   echo "<td style='width:50px;'><input type='checkbox' name='cheCat".$index."' id='cheCat".$index."'/></td>";
                   echo "</tr>";
                   
                }
 ?>         
 </table>
<div style='display:none;'><input type="text" name="txtrow" id="txtrow" value="<?php echo $index; ?>"/></div>
</span>
<br /><br />
<table>
     <tr>
        <td style="width: 20px;">&nbsp;</td>
        <td>
            <input type="submit" style="width: 100px;" class="buttonManage" id="btnUserGroup" name="btnUserGroup" value="Save" />
            <input type="button" style="width: 100px;" class="buttonManage" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
        </td>
     </tr>
</table>
<?php
    if(isset($_POST['btnUserGroup']) && $_POST['btnUserGroup']=='Save'){
        mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            if(trim($_POST['sel_userGroup']) != ""){
                isDeleteUserGroupAth(trim($_POST['sel_userGroup']),$_SESSION['user']);
                for ($i = 1; $_POST['txtrow']>= $i; $i++){	
                    if(isset($_POST['cheCat'.$i])){
                        isInsertUserGroupAth(trim($_POST['sel_userGroup']),trim($_POST['txtCatID'.$i]),$_SESSION['user']);
                    }else{
                        
                    }
                }
                 echo "<script> alert('Updateed.');
                              pageClose();
        			     </script>";
                mysqli_commit($conn);
                
            }else{
                echo "<script> alert('Select User Group.');</script>";  
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

