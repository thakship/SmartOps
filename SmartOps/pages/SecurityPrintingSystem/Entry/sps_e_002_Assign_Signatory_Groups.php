<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Security Printing System
Page Name		: Assign Signatory Groups
Purpose			: This process allows to define amount slabs for each letter type and assign a Signatory Group code for each amount slab.
Author			: Madushan Wikramaarachchi
Date & Time		: 12.34 P.M 21/04/2015
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="sps/e/002";
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
<title>Assign Signatory Groups</title>
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
   function isChangeSig_Group(){
        var sel_drop = document.getElementById('sel_sgu_let_types').value;
        if(sel_drop != ""){
            var mydataSub;
			mydataSub= new XMLHttpRequest();
			mydataSub.onreadystatechange=function(){
				if(mydataSub.readyState==4){
					document.getElementById('spn_ajax_signatory_Group').innerHTML=mydataSub.responseText;
				}
			}
			//var sub1=document.getElementById('selectCodeDoc').value;
			mydataSub.open("GET","../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_Ajax.php"+"?spe_e_aj_let_type="+sel_drop,true);
			mydataSub.send();
        }
    }
    
    function getGriedTable(){
        var sel_drop = document.getElementById('sel_sgu_let_types').value;
        if(sel_drop != ""){
            var mydata1;
			mydata1 = new XMLHttpRequest();
			mydata1.onreadystatechange=function(){
				if(mydata1.readyState==4){
					document.getElementById('aaaa').innerHTML=mydata1.responseText;
				}
			}
			//var sub1=document.getElementById('selectCodeDoc').value;
			mydata1.open("GET","../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_Ajax.php"+"?asg_e_aj_let="+sel_drop,true);
			mydata1.send();
        }
    }
    
    function isGetRecordGried(title){
       // alert(title);
        var ijk = document.getElementById('txta'+title).value;
        var abc = document.getElementById('txtb'+title).value;
        var def = document.getElementById('txtc'+title).value;
        var geh = document.getElementById('txte'+title).value;
        
        document.getElementById('txtAmount_From').value = abc;
        document.getElementById('txtAmount_To').value = def;
        document.getElementById('sel_sug_Signatory_Group').value = geh;
        document.getElementById('txtsqe').value = ijk;
    }
     function isChangeRowColoerOver(title){
        document.getElementById('tr'+title).style.backgroundColor = "#FDEEEE";
    }
    
    function isChangeRowColoerDown(title){
        document.getElementById('tr'+title).style.backgroundColor = "#FFFFFF";
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
<table>
    <tr>
        <td style="width: 150px; text-align: right;"><label class="linetop">Letter Type Code :</label></td>
        <td>
        	 <?php
        		$sql_sps_let_types = "SELECT `TYPE_CODE`, `TYPE_DESC` FROM `sps_let_types`;";
                $quary_sps_let_types = mysqli_query($conn,$sql_sps_let_types);
            ?>
            <select class="box_decaretion" name="sel_sgu_let_types" id="sel_sgu_let_types" onkeyup="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onchange="isChangeSig_Group();getGriedTable();">
            <option value="">--Select Letter Type--</option>
            <?php
                while ($rec_sps_let_types = mysqli_fetch_array($quary_sps_let_types)) {
                    echo "<option value='".$rec_sps_let_types[0]."'>".$rec_sps_let_types[1]."</option>";
                }
            ?>
            </select>
        </td>
    </tr>
    <tr>
        <td style="width: 150px; text-align: right;"><label class="linetop">Signatory Group :</label></td>
        <td>
            <span id="spn_ajax_signatory_Group">
                <select class="box_decaretion" name="sel_sug_Signatory_Group" id="sel_sug_Signatory_Group" onkeyup="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
                    <option value="">--Select Signatory Group--</option>
                </select>
            </span>
        </td>
    </tr>
    <tr>
        <td style="width: 150px; text-align: right;"><label class="linetop">Amount From :</label></td>
        <td><input type="text" class="box_decaretion" maxlength="18" style=" width:150px;" name="txtAmount_From" id="txtAmount_From" value="" onkeypress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"/></td>
    </tr>
     <tr>
        <td style="width: 150px; text-align: right;"><label class="linetop">Amount To :</label></td>
        <td><input type="text" class="box_decaretion" maxlength="18"  style=" width:150px;" name="txtAmount_To" id="txtAmount_To" value="" onkeypress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"/></td>
    </tr>
</table>
<div style="display: none;">
    <input type="text" id="txtMyUserID" name="txtMyUserID" value="<?php echo $_SESSION['user']; ?>" onkeypress="return disableEnterKey(event)" />
    <input type="text" id="txtsqe" name="txtsqe" value="" onkeypress="return disableEnterKey(event)" />
</div>
<br />
<div style="margin-left: 100px;">
<input class="buttonManage" style="width: 100px;" type="button" name="btnSave" id="btnSave" value="Save" title="1" onclick="isCheckFromAssignSignatoryGroups(title);"/>
<input class="buttonManage" style="width: 100px;" type="button" name="btnModify" id="btnModify" value="Modify" title="2" onclick="isCheckFromAssignSignatoryGroups(title);"/>
<input class="buttonManage" style="width: 100px;" type="button" name="btnDelete" id="btnDelete" value="Delete" title="3" onclick="isCheckFromAssignSignatoryGroups(title);"/>
<input class="buttonManage" style="width: 100px;" type="button" name="btnClose" id="btnClose" value="Close" onclick="pageClose();"/>
</div>
<hr />
<div id="aaaa">
    <table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
   	    <tr style='background-color: #BEBABA;'>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Slab Serial</span></td>
            <td style='width:250px; text-align: left;'><span style='margin-left: 5px;'>Amount From</span></td>
            <td style='width:250px; text-align: left;'><span style='margin-left: 5px;'>Amount To</span></td>
            <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>Signatory Group</span></td>
        </tr>
        <tr id="tr1" title="1" onclick="isGetRecordGried(title);" onmouseover="isChangeRowColoerOver(title);" onmouseout="isChangeRowColoerDown(title);">
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span><span style="display: none;"><input type="text" name="txta1" id="txta1" value="" onkeypress="return disableEnterKey(event)" readonly="readonly" /></span></td>
            <td style='width:250px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span><span style="display: none;"><input type="text" name="txtb1" id="txtb1" value="" onkeypress="return disableEnterKey(event)" readonly="readonly" /></span></td>
            <td style='width:250px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span><span style="display: none;"><input type="text" name="txtc1" id="txtc1" value="" onkeypress="return disableEnterKey(event)" readonly="readonly" /></span></td>
            <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span><span style="display: none;"><input type="text" name="txtd1" id="txtd1" value="" onkeypress="return disableEnterKey(event)" readonly="readonly" /></span></td>
        </tr>
    </table>
</div>

</form>
</body>
</html>

