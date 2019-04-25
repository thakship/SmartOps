<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: Risk Score Card
Purpose			: To Request for Risk Score Card
Author			: Madushan Wikramaarachchi
Date & Time		: 11:48 AM 2019-04-11
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/e/070";
	include('../../pageasses.php');
	$ass = cakepageaccess();
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
<title>Service Request - Instant Card</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../helpdesk_DEVELOPMENT/CSS/helpdesk_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../helpdesk_DEVELOPMENT/JAVASCRIPT_FUNCTION/helpdesk_js_function.js"></script>
<!--END Common fumction Libariries-->
<style type="text/css">
	#outer{
		visibility: hidden;
		position: fixed;
		left: 0px;
		top:0px;
		width: 100%;
		height: 100%;
		background: #6DA6E4;
		opacity: 0.7;
	}
	#conten{
		position: fixed;
		margin-top:-150px;
		margin-left: -200px;
		top:50%;
		left:50%;
		visibility: hidden;
		background: #ffffff;
		z-index: 5;
		height:275px;
		overflow-y: scroll;
		border:#000000 solid 1px;
	}
</style>
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
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
    <td style="width: 200px; text-align: right;"><label class="linetop">Name of Customer :</label></td>
    <td>
         <input class="box_decaretion" style="width: 300px;" type="text" name="txtNameofCustomer" id="txtNameofCustomer" value="" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" required="required" />
    </td>
  </tr>
  <tr>
    <td style="width: 200px; text-align: right;"><label class="linetop">NIC No :</label></td>
    <td>
         <input class="box_decaretion" style="width: 200px;" type="text" name="txtNICNo" id="txtNICNo" value="" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" required="required" />
    </td>
  </tr>
  <tr>
    <td style="width: 200px; text-align: right;"><label class="linetop">Client Code :</label></td>
    <td>
         <input class="box_decaretion" style="width: 100px;" type="text" name="txtClientCode" id="txtClientCode" value="" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" required="required" />
    </td>
    <tr><td style="width: 200px; text-align: right;">&nbsp;</td><td>&nbsp;<hr></td></tr>
  
  <tr>
    <td style="width: 200px; text-align: right;"><label class="linetop" id="lblFacilitiy">Facilitiy :</label></td>
    <td>
          <select class="box_decaretion"  style="width: 200px;" name="sel_Facilitiy" id="sel_Facilitiy" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" title="Facilitiy" onchange="is_getCompolnat(title)" >
              <option value="">-- Select Facilitiy -- </option>
              <option value="Deposit">Deposit</option>
              <option value="Lending">Lending</option>
          </select>
    </td>
  </tr>
  <tr>
    <td style="width: 200px; text-align: right;"><label class="linetop">Type of Facility :</label></td>
    <td id="Facilitiy">
          <select class="box_decaretion"  style="width: 200px;" name="sel_Type_of_Facility" id="sel_Type_of_Facility" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onchange="getRiskRating(this.id)" >
                <option value="0">-- Select Type of Facility --</option>
          </select>
    </td>
  </tr>
   <tr>
    <td style="width: 200px; text-align: right;"><label class="linetop">Customer :</label></td>
    <td>
          <select class="box_decaretion"  style="width: 200px;" name="sel_Customer" id="sel_Customer" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" title="Customer" onchange="is_getCompolnat(title)" >
              <option value="">-- Select Customer --</option>
              <option value="Individual">Individual</option>
              <option value="Corporate">Corporate</option>
          </select>
    </td>
  </tr>
  <tr>
    <td style="width: 200px; text-align: right;"><label class="linetop">Customer Category :</label></td>
    <td id="Customer">
          <select class="box_decaretion"  style="width: 200px;" name="sel_Customer_Category" id="sel_Customer_Category" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" >
              <option value="0">-- Select Customer Category --</option>
          </select>
    </td>
  </tr>
  <tr>
    <td style="width: 200px; text-align: right;"><label class="linetop">Distribution Channel :</label></td>
    <td>
          <select class="box_decaretion"  style="width: 200px;" name="sel_Distribustion_Channel" id="sel_Distribustion_Channel" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"   onchange='getRiskRating(this.id)'>
              <option value="0">-- Select Distribustion Channel --</option>
               <?php
                $v_sql_abc = "select cc.risk_attrib_descr,cc.risk_attrib_value from cdb_risk_params  cc where cc.risk_attrib_code = 'Delivary Channel' and cc.risk_attrib_disable = 0;";
                $que_getabc = mysqli_query($conn,$v_sql_abc);
                while($RES_getABC = mysqli_fetch_array($que_getabc)){
                    echo "<option value=".$RES_getABC[1].">".$RES_getABC[0]."</option>";
                }
            ?>
          </select>
    </td>
  </tr>
  <tr>
    <td style="width: 200px; text-align: right;"><label class="linetop">Country :</label></td>
    <td>
          <select class="box_decaretion"  style="width: 200px;" name="sel_Country" id="sel_Country" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onchange='getRiskRating(this.id)'>
              <option value="0">-- Select Country --</option>
               <?php
                $v_sql_abd = "select cc.risk_attrib_descr,cc.risk_attrib_value from cdb_risk_params  cc where cc.risk_attrib_code = 'Country' and cc.risk_attrib_disable = 0;";
                $que_getabd = mysqli_query($conn,$v_sql_abd);
                while($RES_getABD = mysqli_fetch_array($que_getabd)){
                    echo "<option value=".$RES_getABD[1].">".$RES_getABD[0]."</option>";
                }
            ?>
          </select>
    </td>
  </tr>
   <tr>
    <td style="width: 200px; text-align: right;"><label class="linetop" id="AnticipatedInc">Anticipated Investment :</label></td>
    <td id="trAI">
          <select class="box_decaretion"  style="width: 200px;" name="sel_Anticipated_Investment" id="sel_Anticipated_Investment" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" >
              <option value="0">-- Select Anticipated Investment --</option>
          </select>
    </td>
  </tr>
