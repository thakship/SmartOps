<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Security Printing System
Page Name		: Security Printing Authorization
Purpose			: This process allows to define amount slabs for each letter type and assign a Signatory Group code for each amount slab.
Author			: Madushan Wikramaarachchi
Date & Time		: 01.12 P.M 27/04/2015
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="sps/q/001";
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
<title>Security Printing Authorization</title>
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
    function isGetRecordGried(){
       // alert(title);
        var var_aa = document.getElementById('is_var_aa').value;
        var var_bb = document.getElementById('is_var_bb').value;
        var var_ee = document.getElementById('is_var_ee').value;
        var var_ff = document.getElementById('is_var_ff').value;
        var var_user = document.getElementById('is_var_user').value;
        var r = confirm('Are you sure you want to authorized this?')
        if (r==true){
          //alert(var_aa+"--"+var_bb+"--"+var_ee+"--"+var_ff+"--"+var_user);
	      $.ajax({ 
				type:'POST', 
				data: {get_spa_Letter_Type : var_aa , get_spa_Batch_Number : var_bb , get_spa_Amount_Slab_001 : var_ee , val_spa_Amount_Slab_002 : var_ff ,get_spa_user : var_user }, 
				url: '../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_function.php', 
				success: function(val_retn) { 
				    alert(val_retn); 
                    pageCloseSecurityPrintinAuthorization();
				}
			});	
        }else{
			//alert('BBBBB');		
		}
    }
    
    function loadNewTable(title){
        var var_batch = document.getElementById('txte'+title).value;
        var var_gen_by = document.getElementById('txtc'+title).value;
        var var_gen_on = document.getElementById('txtd'+title).value;
        var var_user_Id = document.getElementById('txtMyUserID').value;
        //alert(var_batch+"--"+var_gen_by+"--"+var_gen_on+"--"+var_user_Id);
        mydata= new XMLHttpRequest();
        mydata.onreadystatechange=function(){
            if(mydata.readyState==4){
                document.getElementById('aaaa').innerHTML=mydata.responseText;           
            }
        }
        mydata.open("GET","ajx_load_gried.php"+"?var_spa_batch="+var_batch+"&var_spa_gen_by="+var_gen_by+"&var_spa_gen_on="+var_gen_on+"&var_spa_user_Id="+var_user_Id,true);
        mydata.send();
        document.getElementById('tr'+title).style.backgroundColor = "#9AE7F0";
    }
    
    function getAthGried(title){
       var var_aa = document.getElementById('txtaa'+title).value;
       var var_bb = document.getElementById('txtbb'+title).value;
       var var_ee = document.getElementById('txtee'+title).value;
       var var_ff = document.getElementById('txtff'+title).value;
       var var_user = document.getElementById('txtMyUserID').value;
       //alert(var_aa+'--'+var_bb+'--'+var_ee+'--'+var_ff+'--'+var_user);
        mydata1 = new XMLHttpRequest();
        mydata1.onreadystatechange=function(){
            if(mydata1.readyState==4){
                document.getElementById('aaaa').innerHTML=mydata1.responseText;           
            }
        }
        mydata1.open("GET","ajx_load_gried.php"+"?get_var_aa="+var_aa+"&get_var_bb="+var_bb+"&get_var_ee="+var_ee+"&get_var_ff="+var_ff+"&get_var_user="+var_user,true);
        mydata1.send();
    }
    
     function isChangeRowColoerOverSub(title){
        document.getElementById('trsub'+title).style.backgroundColor = "#FDEEEE";
    }
    
    function isChangeRowColoerDownSub(title){
        document.getElementById('trsub'+title).style.backgroundColor = "#FFFFFF";
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
<div style="display: none;">
    <input type="text" id="txtMyUserID" name="txtMyUserID" value="<?php echo $_SESSION['user']; ?>" onkeypress="return disableEnterKey(event)" />
</div>
<br />
<table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
   	    <tr style='background-color: #BEBABA;'>
            <td style='width:250px; text-align: left;'><span style='margin-left: 5px;'>Letter Type</span></td>
            <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>MAT Date</span></td>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Generated By</span></td>
            <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>Generated On</span></td>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Batch Number</span></td>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'></span></td>
        </tr>
<?php
   $sql_select_sps_let_batch = "SELECT `sps_let_types`.`TYPE_DESC` , 
                                       `sps_let_batch`.`MAT_DATE` , 
                                       `sps_let_batch`.`GEN_BY`, 
                                       DATE(`sps_let_batch`.`GEN_DATE`), 
                                       `sps_let_batch`.`BATCH_NUM`
                                FROM `sps_let_batch` , `sps_let_types`
                                WHERE `sps_let_batch`.`LET_TYPE` = `sps_let_types`.`TYPE_CODE` AND
                                      `BATCH_STAT` = 'N';";
   $que_select_sps_let_batch = mysqli_query($conn, $sql_select_sps_let_batch) or die(mysqli_error());
   $count_sql = mysqli_num_rows($que_select_sps_let_batch);
   if($count_sql == 0){
?>
   <tr id="tr1" title="1" onclick="">
        <td style='width:250px; text-align: left;'><span style='margin-left: 5px;'></span><span style="display: none;"><input type="text" name="txta1" id="txta1" value="" onkeypress="return disableEnterKey(event)" readonly="readonly" /></span></td>
        <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'></span><span style="display: none;"><input type="text" name="txtb1" id="txtb1" value="" onkeypress="return disableEnterKey(event)" readonly="readonly" /></span></td>
        <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'></span><span style="display: none;"><input type="text" name="txtc1" id="txtc1" value="" onkeypress="return disableEnterKey(event)" readonly="readonly" /></span></td>
        <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'></span><span style="display: none;"><input type="text" name="txtd1" id="txtd1" value="" onkeypress="return disableEnterKey(event)" readonly="readonly" /></span></td>
        <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'></span><span style="display: none;"><input type="text" name="txte1" id="txte1" value="" onkeypress="return disableEnterKey(event)" readonly="readonly" /></span></td>
        <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'></span></td>
   </tr>
<?php
   }else{
        $a = 0;
        while($RES_select_sps_let_batch = mysqli_fetch_array($que_select_sps_let_batch)) {
            $a++;
            $sql_user = "SELECT `userID` FROM `user` WHERE `userName` = '".$RES_select_sps_let_batch[2]."';";
            $que_user = mysqli_query($conn, $sql_user)or die(mysqli_error());
            while($res_ussr = mysqli_fetch_array($que_user)){
                $get_user = $res_ussr[0];
            }
            echo "<tr id='tr".$a."' title='".$a."' onclick='loadNewTable(title);'>
                    <td style='width:250px; text-align: left;'><span style='margin-left: 5px;'>".$RES_select_sps_let_batch[0]."</span><span style='display: none;'><input type='text' name='txta".$a."' id='txta".$a."' value='".$RES_select_sps_let_batch[0]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                    <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$RES_select_sps_let_batch[1]."</span><span style='display: none;'><input type='text' name='txtb".$a."' id='txtb".$a."' value='".$RES_select_sps_let_batch[1]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                    <td style='width:100px; text-align: left;' title='".$get_user."'><span style='margin-left: 5px;'>".$RES_select_sps_let_batch[2]."</span><span style='display: none;'><input type='text' name='txtc".$a."' id='txtc".$a."' value='".$RES_select_sps_let_batch[2]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                    <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$RES_select_sps_let_batch[3]."</span><span style='display: none;'><input type='text' name='txtd".$a."' id='txtd".$a."' value='".$RES_select_sps_let_batch[3]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$RES_select_sps_let_batch[4]."</span><span style='display: none;'><input type='text' name='txte".$a."' id='txte".$a."' value='".$RES_select_sps_let_batch[4]."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'><input class='buttonManage' style='width: 100px;' type='button' name='btnClose' id='btnClose' value='Select' onclick='loadNewTable(title);'/></span></td>
                </tr>";   
        }
   }
  
?>
</table>
<br />
<hr />
<br />
<div id="aaaa">
<div style="margin-left: 50px;">
<input class="buttonManage" style="width: 100px;" type="button" name="btnClose" id="btnClose" value="Close" onclick="pageClose();"/>
</div>
</div>
</form>
</body>
</html>

