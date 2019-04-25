<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: Patpat - Service Request
Purpose			: To Request for Patpat Service
Author			: Madushan Wikramaarachchi
Date & Time		: 12:33 P.M 15/06/2018
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/e/049";
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
	//include('ajax_Gried.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Service Request</title>
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
                if(getTitle == 4){
                    //alert('OK');
                                        
                    var mydatais;
            		mydatais= new XMLHttpRequest();
            		mydatais.onreadystatechange=function(){
            			if(mydatais.readyState==4){
            				document.getElementById('get_issue').innerHTML=mydatais.responseText;
            			}
            		}
            		mydatais.open("GET","../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_Ajax.php"+"?getIss_templet="+getCat+"&get_status="+getTitle+"&getcatCodeSelect="+cat1,true);
            		mydatais.send();
                    
                }           
                     
            }
        }
        mydata.open("GET","ajax_serviceRequset_01patpat.php"+"?txt1="+getCat+"&txt2="+getTitle,true);
        mydata.send();
    }
    
}

function is_getiss_scat_3(getId,title){
    
    var cat3 = document.getElementById(getId).value;
   var cat1 = document.getElementById('sel_catagory').value;// 
    //alert(cat1);
    var mydatais;
	mydatais= new XMLHttpRequest();
	mydatais.onreadystatechange=function(){
		if(mydatais.readyState==4){
			document.getElementById('get_issue').innerHTML = mydatais.responseText;
		}
	}
	mydatais.open("GET","../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_Ajax.php"+"?getIss_templet="+cat3+"&get_status="+title+"&getcatCodeSelect="+cat1,true);
	mydatais.send();
}
function is_add_row(){
    var x = document.getElementById("myTable").rows.length;
    var getVal = document.getElementById('txtb'+(x-1)).value;
    if(getVal != ""){
        var table=document.getElementById("myTable");
        var row=table.insertRow(-1);
        var cell1=row.insertCell(0);
        var cell2=row.insertCell(1);
        var cell3=row.insertCell(2);
        cell1.innerHTML="<input style='width:50px;text-align: right;' type='text' name='txta"+(x)+"' id='txta"+(x)+"' value='"+(x)+"'  onKeyPress='return disableEnterKey(event)' readonly='readonly'/>";
        cell2.innerHTML="<input style='width:600px;' type='text' name='txtb"+(x)+"' id='txtb"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)'/>";
        cell3.innerHTML="<img src='../../../img/dele.png' style='width:15px;' onclick='deleteRow(this)'/>";
        document.getElementById('row_COUNT').value =  document.getElementById("myTable").rows.length-1;
    }else{
       alert('Note text box empty.');
    }
}