</table>

<BR>
<label id="lblResalt" style="color: #B70000; margin-left: 300px;"></label>
<BR><BR>
<table>
     <tr>
        <td style="width: 200px;">&nbsp;</td>
        <td>
            <input type="button" style="width: 100px;" class="buttonManage" id="btnProcess" name="btnProcess" value="Save Score" onclick="Save_Score()"/>
            <input type="button" style="width: 100px;" class="buttonManage" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
        </td>
     </tr>
</table>
<!-- ****************************************************************************************************************************************************** -->
<span id="getGried"></span>
<script type="text/javascript">
function pageClose(){ //Page Close Function.......
	parent.location.href = parent.location.href;
}


function is_getCompolnat(title){
    //alert(title);
    if(title == "Facilitiy"){
        var getData = document.getElementById('sel_Facilitiy').value;
    }else if(title == "Customer"){
        var getData = document.getElementById('sel_Customer').value;
    }else{
        
    }
    
    if(title != ""){
        var mydatais;
    	mydatais= new XMLHttpRequest();
    	mydatais.onreadystatechange=function(){
    		if(mydatais.readyState==4){
    		  
    			document.getElementById(title).innerHTML = mydatais.responseText;
                if(title == "Facilitiy"){
                        var mydatais1;
                        	mydatais1 = new XMLHttpRequest();
                        	mydatais1.onreadystatechange=function(){
                        		if(mydatais1.readyState==4){
                        		  
                        			document.getElementById('trAI').innerHTML = mydatais1.responseText;
                                    
                        		}
                        	}
                        	mydatais1.open("GET","function_Risk_Score_Card.php"+"?isgetData="+getData+"&isget_status="+'AI',true);
                        	mydatais1.send();
                }
    		}
    	}
    	mydatais.open("GET","function_Risk_Score_Card.php"+"?isgetData="+getData+"&isget_status="+title,true);
    	mydatais.send();
    }
}

function getRiskRating(id){

	document.getElementById('AnticipatedInc').innerHTML = "Anticipated Income";
	if(document.getElementById("sel_Facilitiy").value=="Deposit")
		document.getElementById('AnticipatedInc').innerHTML = "Anticipated Investment";
	

    var V_VAL_1 = document.getElementById("sel_Type_of_Facility").value;
    var V_VAL_2 = document.getElementById("sel_Customer_Category").value;
    var V_VAL_3 = document.getElementById("sel_Distribustion_Channel").value;
    var V_VAL_4 = document.getElementById("sel_Country").value;
    var V_VAL_5 = document.getElementById("sel_Anticipated_Investment").value;
    var TOTAL = (Number.parseFloat(V_VAL_1) * 0.02 ) + (Number.parseFloat(V_VAL_2) * 0.6) + (Number.parseFloat(V_VAL_3) * 0.3) + (Number.parseFloat(V_VAL_4) * 0.04) + (Number.parseFloat(V_VAL_5) * 0.04);
    //document.getElementById('lblResalt').innerHTML = TOTAL; 
	
	document.getElementById('lblResalt').innerHTML = (TOTAL < 2.99?"<font size='5' color='green'>Low Risk</font>":(TOTAL < 3.99?"<font size='5' color='orange'>Medium Risk</font>":"<font size='5' color='red'>High Risk</font>"));
}

function Save_Score(){
    alert('Save_Score');
}
</script>

</form>
</body>
</html>

