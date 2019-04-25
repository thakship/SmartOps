<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: Help Desk Sub Category Management
Purpose			: To Create Sub Category for Help Desk
Author			: Madushan Wikramaarachchi
Date & Time		: 02.26 P.M 02/02/2015
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/m/003";
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
function is_add_row(){ // add new row in table
    var x = document.getElementById("myTable").rows.length;
    var getVal = document.getElementById('txtb'+(x-1)).value;
    if(getVal != ""){
        var table=document.getElementById("myTable");
        var row=table.insertRow(-1);
        var cell1=row.insertCell(0);
        var cell2=row.insertCell(1);
        var cell3=row.insertCell(2);
        cell1.innerHTML="<input style='width:100px;' type='text' name='txta"+(x)+"' id='txta"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)'/>";
        cell2.innerHTML="<input style='width:500px;' type='text' name='txtb"+(x)+"' id='txtb"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)'/>";
        cell3.innerHTML="<img src='../../../img/dele.png' style='width:15px;' onclick='deleteRow(this)'/>";
        document.getElementById('row_COUNT').value =  document.getElementById("myTable").rows.length-1;
    }else{
       alert('Note text box empty.');
    }
}

function deleteRow(n){ // this fuction is Delete Row(s) in table
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
            //elementA.value = y;
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
    <td style="width: 100px; text-align: right;"><label class="linetop">Category :</label></td>
    <td>
         <select class="box_decaretion"  style="width: 200px;" name="sel_catagory" id="sel_catagory" onKeyPress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
            <option value="">--Select Catagory --</option>
            <?php
                $v_sql_getCategory = "SELECT `cat_code`,`cat_discr` FROM `cat_states` WHERE `car_state` = '1';";
                $que_getCategory = mysqli_query($conn,$v_sql_getCategory);
                while($RES_getCategory = mysqli_fetch_array($que_getCategory)){
                    echo "<option value=".$RES_getCategory[0].">".$RES_getCategory[1]."</option>";
                }
            ?>
         </select>
    </td>
    <td style="width: 50px; text-align: left;color: #CD253F;"><label class="linetop"><span id="getIDCat"></span></label></td>
  </tr>
</table>
<br /><br />
<table>
  <tr>
    <td style="width: 120px; text-align: right; vertical-align: top;"><label class="linetop">Sub Category 1 :</label></td>
    <td>
        <div id="ManeDivBody">
        <table border="1" id="myTable" style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
            <tr style="background-color: #BEBABA;">
                <td style="width:100px;">Sub Cat ID</td>
                <td style="width:500px;">Sub Cat Name</td>
                <td style="width:30px;"></td>
            </tr>
            <tr>
                <td style="width:100px;"><input style="width:100px;" type="text" name="txta1" id="txta1" value=""  onKeyPress="return disableEnterKey(event)"/></td>
                <td style="width:500px;"><input style="width:500px;" type="text" name="txtb1" id="txtb1" value=""  onKeyPress="return disableEnterKey(event)" /></td>
                <td style="width:30px;"><img src="../../../img/dele.png" style=" width:15px;" onclick="deleteRow(this)"/></td>
            </tr>
        </table>
        <div style="display: none;">
           <input type="text" name="row_COUNT" id="row_COUNT" value="1" onKeyPress="return disableEnterKey(event)"/> 
        </div>
        </div>
    </td>
  </tr>
  <tr>
    <td style="width: 100px; text-align: right;"></td>
    <td>
       <input class="buttonManage" type="button" name="btn_addnote" id="btn_addnote" value="Add row" onclick="is_add_row();"/>
    </td>
  </tr>
</table>
<table>
     <tr>
        <td style="width: 100px;">&nbsp;</td>
        <td>
            <input type="submit" style="width: 100px;" class="buttonManage" id="btnSave" name="btnSave" value="Save" />
            <input type="button" style="width: 100px;" class="buttonManage" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
        </td>
     </tr>
</table>
<?php
    if(isset($_POST['btnSave']) && $_POST['btnSave']=='Save'){
        mysqli_autocommit($conn,FALSE);
        try{
            // Validation rule engine
            if(trim($_POST['sel_catagory']) != ""){
                $count = trim($_POST['row_COUNT']);
                for($i = 1; $i<= $count; $i++){
                    $v_Select = "SELECT count(*) FROM `scat_01` WHERE `cat_code` = '".trim($_POST['sel_catagory'])."' AND `scat_code_1`='".trim($_POST['txta'.$i])."'";
                    $q_select = mysqli_query($conn,$v_Select);
                    while($RES_Count = mysqli_fetch_array($q_select)){
                        if($RES_Count[0]!=0){
                            $v_update = "UPDATE `scat_01` SET `scat_discr_1`='".trim($_POST['txtb'.$i])."',`scat_state_1`=1 WHERE `cat_code` = '".trim($_POST['sel_catagory'])."' AND `scat_code_1`='".trim($_POST['txta'.$i])."'";
                            $que_getSQL_Update = mysqli_query($conn,$v_update)or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
                        
                        }else{
                            $V_insrt_CatSub = "INSERT INTO `scat_01`(`cat_code`, `scat_code_1`, `scat_discr_1`, `scat_state_1`) VALUES ('".trim($_POST['sel_catagory'])."','".trim($_POST['txta'.$i])."','".trim($_POST['txtb'.$i])."',1);";    
                            $que_getSQL_Iner = mysqli_query($conn,$V_insrt_CatSub) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
                        }
                    }
                    
                }
                mysqli_commit($conn); 
                echo "<script> alert('Record Saved!');</script>";
                    echo "<script>pageClose();</script>";
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
<script type="text/javascript">
$(document).ready(function(){
    $("#sel_catagory").change(function () { //....Select Cataory And get sub cat
        var catID = $("#sel_catagory").val();
        $("#getIDCat").html(catID);
        $.ajax({
			type:'POST', 
			data: {getCatID : catID}, 
			url: '../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_Ajax.php', 
			success: function(data) { 
		      $("#ManeDivBody").html(data);  
			}
		});
    });
});
</script>
</body>
</html>