function deleteRow(n){ // this fuction is Delete Row(s) in table
        //alert(n);
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
                elementA.value = y;
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
    
    function popup(x){
		if(x==1){
			var mydataGried;
			mydataGried= new XMLHttpRequest();
			mydataGried.onreadystatechange=function(){
				if(mydataGried.readyState==4){
					document.getElementById('getGried').innerHTML=mydataGried.responseText;  
					document.getElementById('outer').style.visibility = "visible";
					document.getElementById('conten').style.visibility = "visible";           
				}
			}
			mydataGried.open("GET","ajax_Gried.php"+"?sr_gried="+x,true);
			mydataGried.send();
			/*document.getElementById('outer').style.visibility = "visible";
			document.getElementById('conten').style.visibility = "visible";*/
		
	  }else{
		document.getElementById('outer').style.visibility = "hidden";
		document.getElementById('conten').style.visibility = "hidden";
	  }	
	}
	
	function selectDB(xx){
			var id1 = document.getElementById('txt1'+xx).value;
			var id2 = document.getElementById('txt2'+xx).value;
			//alert(id1);
			//alert(id2);
			document.getElementById('txt_inner_User1').value = id1;
			document.getElementById('txt_inner_User2').value = id2;
	}
	
	function fileSelect(){
		var mydata5;
		mydata5= new XMLHttpRequest();
		mydata5.onreadystatechange=function(){
			if(mydata5.readyState==4){
				document.getElementById('getNewtblPopup').innerHTML=mydata5.responseText;
			}
		}
		var searchup=document.getElementById('popupsearch').value;
		mydata5.open('GET','ajaxEntryPopu1.php'+'?txtsearch='+searchup,true);
		mydata5.send();
  }
    
    function is_displyInnerGroup(){
        if(document.getElementById("chk_innnr").checked==true){
			document.getElementById("interDiv").style.display = "inherit";
	   }else{
            document.getElementById("interDiv").style.display = "none";
            document.getElementById("txt_Branch").value = "";
            document.getElementById("txt_Department").value = "";
            document.getElementById('txt_Department').style.visibility = "hidden";
            document.getElementById("txt_inner_User1").value = "";
            document.getElementById("txt_inner_User2").value = "";
            document.getElementById("inner_Remark").value = ""; 
	   }
    }
    
    
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
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
    <td style="width: 100px; text-align: right;"><label class="linetop">Category :</label></td>
    <td>
         <select class="box_decaretion"  style="width: 200px;" name="sel_catagory" id="sel_catagory" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" title="1" onchange="is_getScat_01(this.id,title);">
            <option value="">--Select Catagory --</option>
            <?php
                
                $v_sql_getCategory = "SELECT `cat_code`,`cat_discr` 
                                        FROM `cat_states` 
                                       WHERE `car_state` = '1' AND 
                                             `isDisplay` = '1' AND
                                             `cat_code` IN ('1024');";
                
                $que_getCategory = mysqli_query($conn,$v_sql_getCategory);
                while($RES_getCategory = mysqli_fetch_array($que_getCategory)){
                    echo "<option value=".$RES_getCategory[0].">".$RES_getCategory[1]."</option>";
                }
            ?>
         </select>
    </td>
    <td>
        <div id="diva">
             <select class="box_decaretion"  style="width: 200px;" name="sel_scat01" id="sel_scat01" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" disabled="disabled">
                <option value="">--Select Sub Catagory 1--</option>
             </select>
         </div>
    </td>
    <td>
        <div id="divb">
             <select class="box_decaretion"  style="width: 200px;" name="sel_scat02" id="sel_scat02" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" disabled="disabled">
                <option value="">--Select Sub Catagory 2--</option>
             </select>
        </div>
    </td>
    <td>
        <div id="divz">
             <select class="box_decaretion"  style="width: 200px;" name="sel_scat03" id="sel_scat03" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" disabled="disabled">
                <option value="">--Select Sub Catagory 3--</option>
             </select>
        </div>
    </td>
  </tr>
</table>
<table id="get_issue">  
  <tr>
    <td style="width: 100px; text-align: right;"><label class="linetop">Request/ Issue :</label></td>
    <td>
        <input class="box_decaretion" type="text"  style="width:400px;" name="txt_issue" id="txt_issue" value="" onKeyPress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" required="required" />
    </td>
  </tr>
  <tr>
    <td style="width: 100px; text-align: right; vertical-align: top;"><label class="linetop">Description :</label></td>
    <td>
         <textarea class="box_decaretion" cols="47" rows="4" style="height:100px; width: 400px; font-family: sans-serif;" name="txt_Description" id="txt_Description" onKeyPress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" required="required"></textarea>
    </td>
  </tr>
</table>
<table>
  <tr>
    <td style="width: 100px; text-align: right;"><label class="linetop">States :</label></td>
    <td>
        <select class="box_decaretion"  style="width: 200px;" name="sel_States" id="sel_States" onKeyPress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
           
            <?php
                //<option value="">--Select States --</option>
                $v_sql_States = "SELECT `cmb_code`,`cmb_discr` FROM `cmb_states` WHERE `cmb_state` = 1 AND `cmb_code` = '5001' ;";
                $que_getStates = mysqli_query($conn,$v_sql_States);
                while($RES_getStates = mysqli_fetch_array($que_getStates)){
                    echo "<option value=".$RES_getStates[0].">".$RES_getStates[1]."</option>";
                }
            ?>
         </select>
    </td>
  </tr>
  <tr>
    <td style="width: 100px; text-align: right;"><label class="linetop">Urgency :</label></td>
    <td>
        <select class="box_decaretion"  style="width: 200px;" name="sel_Urgency" id="sel_Urgency" onKeyPress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
           
             <?php
                 //<option value="">--Select Urgency --</option>
                $v_sql_Urgency = "SELECT `ur_code`,`ur_discr` FROM `urgency_states` WHERE `ur_state` = 1 ORDER BY ur_code DESC;";
                $que_getUrgency = mysqli_query($conn,$v_sql_Urgency);
                while($RES_getUrgency = mysqli_fetch_array($que_getUrgency)){
                    echo "<option value=".$RES_getUrgency[0].">".$RES_getUrgency[1]."</option>";
                }
            ?>
         </select>
    </td>
  </tr>
  <tr>
    <td style="width: 100px; text-align: right;"><label class="linetop">Priority :</label></td>
    <td>
        <select class="box_decaretion"  style="width: 200px;" name="sel_Priority" id="sel_Priority" onKeyPress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
            
            <?php
            //<option value="">--Select Priority --</option>
                $v_sql_Priority = "SELECT `pr_code`,`pr_discr` FROM `priority_states` WHERE `pr_state` = 1;";
                $que_getPriority = mysqli_query($conn,$v_sql_Priority);
                while($RES_getPriority = mysqli_fetch_array($que_getPriority)){
                    echo "<option value=".$RES_getPriority[0].">".$RES_getPriority[1]."</option>";
                }
            ?>
         </select>
    </td>
  </tr>
  <tr>
    <td style="width: 100px; text-align: right;"><label class="linetop">Source of Iss. :</label></td>
    <td>
        <select class="box_decaretion"  style="width: 200px;" name="sel_Source" id="sel_Source" onKeyPress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
            
            <?php
            //<option value="">--Select Priority --</option>
                $v_sql_Source = "SELECT `s_type`,`s_descript` FROM `cdb_soarce_of_issue` WHERE `s_stats` = 1;";
                $que_getSource = mysqli_query($conn,$v_sql_Source);
                while($RES_getSource = mysqli_fetch_array($que_getSource)){
                    echo "<option value=".$RES_getSource[0].">".$RES_getSource[1]."</option>";
                }
            ?>
         </select>
    </td>
  </tr>
  <tr>
    <td style="width: 100px; text-align: right;"><label class="linetop">Enterd User :</label></td>
    <td>
        <input class="box_decaretion" type="text"  style="width:200px; color: #747474; background: #D3D3D3;" name="txt_User" id="txt_User" value="<?php echo $_SESSION['user']; ?>" onKeyPress="return disableEnterKey(event)" readonly="readonly"/>
    </td>
  </tr>
  <tr>
    <td style="width: 100px; text-align: right;"><label class="linetop">Attachment :</label></td>
    <td>
       <input class="buttonManage" type="file" name="fileAttachment" id="fileAttachment" />
    </td>
  </tr>
</table>
<table>
  <tr>
    <td style="width: 100px; text-align: right; vertical-align: top;"><label class="linetop">Add Note :</label></td>
    <td>
        <table border="1" id="myTable" style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
            <tr style="background-color: #BEBABA;">
                <td style="width:50px;">#</td>
                <td style="width:600px;">Notes</td>
                <td style="width:30px;"></td>
            </tr>
            <tr>
                <td style="width:50px;"><input style="width:50px; text-align: right;" type="text" name="txta1" id="txta1" value="1"  onKeyPress="return disableEnterKey(event)" readonly="readonly"/></td>
                <td style="width:600px;"><input style="width:600px;" type="text" name="txtb1" id="txtb1" value=""  onKeyPress="return disableEnterKey(event)" /></td>
                <td style="width:30px;"><img src="../../../img/dele.png" style=" width:15px;" onclick="deleteRow(this)"/></td>
            </tr>
        </table>
        <div style="display: none;">
           <input type="text" name="row_COUNT" id="row_COUNT" value="1" onKeyPress="return disableEnterKey(event)"/> 
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
    <td style="width: 100px; text-align: right;"><label class="linetop">Intermediate Contact: </label></td>
    <td>
        <input class="box_decaretion" type="checkbox" name="chk_innnr" id="chk_innnr"   onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onclick="is_displyInnerGroup();" />
    </td>
  </tr>
</table>
<div id="interDiv" style="display: none;">
<fieldset>
<legend><label class="linetop">Intermediate Contact:</label></legend>
<table style="margin-left: 100px;">
  <tr>
    <td>
         <select class="box_decaretion"  style="width: 200px;" name="txt_Branch" id="txt_Branch" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" title="3" onchange="is_getScat_01(this.id,title);">
            <option value="">--Select Branch --</option>
             <?php
                $v_sql_Branch = "SELECT `branchNumber`,`branchName` FROM `branch`;";
                $que_getBranch = mysqli_query($conn,$v_sql_Branch);
                while($RES_getBranch = mysqli_fetch_array($que_getBranch)){
                    echo "<option value=".$RES_getBranch[0].">".$RES_getBranch[1]."</option>";
                }
            ?>
         </select>
    </td>
    <td>
        <div id="divc">
         <select class="box_decaretion"  style="width: 200px;" name="txt_Department" id="txt_Department" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
            <option value="">--Select Department--</option>
         </select>   
         </div>
    </td>
    </tr>
</table>
<table>
    <tr>
    <td style="width: 93px; text-align: right; vertical-align: top;">
        <label class="linetop">Inter. User :</label>
    <td>   
    <td>
        <div style="display: none;">
           <input type="text" name="txt_inner_User1" id="txt_inner_User1" value="" onkeypress="return disableEnterKey(event)"/> 
        </div>
        <input class="box_decaretion" type="text"  style="width:600px; color: #747474; background: #F2F2F2;" name="txt_inner_User2" id="txt_inner_User2" value="" onKeyPress="return disableEnterKey(event)" readonly="readonly" placeholder="User Name" onclick="popup(1);"  />
        <input type="button" class="buttonManage" id="btnPopUp" name="btnPopUp" value="..." onclick="popup(1);"/>
    </td>
  </tr>
  <tr>
    <td style="width: 93px; text-align: right; vertical-align: top;">
        <label class="linetop">Inter. Remark :</label>
    <td>   
    <td>
        <textarea class="box_decaretion"  cols="47" rows="4" style="height:100px; width: 400px;" name="inner_Remark" id="inner_Remark" onKeyPress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"></textarea>
    </td>
  </tr>
</table>
</fieldset>
</div>
<br />
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

function isUniquc_Validator($conn,$scat_code_2,$issue){
    $sql_val = "SELECT COUNT(*) FROM cdb_helpdesk AS c where c.scat_code_2 = '".$scat_code_2."' AND c.issue = '".$issue."';";
    $que_val = mysqli_query($conn,$sql_val) or die(mysqli_error($conn));
    while($rec_val = mysqli_fetch_array($que_val)){
        return $rec_val[0];
    }
}

if(isset($_POST['btnSave']) && $_POST['btnSave']=='Save'){
        mysqli_autocommit($conn,FALSE);
        try{
            $isUniquc = 0;
            $isValidator = 0;

            if(trim($_SESSION['user'])!=""){
                if(trim($_POST['sel_catagory']) != "" && trim($_POST['sel_scat01']) != "" && trim($_POST['sel_scat02']) != "" && trim($_POST['txt_issue']) != "" && trim($_POST['txt_Description']) != "" && trim($_POST['sel_States']) != "" && trim($_POST['sel_Urgency']) != "" && trim($_POST['sel_Priority'])){
                    $sql_isUniquc = "SELECT s2.isUnique FROM scat_02 AS s2 WHERE s2.scat_code_2 = '".trim($_POST['sel_scat02'])."' AND s2.isUnique = 1;";
                    $que_isUniquc = mysqli_query($conn,$sql_isUniquc) or die(mysqli_error($conn));
                    while($rec_isUniquc = mysqli_fetch_array($que_isUniquc)){
                        $isUniquc = $rec_isUniquc[0];
                        $isValidator = isUniquc_Validator($conn,trim($_POST['sel_scat02']),trim($_POST['txt_issue']));
                    }
                
                    if($isValidator > 0){ // Record is already available
                        echo "<script> alert('This issue is already exists. Unique Constraint.');</script>"; 
                    } 
                    
                }
            }
            
            // Validation rule engine
            if(trim($_SESSION['user'])!=""){
                if(trim($_POST['sel_catagory']) != "" && trim($_POST['sel_scat01']) != "" && trim($_POST['sel_scat02']) != "" && trim($_POST['txt_issue']) != "" && trim($_POST['txt_Description']) != "" && trim($_POST['sel_States']) != "" && trim($_POST['sel_Urgency']) != "" && trim($_POST['sel_Priority']) && $isValidator == 0 ){
                    $TableID = "";
                    $hetCheck = 0;
                    $_SESSION['fileAttachment'] = "";
                    $sql = "SELECT `currentDate` FROM `systemdate` WHERE `index`='1'";
    				$add = mysqli_query($conn,$sql);
    				while ($rec = mysqli_fetch_array($add)){
    					$_SESSION['CURRENT_DATE'] = $rec[0];
    				}
    // -----------------------------------------------------------------------------------------------------------------------------------------------------                


//-------------------------------------------------------------------------------------------------------------------------------------------------------
                    $Current_Year = date("Y" , strtotime($_SESSION['CURRENT_DATE']));
                    $sqlFunction ="SELECT GetNextSerial('m6',".$Current_Year.") FROM DUAL";    //Create the Unique Bokking Reference [Year wise]
                    $quary_Function = mysqli_query($conn,$sqlFunction);
                    while ($rec_Function = mysqli_fetch_array($quary_Function)){
			            $batch_num = $rec_Function[0]; 
                    }
                    $TableID = $Current_Year.str_pad($batch_num, 6, '0', STR_PAD_LEFT); //This will return 2014000001 as first number for 2014 and 20150001 in 2015
                    //-------------------------------------------------------
                
                    $DefaultPassword = "";
                    function randomPassword() {
                        $alphabet = 'abcdefghijklmnopqrstuvwxyz';
                        $pass = array(); //remember to declare $pass as an array
                        $alphaLength = 4; //put the length -1 in cache
                        for ($i = 0; $i < 4; $i++) {
                            $n = rand(0, $alphaLength);
                            $pass[] = $alphabet[$n];
                        }
                        
                        $Signs = '@#$%*()+=[{]}\|/?';
                        $passS = array(); //remember to declare $pass as an array
                        $alphaLength = 1; //put the length -1 in cache
                        for ($i = 0; $i < 1; $i++) {
                            $n = rand(0, $alphaLength);
                            $passS[] = $Signs[$n];
                        }
                                            
                        $digits = '1234567890';
                        $passD = array(); //remember to declare $pass as an array
                        $alphaLength = 4; //put the length -1 in cache
                        for ($i = 0; $i < 4; $i++) {
                            $n = rand(0, $alphaLength);
                            $passD[] = $digits[$n];
                        }
                        
                        return ucwords(implode($pass)).implode($passS).implode($passD); //turn the array into a string
                    }
                    
                    if(trim($_POST['sel_scat02']) == "200115") 
                        $DefaultPassword = randomPassword();
                    //-------------------------------------------------------
                
                // Attachemt Uploaded..............................................................................
                $getUploadStates = is_upload_file($conn,$TableID);
                if($getUploadStates == 1){
                    echo "<script> alert('maximum file size. < 2MB >');</script>";
                }else{
                    if($getUploadStates == 2){
                        echo "<script> alert('already exists. File Error.');</script>";   
                    }else{
                        if($getUploadStates == 3){
                            echo "<script> alert('already exists. Path.');</script>";
                        }else{
                            if(isset($_POST['chk_innnr'])){
                                $hetCheck = 1;
                            }
                            if($getUploadStates == 4){
                                $getUploadStates = "";
                            }
                            $usrDf = "";
                            $v_get_Def_User = "SELECT `DefuserID` , `scat_discr_2` FROM `scat_02` 
                                                WHERE `cat_code` = '".trim($_POST['sel_catagory'])."' AND
                                                        `scat_code_1` = '".trim($_POST['sel_scat01'])."' AND 
                                                        `scat_code_2` = '".trim($_POST['sel_scat02'])."';";
                            $que_get_Def_User = mysqli_query($conn,$v_get_Def_User) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
                            while($RES_get_User = mysqli_fetch_assoc($que_get_Def_User)){
                                $usrDf = $RES_get_User['DefuserID'];
                                $scat_discr_2 =  $RES_get_User['scat_discr_2'];
                            }
                            //if(trim($_POST['sel_scat03'])=="20011502" || trim($_POST['sel_scat03'])=="20011504") $usrDf = "01005278"; //Marketing officer creation goes to Maneesha
							
							// Start ..... By Rizvi Added on 20-Oct-2016 to handle the same request for different assign user for dif branchName`
							/*if ($usrDf =='01BRANCH'){
								$SQL_BRWISE_USER = "select DefuserID from defuserforbranchreq df  where branchNumber = '".$_SESSION['userBranch']."' and scat_code_2 = ".trim($_POST['sel_scat02']).";";
								$RS_GetBrWiseDefaultUser = mysqli_query($conn,$SQL_BRWISE_USER) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
								while($t_RS_GetBrWiseDefaultUser = mysqli_fetch_assoc($RS_GetBrWiseDefaultUser)){
									$usrDf = $t_RS_GetBrWiseDefaultUser['DefuserID'];
								}
							}*/
                            // End of ........ By Rizvi Added on 20-Oct-2016 to handle the same request for different assign user for dif branchName`
							 
                            /*
                            $v_getSQL_insert = "INSERT INTO `cdb_helpdesk`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`,`entry_branch`,`entry_department`,`s_type`,`scat_code_3`,`asing_by`,`ipAddress`,`defPassword`,`ssb_facility_amount`) 
                                                VALUES ('".$TableID."', '".trim($_POST['sel_catagory'])."', '".trim($_POST['sel_scat01'])."', '".trim($_POST['sel_scat02'])."', '".trim($_POST['sel_States'])."', '".trim($_POST['sel_Urgency'])."', '".trim($_POST['sel_Priority'])."', '".trim($_POST['txt_issue'])."', '".trim($_POST['txt_Description'])."', '".$_SESSION['user']."', now(),'".$getUploadStates."','".trim($_POST['txt_Branch'])."', '".trim($_POST['txt_Department'])."', '".trim($_POST['txt_inner_User1'])."','".trim($_POST['inner_Remark'])."','".$hetCheck."','".$_SESSION['userBranch']."','".$_SESSION['userDepartment']."','".trim($_POST['sel_Source'])."','".trim($_POST['sel_scat03'])."','".$usrDf."','".$_SESSION['userIP']."','". $DefaultPassword ."','".trim($_POST['txt_facAmount'])."');";
                            $que_getSQL_insert = mysqli_query($conn,$v_getSQL_insert) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
                            $v_getSQL_insert_1 = "INSERT INTO `cdb_helpdesk_his`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`,`entry_branch`,`entry_department`,`s_type`,`scat_code_3`,`asing_by`,`ipAddress`,`ssb_facility_amount`)
                                                 VALUES ('".$TableID."', '".trim($_POST['sel_catagory'])."', '".trim($_POST['sel_scat01'])."', '".trim($_POST['sel_scat02'])."', '".trim($_POST['sel_States'])."', '".trim($_POST['sel_Urgency'])."', '".trim($_POST['sel_Priority'])."', '".trim($_POST['txt_issue'])."', '".trim($_POST['txt_Description'])."', '".$_SESSION['user']."', now(),'".$getUploadStates."','".trim($_POST['txt_Branch'])."', '".trim($_POST['txt_Department'])."', '".trim($_POST['txt_inner_User1'])."','".trim($_POST['inner_Remark'])."','".$hetCheck."','".$_SESSION['userBranch']."','".$_SESSION['userDepartment']."','".trim($_POST['sel_Source'])."','".trim($_POST['sel_scat03'])."','".$usrDf."','".$_SESSION['userIP']."','".trim($_POST['txt_facAmount'])."');";
                            $que_getSQL_insert_1 = mysqli_query($conn,$v_getSQL_insert_1) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
                             */
                             $validateCount = 0;
                             
                             $usrDf = "";
                            //$query_Auth_Very = mysqli_query($conn ,"SELECT `auth_verified` FROM `scat_02` WHERE `cat_code` = '".trim($_POST['sel_catagory'])."' AND  `scat_code_1` = '".trim($_POST['sel_scat01'])."' AND `scat_code_2` = '".trim($_POST['sel_scat02'])."';") or die(mysqli_error($conn));
                            $txt_issue = mysqli_real_escape_string($conn,trim($_POST['txt_issue']));
                            //trim($_POST['txt_Description'])
                            $txt_Description = mysqli_real_escape_string($conn,trim($_POST['txt_Description']));
                            //while($rec_Auth_Very = mysqli_fetch_array($query_Auth_Very)){
                              /*  if($rec_Auth_Very[0] == 1){
                                    $validateCount = 1;
                                    $v_getSQL_insert = "INSERT INTO `cdb_helpdesk`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`,`entry_branch`,`entry_department`,`s_type`,`scat_code_3`,`asing_by`,`ipAddress`,`defPassword`,`ssb_facility_amount`,`init_enrty_by`,`init_enrty_on`,`branch_auth_by`,`branch_auth_on`) 
                                                                           VALUES ('".$TableID."', '".trim($_POST['sel_catagory'])."', '".trim($_POST['sel_scat01'])."', '".trim($_POST['sel_scat02'])."', '5000', '".trim($_POST['sel_Urgency'])."', '".trim($_POST['sel_Priority'])."', '".$txt_issue."', '".$txt_Description."', '".$_SESSION['user']."', now(),'".$getUploadStates."','".trim($_POST['txt_Branch'])."', '".trim($_POST['txt_Department'])."', '".trim($_POST['txt_inner_User1'])."','".trim($_POST['inner_Remark'])."','".$hetCheck."','".$_SESSION['userBranch']."','".$_SESSION['userDepartment']."','".trim($_POST['sel_Source'])."','".trim($_POST['sel_scat03'])."','".$usrDf."','".$_SESSION['userIP']."','". $DefaultPassword ."','".trim($_POST['txt_facAmount'])."','".$_SESSION['user']."',NOW(),'','0000-00-00 00:00:00');";
                                    //	echo $v_getSQL_insert;
									$que_getSQL_insert = mysqli_query($conn,$v_getSQL_insert) or die(mysqli_error($conn));
									$v_getSQL_insert_1 = "INSERT INTO `cdb_helpdesk_his`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`,`entry_branch`,`entry_department`,`s_type`,`scat_code_3`,`asing_by`,`ipAddress`,`ssb_facility_amount`,`init_enrty_by`,`init_enrty_on`,`branch_auth_by`,`branch_auth_on`)
                                                            VALUES ('".$TableID."', '".trim($_POST['sel_catagory'])."', '".trim($_POST['sel_scat01'])."', '".trim($_POST['sel_scat02'])."', '5000', '".trim($_POST['sel_Urgency'])."', '".trim($_POST['sel_Priority'])."', '".$txt_issue."', '".$txt_Description."', '".$_SESSION['user']."', now(),'".$getUploadStates."','".trim($_POST['txt_Branch'])."', '".trim($_POST['txt_Department'])."', '".trim($_POST['txt_inner_User1'])."','".trim($_POST['inner_Remark'])."','".$hetCheck."','".$_SESSION['userBranch']."','".$_SESSION['userDepartment']."','".trim($_POST['sel_Source'])."','".trim($_POST['sel_scat03'])."','".$usrDf."','".$_SESSION['userIP']."','".trim($_POST['txt_facAmount'])."','".$_SESSION['user']."',NOW(),'','0000-00-00 00:00:00');";
									//echo $v_getSQL_insert_1;
									$que_getSQL_insert_1 = mysqli_query($conn,$v_getSQL_insert_1) or die(mysqli_error($conn));	
                                    
                                    echo "<script> alert('A');</script>";
                                }else{*/
                                    $validateCount = 0;
                                    $v_getSQL_insert = "INSERT INTO `cdb_helpdesk`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`,`entry_branch`,`entry_department`,`s_type`,`scat_code_3`,`asing_by`,`ipAddress`,`defPassword`,`ssb_facility_amount`) 
                                                VALUES ('".$TableID."', '".trim($_POST['sel_catagory'])."', '".trim($_POST['sel_scat01'])."', '".trim($_POST['sel_scat02'])."', '".trim($_POST['sel_States'])."', '".trim($_POST['sel_Urgency'])."', '".trim($_POST['sel_Priority'])."', '".$txt_issue."', '".$txt_Description."', '".$_SESSION['user']."', now(),'".$getUploadStates."','".trim($_POST['txt_Branch'])."', '".trim($_POST['txt_Department'])."', '".trim($_POST['txt_inner_User1'])."','".trim($_POST['inner_Remark'])."','".$hetCheck."','".$_SESSION['userBranch']."','".$_SESSION['userDepartment']."','".trim($_POST['sel_Source'])."','".trim($_POST['sel_scat03'])."','".$usrDf."','".$_SESSION['userIP']."','". $DefaultPassword ."','".trim($_POST['txt_facAmount'])."');";
                                    $que_getSQL_insert = mysqli_query($conn,$v_getSQL_insert) or die(mysqli_error($conn));
                                    $v_getSQL_insert_1 = "INSERT INTO `cdb_helpdesk_his`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`,`entry_branch`,`entry_department`,`s_type`,`scat_code_3`,`asing_by`,`ipAddress`,`ssb_facility_amount`)
                                                 VALUES ('".$TableID."', '".trim($_POST['sel_catagory'])."', '".trim($_POST['sel_scat01'])."', '".trim($_POST['sel_scat02'])."', '".trim($_POST['sel_States'])."', '".trim($_POST['sel_Urgency'])."', '".trim($_POST['sel_Priority'])."', '".$txt_issue."', '".$txt_Description."', '".$_SESSION['user']."', now(),'".$getUploadStates."','".trim($_POST['txt_Branch'])."', '".trim($_POST['txt_Department'])."', '".trim($_POST['txt_inner_User1'])."','".trim($_POST['inner_Remark'])."','".$hetCheck."','".$_SESSION['userBranch']."','".$_SESSION['userDepartment']."','".trim($_POST['sel_Source'])."','".trim($_POST['sel_scat03'])."','".$usrDf."','".$_SESSION['userIP']."','".trim($_POST['txt_facAmount'])."');";
                                    $que_getSQL_insert_1 = mysqli_query($conn,$v_getSQL_insert_1) or die(mysqli_error($conn));
                                   // echo "<script> alert('B');</script>";
                              //  }
                            //}
                            
                            
                            
                            
                            for($y = 1 ; $y <= trim($_POST['row_COUNT']) ; $y++){
                                if(trim($_POST['txtb'.$y])!= ""){
                                    $v_getSQL_Note =  "INSERT INTO `cdb_help_note`(`helpid`, `note_code`, `note_discr`, `enterBy`, `enterDateTime`,`NoteTag`) VALUES ('".$TableID."','".$y."','".trim($_POST['txtb'.$y])."','".$_SESSION['user']."',now(),'SERVICE_REQ');";
                                    $que_getSQL_Note = mysqli_query($conn,$v_getSQL_Note) or die(mysqli_error($conn));
                                 }
                            }
                            
                            $sql_edfu = "SELECT `DefuserID` FROM `scat_02` WHERE `cat_code`='".trim($_POST['sel_catagory'])."' AND `scat_code_1`='".trim($_POST['sel_scat01'])."' AND `scat_code_2` = '".trim($_POST['sel_scat02'])."';";
                            $que_edrf = mysqli_query($conn,$sql_edfu);
                            while($RES_edrf = mysqli_fetch_assoc($que_edrf)){

								if ($RES_edrf['DefuserID'] =='01BRANCH'){
									$sql_email = "SELECT `email` FROM `user` WHERE `userName` = '".$usrDf."';";
								}else {
									$sql_email = "SELECT `email` FROM `user` WHERE `userName` = '".$RES_edrf['DefuserID']."';";
								}
                                $que_email = mysqli_query($conn,$sql_email);
                                if(mysqli_num_rows($que_email) > 0){
               					    while($RES_email = mysqli_fetch_assoc($que_email)){
                       	                $getmail = $RES_email['email'];
                       	            }
                                    $sql_uName = "SELECT `userID`,`GSMNO` FROM `user` WHERE `userName`='".$_SESSION['user']."';";
                                    $que_uName = mysqli_query($conn,$sql_uName);
                                    while($RES_uName = mysqli_fetch_assoc($que_uName)){
                                        $getUName = $RES_uName['userID'];
                                        $getTP = $RES_uName['GSMNO'];
                                    }
                                    $sql_uDepart = "SELECT `deparmentName` FROM `deparment` WHERE `deparmentNumber`='".$_SESSION['userDepartment']."' AND `branchNumber` = '".$_SESSION['userBranch']."';";
                                    $que_uDepa = mysqli_query($conn,$sql_uDepart);
                                    while($RES_udep = mysqli_fetch_assoc($que_uDepa)){
                                        $getUBranch = $RES_udep['deparmentName'];
                                    } 
                                    $title = "CDB Help Desk : New service request";
                                    /*$mail = "New Service Request : ".$TableID."---<".trim($_POST['txt_issue']).">\n\n From : ".$_SESSION['user']."--".$getUName."\n\n";
                                    $mail .= "Branch :".$_SESSION['userBranchName']."\\n\\n";
                                    $mail .= "Department :".$getUBranch;*/
$mail = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<table border='1'>
	<tr>
        <td style='width:200px; text-align:left; padding-left:5px'>New Service Request</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$TableID."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Issue</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".trim($_POST['txt_issue'])."</td>
    </tr>
     <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>From (User)</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$_SESSION['user']."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>&nbsp;</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$getUName."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Branch</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$_SESSION['userBranchName']."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>Department</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$getUBranch."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>User IP</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$_SESSION['userIP']."</td>
    </tr>
    <tr>
        <td style='width:200px; text-align:left; padding-left:5px'>User Telephone</td>
        <td style='width:400px; text-align:left; padding-left:5px'>".$getTP."</td>
    </tr>
 </table>
</body>
</html>";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		
						// More headers
$headers .= 'From: <cdberp@cdbnet.lk>' . "\r\n";
                //sendMail($getmail,$title,$mail,$headers);    
if($validateCount == 0){
    sendMailNuw($getmail,$title,$mail,$headers); 
}

                                }
                            }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// - Pat pat lease send sms - developed by madusha 2017-02-22
/*$sql_cou_cycal = "SELECT s3.DefuserID , u.GSMNO , s3.scat_discr_3
FROM scat_03 AS s3 , user AS u 
WHERE s3.DefuserID = u.userName 
	and s3.cat_code = '1024'
    and s3.scat_code_2 = '".trim($_POST['sel_scat02'])."'
    and s3.scat_code_3 = '".trim($_POST['sel_scat03'])."';";*/
    
   // echo "<script> alert('C');</script>";
 
 $sql_pppp = "INSERT INTO `patpat_inq`(`helpid`, `scat_code_2`, `scat_code_3`) 
                    VALUES ('".$TableID."','".trim($_POST['sel_scat02'])."','".trim($_POST['sel_scat03'])."');";
                  //  echo $sql_pppp;
 mysqli_query($conn,$sql_pppp) or die(mysqli_error($conn)); 
   // echo "<script> alert('D');</script>";    
$sql_cou_cycal = "SELECT pu.userName , pu.GSMNO , pu.userID FROM user AS pu  WHERE pu.userName = '".trim($_POST['sel_scat03'])."';";

$query_cou_cycal = mysqli_query($conn,$sql_cou_cycal) or die(mysqli_error($conn)) ;
while($res_cou_cycal = mysqli_fetch_array($query_cou_cycal)){
    if ( substr($res_cou_cycal[1],0,2) =='07'){       
       // echo "<script> alert('E');</script>";
        $sql_sms = "INSERT INTO `CDB_SMS_INBOX`(`mobileno`, `message`, `idatetime`, `module`, `uevent`, `sent`) 
                    VALUES ('".$res_cou_cycal[1]."',CONCAT('PATPAT.LK Alert!".chr(10)."Ref :".$TableID.chr(10)."Client Contact Number :".trim($_POST['txt_issue']).chr(10)."".trim($_POST['txt_Description']).chr(10)."', now()),now(),'HELPDESK','PATPAT.LK',0);";
        $query_sms =  mysqli_query($conn,$sql_sms) or die(mysqli_error($conn)); 
             
             echo "<script> alert('".$sql_sms."');</script>";    
             //echo "<script> alert('F');</script>";                                              
    }
  //  echo "<script> alert('G');</script>";
    $sql_updatedef = "UPDATE `cdb_helpdesk` SET `asing_by` = '".$res_cou_cycal[0]."' WHERE `helpid` = '".$TableID."';";
    $query_updatedef =  mysqli_query($conn,$sql_updatedef) or die(mysqli_error($conn)); 
    
    $msgCus1 = $scat_discr_2." patpat.lk officer ".$res_cou_cycal[2]." (".$res_cou_cycal[1].") will contact you shortly."; 
    //$msgCus1 = "For any further clarifications please contact us through our 24 hour patpat.lk hotline,0117 449 999" ;
   // echo "<script> alert('H');</script>";
    if ( substr(trim($_POST['txt_issue']),0,2) =='07' && strlen(trim($_POST['txt_issue'])) == 10){                  
        /*$sql_sms = "INSERT INTO `CDB_SMS_INBOX`(`mobileno`, `message`, `idatetime`, `module`, `uevent`, `sent`) 
                    VALUES ('".trim($_POST['txt_issue'])."',CONCAT('PATPAT.LK Alert!".chr(10).$msgCus1.chr(10)."For any further clarifications please contact us through our 24 hour patpat.lk hotline,0117 449 999".chr(10)."', now()),now(),'HELPDESK','PATPAT.LK',0);";
        $query_sms =  mysqli_query($conn,$sql_sms) or die(mysqli_error($conn));        */                                            
    }
}


// - Call center inquary send sms - developed by madushan 2018-02-22
$sql_cou_cal = "SELECT s2.scat_code_2 ,
                           s2.scat_discr_2 ,
                           b.branchName ,
                           b.BOH,
                           (SELECT u1.GSMNO FROM user AS u1 WHERE u1.userName = b.BOH) AS BOH_TP ,
                           b.BOIC ,
                           (SELECT u2.email FROM user AS u2 WHERE u2.userName = b.BOIC) AS BOH_EMAIl 
                    FROM scat_02 AS s2 , branch AS b 
                    WHERE s2.scat_code_1 = 102402
                      AND s2.scat_code_2 = ".trim($_POST['sel_scat02'])."
                      AND s2.scat_discr_2 = b.branchName";
                      
$query_cou_call = mysqli_query($conn,$sql_cou_cal) or die(mysqli_error($conn)) ;
while($res_cou_call = mysqli_fetch_array($query_cou_call)){
    if ( substr($res_cou_call[4],0,2) =='07'){                  
        $sql_sms = "INSERT INTO `CDB_SMS_INBOX`(`mobileno`, `message`, `idatetime`, `module`, `uevent`, `sent`) 
                    VALUES ('".$res_cou_call[4]."',CONCAT('Call Center Inquiry Alert!".chr(10)."Ref : ".$TableID.chr(10)."Client Contact Number :".trim($_POST['txt_issue']).chr(10)."".trim($_POST['txt_Description']).chr(10)."', now()),now(),'HELPDESK','Call Center Inquiry',0);";
        $query_sms =  mysqli_query($conn,$sql_sms) or die(mysqli_error($conn)); 
                                                           
    }
    
    $sql_updatedef = "UPDATE `cdb_helpdesk` SET `asing_by` = '".$res_cou_call[3]."' WHERE `helpid` = '".$TableID."';";
    $query_updatedef =  mysqli_query($conn,$sql_updatedef) or die(mysqli_error($conn)); 
    
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  
                            mysqli_commit($conn); 
                            $stringMessage = "Service request submitted. \\n\\nYour SR Number : ".$TableID;
                            echo "<script> alert('". $stringMessage ."');pageClose();</script>";
                            $_SESSION['fileAttachment'] = ""; 
                        }
                    }
                }
                /*if($getUploadStates == 0){
                    echo "<script> alert('already exists".$getUploadStates."');</script>";
                }else{
                        
                }*/ 
            }else{
                if ($isValidator == 0)
                    echo "<script> alert('Some Values are missing.');</script>";  
            }
         }else{
                echo "Undefind User. Please re login.";  
            }
               
        }catch(Exception $e){
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
        }
    }
?>

<!-- ****************************************************************************************************************************************************** -->
<span id="getGried"></span>
<?php
	//serviceRequsestMaual_Gried_POPUP_1($conn);
?>
</form>
</body>
</html>

