<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: Help Desk Sub Category cat 3 Management
Purpose			: To Create Sub Category for Help Desk
Author			: Madushan Wikramaarachchi
Date & Time		: 09.24 A.M 02/02/2015
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/m/004";
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
        var cell4=row.insertCell(3);
        var cell5=row.insertCell(4);
        var cell6=row.insertCell(5);
        var cell7=row.insertCell(6);
        var cell8=row.insertCell(7);
        var cell9=row.insertCell(8);
        var cell10=row.insertCell(9);
        var cell11=row.insertCell(10);
        var cell12=row.insertCell(11);
        cell1.innerHTML="<input style='width:100px;' type='text' name='txta"+(x)+"' id='txta"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)'/>";
        cell2.innerHTML="<input style='width:300px;' type='text' name='txtb"+(x)+"' id='txtb"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)'/>";
        cell3.innerHTML="<input style='width:100px;' type='text' name='txtc"+(x)+"' id='txtc"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)'/>";
        cell4.innerHTML="<select class='box_decaretion'  style='width:100px;' name='txtd"+(x)+"' id='txtd"+(x)+"' onkeypress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'><option value=''>SLA TYPE</option><option value='DAY'>Day</option><option value='HOURS'>Hours</option><option value='MINUTES'>Minutes</option></select><div style='display: none;'><input type='text' name='txtl"+(x)+"' id='txtl"+(x)+"' value=''  onkeypress='return disableEnterKey(event)' /><div>";
        cell5.innerHTML="<input style='width:100px;' type='text' name='txte"+(x)+"' id='txte"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)'/>";
        cell6.innerHTML="<input style='width:100px;' type='text' name='txtf"+(x)+"' id='txtf"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)'/>";
        cell7.innerHTML="<input style='width:50px;' type='text' name='txtg"+(x)+"' id='txtg"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)'/>";
        cell8.innerHTML="<input style='width:100px;' type='text' name='txth"+(x)+"' id='txth"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)'/>";
        cell9.innerHTML="<input style='width:50px;' type='text' name='txti"+(x)+"' id='txti"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)'/>";
        cell10.innerHTML="<input style='width:100px;' type='text' name='txtj"+(x)+"' id='txtj"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)'/>";
        cell11.innerHTML="<input style='width:50px;' type='text' name='txtk"+(x)+"' id='txtk"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)'/>";
        cell12.innerHTML="<img src='../../../img/dele.png' style='width:15px;' onclick='deleteRow(this)'/>";
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
        var elementC =  document.getElementById('txtc' + (mloop - 1));
        var elementD =  document.getElementById('txtd' + (mloop - 1));
        var elementL =  document.getElementById('txtl' + (mloop - 1));
        var elementE =  document.getElementById('txte' + (mloop - 1));
        var elementF =  document.getElementById('txtf' + (mloop - 1));
        var elementG =  document.getElementById('txtg' + (mloop - 1));
        var elementH =  document.getElementById('txth' + (mloop - 1));
        var elementI =  document.getElementById('txti' + (mloop - 1));
        var elementJ =  document.getElementById('txtj' + (mloop - 1));
        var elementK =  document.getElementById('txtk' + (mloop - 1));
        if (elementA != null){
            // Re-order the sequence of the table rows.............
            //elementA.value = y;
            //Changing the element ID's to capture in the php
            elementA.id = 'txta' + y;				  
            elementB.id = 'txtb' + y;
            elementC.id = 'txtc' + y;
            elementD.id = 'txtd' + y;
            elementL.id = 'txtl' + y;
            elementE.id = 'txte' + y;
            elementF.id = 'txtf' + y;
            elementG.id = 'txtg' + y;
            elementH.id = 'txth' + y;
            elementI.id = 'txti' + y;
            elementJ.id = 'txtj' + y;
            elementK.id = 'txtk' + y;
            //Changing the element name's to capture in the php				  
            elementA.name = 'txta' + y;				  
            elementB.name = 'txtb' + y;
            elementC.name = 'txtc' + y;
            elementD.name = 'txtd' + y;
            elementL.name = 'txtl' + y;
            elementE.name = 'txte' + y;
            elementF.name = 'txtf' + y;
            elementG.name = 'txtg' + y;
            elementH.name = 'txth' + y;
            elementI.name = 'txti' + y;
            elementJ.name = 'txtj' + y;
            elementK.name = 'txtk' + y;
            y++;
        }			
    }
}
function isChangeSubCat1(){
    var catID = document.getElementById('sel_catagory').value;
    var catSub = document.getElementById('sel_catagory_1').value;
    document.getElementById('s_cat2').innerHTML = catSub;
       if(catID != "" && catSub != ""){
            var mydata;
            mydata= new XMLHttpRequest();
            mydata.onreadystatechange=function(){
                if(mydata.readyState==4){
                    document.getElementById('ManeDivBody').innerHTML=mydata.responseText;
                    var sss = document.getElementById('row_COUNT').value;
                    for(var i = 1 ; i <= sss ; i++){
                        var v_sta = document.getElementById('txtl'+i).value;
                        document.getElementById('txtd'+i).value = v_sta;
                        //alert(v_sta);
                    }
                }
            }
            mydata.open('GET','../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_Ajax.php'+'?getCatIDSub11='+catID+'&getVatIDSub22='+catSub,true);
            mydata.send();
       }else{
            alert('Some Values are missing.');
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
         <select class="box_decaretion"  style="width: 200px;" name="sel_catagory" id="sel_catagory" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
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
    <td style="width: 110px; text-align: right;"><label class="linetop">Sub Category 1 :</label></td>
    <td>
        <div id="diva">
         <select class="box_decaretion"  style="width: 200px;" name="sel_catagory_1" id="sel_catagory_1" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onchange="isChangeSubCat1()">
            <option value="">--Select Sub Catagory 1--</option>
         </select>
        </div>
    </td>
  </tr>
  <tr>
    <td style="width: 100px; text-align: right;"><label class="linetop">Category ID</label></td>
    <td style="color: #CD253F;"><label class="linetop"><span id="s_cat1"></span></label></td>
    <td style="width: 110px; text-align: right;"><label class="linetop">Sub Category ID</label></td>
    <td style="color: #CD253F;"><label class="linetop"><span id="s_cat2"></span></label></td>
  </tr>
</table>
<br /><br />
<table>
  <tr>
    <!--<td style="width: 120px; text-align: right; vertical-align: top;"><label class="linetop">Sub Category 1 :</label></td>-->
    <td>
        <div id="ManeDivBody">
        <table border="1" id="myTable" style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
            <tr style="background-color: #BEBABA;">
                <td style="width:100px;">Sub Cat ID</td>
                <td style="width:300px;">Sub Cat Name</td>
                <td style='width:100px;'>Def. User</td>
                <td style='width:100px;'>SLA_Type</td>
                <td style='width:100px;'>SLA</td>
                <td style='width:100px;'>Esca. User 1</td>
                <td style='width:50px;'>Esca. 1</td>
                <td style='width:100px;'>Esca. User 2</td>
                <td style='width:50px;'>Esca. 2</td>
                <td style='width:100px;'>Esca. User 3</td>
                <td style='width:50px;'>Esca. 3</td>
                <td style="width:30px;"></td>
            </tr>
            <tr>
                <td style="width:100px;"><input style="width:100px;" type="text" name="txta1" id="txta1" value=""  onkeypress="return disableEnterKey(event)"/></td>
                <td style="width:300px;"><input style="width:300px;" type="text" name="txtb1" id="txtb1" value=""  onkeypress="return disableEnterKey(event)" /></td>
                <td style="width:100px;"><input style="width:100px;" type="text" name="txtc1" id="txtc1" value=""  onkeypress="return disableEnterKey(event)" /></td>
                <td style="width:100px;">
                <select class="box_decaretion"  style="width:100px;" name="txtd1" id="txtd1" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
                    <option value="">SLA TYPE</option>
                    <option value="DAY">Day</option>
                    <option value="HOURS">Hours</option>
                    <option value="MINUTES">Minutes</option>
                </select>
                <div style='display: none;'><input type='text' name='txtl1' id='txtl1' value=''  onkeypress='return disableEnterKey(event)' /><div>
                </td>
                <td style="width:100px;"><input style="width:100px;" type="text" name="txte1" id="txte1" value=""  onkeypress="return disableEnterKey(event)" /></td>
                <td style="width:100px;"><input style="width:100px;" type="text" name="txtf1" id="txtf1" value=""  onkeypress="return disableEnterKey(event)" /></td>
                <td style="width:50px;"><input style="width:50px;" type="text" name="txtg1" id="txtg1" value=""  onkeypress="return disableEnterKey(event)" /></td>
                <td style="width:100px;"><input style="width:100px;" type="text" name="txth1" id="txth1" value=""  onkeypress="return disableEnterKey(event)" /></td>
                <td style="width:50px;"><input style="width:50px;" type="text" name="txti1" id="txti1" value=""  onkeypress="return disableEnterKey(event)" /></td>
                <td style="width:100px;"><input style="width:100px;" type="text" name="txtj1" id="txtj1" value=""  onkeypress="return disableEnterKey(event)" /></td>
                <td style="width:50px;"><input style="width:50px;" type="text" name="txtk1" id="txtk1" value=""  onkeypress="return disableEnterKey(event)" /></td>
                <td style="width:30px;"><img src="../../../img/dele.png" style=" width:15px;" onclick="deleteRow(this)"/></td>
            </tr>
        </table>
        <div style="display: none;">
           <input type="text" name="row_COUNT" id="row_COUNT" value="1" onkeypress="return disableEnterKey(event)"/> 
        </div>
        </div>
    </td>
  </tr>
  <tr>
    <!--<td style="width: 100px; text-align: right;"></td>-->
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
            if(trim($_POST['sel_catagory']) != "" && trim($_POST['sel_catagory_1'])){
                $count = trim($_POST['row_COUNT']);
                for($i = 1; $i<= $count; $i++){
                    $v_Select = "SELECT count(*) FROM `scat_02` WHERE `cat_code`='".trim($_POST['sel_catagory'])."' AND `scat_code_1` = '".trim($_POST['sel_catagory_1'])."' AND `scat_code_2`='".trim($_POST['txta'.$i])."'";
                    $q_select = mysqli_query($conn,$v_Select);
                    while($RES_Count = mysqli_fetch_array($q_select)){
                        if($RES_Count[0]!=0){
                            $v_update = "UPDATE `scat_02` 
                                            SET `scat_discr_2` = '".trim($_POST['txtb'.$i])."', `DefuserID` = '".trim($_POST['txtc'.$i])."', `SLA_TYPE` = '".trim($_POST['txtd'.$i])."', `SAL` = '".trim($_POST['txte'.$i])."', `ESCAL_1_USER_ID` = '".trim($_POST['txtf'.$i])."', `ESCAL_1` = '".trim($_POST['txtg'.$i])."', `ESCAL_2_USER_ID` = '".trim($_POST['txth'.$i])."', `ESCAL_2` = '".trim($_POST['txti'.$i])."', `ESCAL_3_USER_ID` = '".trim($_POST['txtj'.$i])."', `ESCAL_3` = '".trim($_POST['txtj'.$i])."'
                                            WHERE `cat_code`='".trim($_POST['sel_catagory'])."' AND `scat_code_1` = '".trim($_POST['sel_catagory_1'])."' AND `scat_code_2`='".trim($_POST['txta'.$i])."'";
                            $que_getSQL_Update = mysqli_query($conn,$v_update)or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
                            //echo $v_update;
                        }else{
                            $V_insrt_CatSub = "INSERT INTO `scat_02`(`cat_code`,`scat_code_1`,`scat_code_2`,`scat_discr_2`,`scat_state_2`,`DefuserID`,`SLA_TYPE`,`SAL`,`ESCAL_1`,`ESCAL_1_USER_ID`,`ESCAL_2`,`ESCAL_2_USER_ID`,`ESCAL_3`, `ESCAL_3_USER_ID`) 
                                                VALUES ('".trim($_POST['sel_catagory'])."','".trim($_POST['sel_catagory_1'])."','".trim($_POST['txta'.$i])."','".trim($_POST['txtb'.$i])."',1,'".trim($_POST['txtc'.$i])."','".trim($_POST['txtd'.$i])."','".trim($_POST['txte'.$i])."','".trim($_POST['txtg'.$i])."','".trim($_POST['txtf'.$i])."','".trim($_POST['txti'.$i])."','".trim($_POST['txth'.$i])."','".trim($_POST['txtk'.$i])."','".trim($_POST['txtj'.$i])."');"; 
                            $que_getSQL_Iner = mysqli_query($conn,$V_insrt_CatSub) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
                            //echo $V_insrt_CatSub;
                        }
                    }
                }
                mysqli_commit($conn); 
                //echo "<script> alert('Record Saved!');</script>";
                //echo "<script>pageClose();</script>";
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
        $("#s_cat1").html(catID);
        $.ajax({
			type:'POST', 
			data: {getCatIDSub1 : catID}, 
			url: '../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_Ajax.php', 
			success: function(data) { 
		      $("#diva").html(data);  
			}
		});
    });
});
</script>
</body>
</html>