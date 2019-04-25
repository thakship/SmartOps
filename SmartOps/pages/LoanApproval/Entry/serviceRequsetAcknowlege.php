<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: Service Request Acknowledge
Purpose			: do Service Request Acknowledgement
Author			: Madushan Wikramaarachchi
Date & Time		: 02.25 P.M 16/01/2015
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/e/004";
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
<title>Service Request Acknowledge</title>
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
function isSubmitAct(title){
    var [m,n,b]= title.split('|');
    var m1 = [m];
    var n1 = [n];
    var b1 = [b];
    var gethID = document.getElementById(m1).value;
    var getrmk = document.getElementById(n1).value;
    var getUser = document.getElementById('txtuser').value;
     var getsco= document.getElementById(b1).value;
    var r = confirm('Are you sure you want to Submit this?')
    if (r==true){
		$.ajax({ 
			type:'POST', 
			data: {atchid : gethID , atcgetrmk : getrmk, atcUsre : getUser, actSco : getsco}, 
			url: '../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_php_function.php', 
			success: function() { 
			 alert('updated success!'); 
             pageClose();
			}
		});	
    }else{
		//alert('BBBBB');		
	}
    //alert(gethID);
    //alert(getrmk);
}

function isReOpen(title){
    //alert(title);
    var [m,n,b]= title.split('|');
    var m1 = [m];
    var n1 = [n];
    var b1 = [b];
    var gethID1 = document.getElementById(m1).value;
    var getrmk1 = document.getElementById(n1).value;
    var getUser1 = document.getElementById('txtuser').value;
    var getsco1= document.getElementById(b1).value;
    //var SolvedByID = document.getElementById('span_id').innerHTML;
   var r = confirm('Are you sure you want to Re-open this?')
    if (r==true){
		$.ajax({ 
			type:'POST', 
			data: {atchid1 : gethID1 , atcgetrmk1 : getrmk1, atcUsre1 : getUser1, actSco1 : getsco1}, 
			url: '../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_php_function.php', 
			success: function() { 
			 //document.getElementById('maneSpan').innerHTML = data;
			 alert('updated success!'); 
             pageClose();
			}
		});	
    }else{
		//alert('BBBBB');		
	}
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
<table border="1" id="myTable" style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
            <tr style="background-color: #BEBABA;">
                <td style="width:60px;"><span style="margin-right: 5px;">Help ID</span></td>
                <td style="width:80px;"><span style="margin-right: 5px;">Entry Date</span></td>
                <td style="width:250px;"><span  style="margin-left: 5px;">Issue</span></td>
                 <td style="width:80px;"><span style="margin-right: 5px;">solved Date</span></td>
                <td style="width:80px;"><span style="margin-right: 5px;">solved by</span></td>
                <td style="width:250px;"><span style="margin-right: 5px;">Remark</span></td>
                <td style="width:60px;"></td>
                <td style="width:150px;"></td>
            </tr>
<?php
    $v_sql_select = "SELECT `helpid`,`issue`, DATE(`enterDateTime`) AS enDate, `solved_by`, DATE(`solved_on`) AS svDate FROM `cdb_helpdesk` WHERE  `cdb_helpdesk`.`cmb_code` = '5002' AND `cdb_helpdesk`.`cat_code` != '1014' AND `cdb_helpdesk`.`entry_branch` = '".$_SESSION['userBranch']."' AND `cdb_helpdesk`.`entry_department` = '".$_SESSION['userDepartment']."';";
    $v_que_select = mysqli_query($conn,$v_sql_select);
    $index = 0;
    
    while($res_Select = mysqli_fetch_assoc($v_que_select)){
        $index++;
        $getuserName = "";
        if($index%2 == 1){
            $col = "#FFFFFF";
        }else{
             $col = "#FFFFFF";
        }
        $sql_userName = "SELECT `userID` FROM `user` WHERE `userName` = '".$res_Select['solved_by']."';";
        $que_userName = mysqli_query($conn,$sql_userName);
        while($RSE_userName = mysqli_fetch_assoc($que_userName)){
            $getuserName = $RSE_userName['userID'];
        }
        echo "<tr style='background-color: ".$col.";'>";
        echo "<td style='width:60px; text-align: right;'><div style='display: none;'><input type='text' name='txtclose".$index."' id='txtclose".$index."' value='".$res_Select['helpid']."'  onKeyPress='return disableEnterKey(event)'/></div><span  style='margin-right: 5px;'>".$res_Select['helpid']."</span></td>";
        echo "<td style='width:80px; text-align: right;'><span  style='margin-right: 5px;'>".$res_Select['enDate']."</span></td>";
        echo "<td style='width:250px; text-align: left;'><span  style='margin-left: 5px;'>".$res_Select['issue']."</span></td>";
        echo "<td style='width:80px; text-align: left;'><span  style='margin-left: 5px;'>".$res_Select['svDate']."</span></td>";
        echo "<td style='width:80px; text-align: left;' title='".$getuserName."'><span id='span_id' style='margin-left: 5px;'>".$res_Select['solved_by']."</span></td>";
        echo "<td style='width:250px; text-align: left;'><input type='text' style='width:250px;' name='txtremark".$index."' id='txtremark".$index."' value=''  onKeyPress='return disableEnterKey(event)'/></td>";
         echo "<td style='width:60px;'>
                    <select class='box_decaretion'  style='width: 50px;' name='sel_atc".$index."' id='sel_atc".$index."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'>
                    <option value='0'>0</option>
                    <option value='1'>1</option>
                    <option value='2'>2</option>
                    <option value='3'>3</option>
                    <option value='4'>4</option>
                    <option value='5'>5</option>
             </select>
                </td>";
        echo "<td style='width:150px;'>
                <input type='button' class='buttonManage' id='btn_ReOpen' name='btn_ReOpen' value='Re-open' title='txtclose".$index."|txtremark".$index."|sel_atc".$index."' onclick='isReOpen(title);'/>
                <input type='button' class='buttonManage' id='btn_Atc' name='btn_Atc' value='Submit' title='txtclose".$index."|txtremark".$index."|sel_atc".$index."' onclick='isSubmitAct(title);'/>
            </td>";
        echo "</tr>";
    }
?>
</table>
</span>
<div style="display: none;"><input type="text" name="txtuser" id="txtuser" value="<?php echo $_SESSION['user']; ?>"  onKeyPress="return disableEnterKey(event)"/></div>
</form>
</body>
</html>

