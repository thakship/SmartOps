<!------------------------------------------------------------------------------------------------------------------------
Module Code		: DocLine
Page Name		: Document Request Sub
Purpose			: Document Request in Box
Author			: Madushan Wikramaarachchi
Date & Time		: 12.04 PM 18/12/2014
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="doc/e/007";
	$_SESSION['Module'] = "Doc Line System";
	include('../../pageasses.php');
	$ass = cakepageaccess();
	if($ass != 1){
		header('Location:../../home.php');
	}
	include('../../../php_con/includes/db.ini.php');
	include('../../../php_con/includes/Common.php');
	include('../../loguser.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Document Request Sub</title>
<!-- Common function Libariries -->
<!-- CSS-->
<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../DLS_DEVELOPMENT/CSS/docline _system_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../DLS_DEVELOPMENT/JAVASCRIPT_FUNCTION/docline_Sysem_JavaScript.js"></script>
<!--END Common fumction Libariries-->
<!-- Common function Libariries -->
<link type="text/css" href="../CSS CMS/comanGrid.css" rel="stylesheet"/>
<!-- Starts CDB User defined function here -->
<script src="jquery.btechco.excelexport.js"></script>
<script src="jquery.base64.js"></script>
<script>
    $(document).ready(function () {
        $("#btnExport").click(function () {
            $("#myTable").btechco_excelexport({
                //alert('Table');
                containerid: "myTable"
               , datatype: $datatype.Table
            });
        });
    });
</script>
<script type="text/javascript">
    function deleteRow(n){ // this fuction is Delete Row(s) in table
        //alert(n);
        var m=n.parentNode.parentNode.rowIndex;
        document.getElementById('myTable').deleteRow(m);
        var num1 = document.getElementById("myTable").rows.length;
        var num2 = num1 - 1;
        document.getElementById('txtrow').value = num2;
        document.getElementById('txtrow1').value = num2;
        var y = 1;
        var  rowcount = document.getElementById("myTable").rows.length;
        var i = rowcount-1;    
       	for(var mloop=2;mloop <=100;mloop++){
            var elementA =  document.getElementById('txta' + (mloop - 1));
            var elementB =  document.getElementById('txtb' + (mloop - 1));
            var elementC =  document.getElementById('txtc' + (mloop - 1));
            var elementD =  document.getElementById('txtd' + (mloop - 1));
            var elementE =  document.getElementById('txte' + (mloop - 1));
            if (elementA != null){
                // Re-order the sequence of the table rows.............
                elementA.value = y;
                //Changing the element ID's to capture in the php
                elementA.id = 'txta' + y;				  
                elementB.id = 'txtb' + y;
                elementC.id = 'txtc' + y;
                elementD.id = 'txtd' + y;
                elementE.id = 'txte' + y;
                //Changing the element name's to capture in the php				  
                elementA.name = 'txta' + y;				  
                elementB.name = 'txtb' + y;
                elementC.name = 'txtc' + y;
                elementD.name = 'txtd' + y;
                elementE.name = 'txte' + y;
                y++;
            }			
        }
    }
    
    function checkSelection(e){
        //alert(e);
        var http;  // The variable that makes Ajax possible! 
        var e=e || window.event;
        var keycode=e.which || e.keyCode;
        if(keycode!==1 || (e.target||e.srcElement).value=='') return false;
        try{ 
  		    // Opera 8.0+, Firefox, Safari 
      		http = new XMLHttpRequest(); 
  		}catch(ex){ 
  		    // Internet Explorer Browsers 
      		try{ 
				http = new ActiveXObject("Msxml2.XMLHTTP"); 
            }catch(ex){ 
  		        try{ 
          		    http = new ActiveXObject("Microsoft.XMLHTTP"); 
          		}catch(ex){ 
          		    // Something went wrong 
          		    alert("Your browser broke!"); 
              		return false; 
          		}
  		    }
  		}
        var isDuplicate = false;
        var v_code = 0;
        var rowNum = document.getElementById("myTable").rows.length - 1;
        var x = document.getElementById("myTable").rows.length
        var url = "getagentids.php?param1=";
        var idValue = document.getElementById("txtDocNumber").value;
        var idtype = document.getElementById("selDocType").value;
        for(var r=1; r < rowNum; r++){
            if((idValue == document.getElementById('txtc'+r).value) && (idtype == document.getElementById('txtd'+r).value)){
                isDuplicate = true;
                break;
            }
        }
					
		if(isDuplicate){
			alert("Document number and Document type cannot be duplicate.");
			return null;
		}
        if(isDuplicate == false){
        
        }else{
            alert("Account number cannot be duplicate in a box");
        }
            //var v_function =getValDetels(idValue,idtype);
            //alert(v_function);
       
            var myRandom = parseInt(Math.random()*99999999);  // cache buster
            http.open("GET", "getagentids.php?param1=" + escape(idValue) + "&param3=" +  escape(idtype)+ "&rand=" + myRandom, true);
            http.onreadystatechange = handleHttpResponse;   
            http.send(null);
            function handleHttpResponse(){
                if (http.readyState == 4){
                    results = http.responseText.split("|");
                    //alert('a'+results[0].trim());
                   
                    if(results[3].trim() == 1){
                      alert("This Documnet can not be sent. already in Branch. <"+results[4].trim()+">");  
                    }else{
                        if(results[0].trim()==""){
                            document.getElementById('txtDocNumber').value = idValue;
                            alert("This Documnet can not be sent!");
                        }else{
                             document.getElementById('txtb'+rowNum).value = results[0].trim();
                            document.getElementById('txtc'+rowNum).value = results[1].trim();
                            document.getElementById('txtd'+rowNum).value = results[2].trim();
                            var table=document.getElementById("myTable");
        					var row=table.insertRow(-1);
        					var cell1=row.insertCell(0);
        					var cell2=row.insertCell(1);
        					var cell3=row.insertCell(2);
        				 	var cell4=row.insertCell(3);
        				 	var cell5=row.insertCell(4);
        				 	var cell6=row.insertCell(5);
                                            
        					cell1.innerHTML="<input style='width:50px;' type='text' name='txta"+(x)+"' id='txta"+(x)+"' value='"+(x)+"' onKeyPress='return disableEnterKey(event)' readonly='readonly' />";
                            cell2.innerHTML="<input style='width:200px; color:#999999;' type='text' name='txtb"+(x)+"' id='txtb"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)' required='required' readonly='readonly'/>";           
                            cell3.innerHTML="<input style='width:200px; color:#999999;' type='text' name='txtc"+(x)+"' id='txtc"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)' required='required' readonly='readonly'/>";
        					cell4.innerHTML="<input style='width:200px; color:#999999;' type='text' name='txtd"+(x)+"' id='txtd"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)' required='required' readonly='readonly'/>";
                            cell5.innerHTML="<input type='checkbox' name='txte"+(x)+"' id='txte"+(x)+"' value='' onKeyPress='return disableEnterKey(event)' checked='checked'/>";
                            cell6.innerHTML="<img src='../../../img/dele.png' style='width:15px;' onclick='deleteRow(this)'/>";
                            
        					document.getElementById('txtrow').value = document.getElementById("myTable").rows.length-1;
        					document.getElementById('txtrow1').value = document.getElementById("myTable").rows.length-1;
                        }
                    }
                }
            }
       
    }
    
function getValDetels(idValue,idtype){
   var myRandom_1 = parseInt(Math.random()*99999999);  // cache buster
   http.open("GET", "getagentids.php?param7=" + escape(idValue) + "&param8=" +  escape(idtype)+ "&rand=" + myRandom_1, true);
   http.onreadystatechange = handleHttpResponse;   
   http.send(null);
   function handleHttpResponse(){
        if (http.readyState == 4){
            results1 = http.responseText.split("|");
            return results1[0]+"|"+results1[1];
        }
   }             
}
function getPrint(){
    var prtContent = document.getElementById("loadGrid1");
	var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
	WinPrint.document.write(prtContent.innerHTML);
	WinPrint.document.close();
	WinPrint.focus();
	WinPrint.print();
	WinPrint.close();
}
function getprintCopy(){
		var prtContent = document.getElementById("loadGrid1");
		var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
		WinPrint.document.write(prtContent.innerHTML);
		WinPrint.document.close();
		WinPrint.focus();
		WinPrint.print();
		WinPrint.close();
}
</script>
<style type="text/css">

</style>
</head>
<body oncontextmenu="return false">
<p class="topline">
<?php echo $_REQUEST['DispName']; ?> <!-- Current Page Header/Label -->
</p><hr />
<!-- Screen design will be started from here -->
<form action="" method="post">
<table>
  <tr>
    <td style="width:150px; text-align:right;"><p class="linetop">Document Number :</p></td>
    <td><input type="text" style="width:175px; font-family:Arial, Helvetica, sans-serif; border: 1px solid #000000;" id="txtDocNumber" name="txtDocNumber" maxlength="22" value="" onKeyPress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"/></td>
    <td ><select name="selDocType" style="width:150px; font-family:Arial, Helvetica, sans-serif; border: 1px solid #000000;" id="selDocType" onKeyPress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
            <option value="NULL">--Documnet Type--</option>
            <option value="RD">Reference Only</option>
            <option value="SD">Security Only</option>
         </select>
    </td>
    <td>
    <input type="button" id="btnRequestSelection" name="btnRequestSelection" value="Select" onclick="checkSelection(event)"/>
    </td>
  </tr>
</table>
<hr />
<table>
  <tr>
    <td><p class="linetop">Purpose Of Request : </p></td>
    <td><select name="selpaerpas" style="width:150px; font-family:Arial, Helvetica, sans-serif; border: 1px solid #000000;" id="selpaerpas" onKeyPress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" required>
     		<option value="">--Documnet Type--</option>
	 <?php
	 	$sql_pearps = "SELECT perpas_code,parpas_value FROM doc_line_perpase_requst WHERE perpas_code != 'PP003'";
		$quary_pearps = mysqli_query($conn,$sql_pearps);
		while ($rec_pearps = mysqli_fetch_array($quary_pearps)){
	 		echo "<option value='".$rec_pearps[0]."'>".$rec_pearps[1]."</option>";
	 	}
	 ?>
     </select> </td>
  </tr>
</table>
<div id="loadGrid1">
<table border="1" id="myTable"  style="width:750px;background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
    <tr class="tbl1">
        <td style="width:50px; text-align:left; padding-left:5px;">Index</td>
        <td style="width:200px; text-align:left; padding-left:5px;">Box Number</td>
        <td style="width:200px; text-align:left; padding-left:5px;">Document Number</td>
        <td style="width:100px; text-align:left; padding-left:5px;">Documnet Type</td>
        <td style="width:100px;">Confirm</td>
         <td style="width:100px;">&nbsp;</td>
     </tr>
     <tr class="tbl1" style="background: #FFFFFF;">
		<td style="width:50px;"><input style="width:50px;" type="text" name="txta1" id="txta1" value="1"  onKeyPress="return disableEnterKey(event)" readonly="readonly" /></td>
        <td style="width:200px;"><input style="width:200px; color:#999999;" type="text" name="txtb1" id="txtb1" value=""  onKeyPress="return disableEnterKey(event)" required="required" readonly="readonly"/></td>
        <td style="width:200px;"><input style="width:200px; color:#999999;" type="text" name="txtc1" id="txtc1" value=""  onKeyPress="return disableEnterKey(event)" required="required" readonly="readonly"/></td>
        <td style="width:100px;"><input style="width:200px; color:#999999;" type="text" name="txtd1" id="txtd1" value=""  onKeyPress="return disableEnterKey(event)" required="required" readonly="readonly"/></td>
        <td style="width:100px;"><input type="checkbox" name="txte1" id="txte1" value=""  onKeyPress="return disableEnterKey(event)" checked=" checked"/></td>
         <td style="width:100px;"><img src="../../../img/dele.png" style=" width:15px;" onclick="deleteRow(this)"/></td>
    </tr>
</table>
</div>
<table>
  <tr>
    <td style="width:170px;"><p class="linetop">Number of Document(s)</p></td>
  <td ><div style='display:none;'>
			<input type="text" name="txtrow" id="txtrow" value="1"/>
            <input type="text" name="txtuserID" id="txtuserID" value="<?php echo $_SESSION['user']; ?>"/>
        <input type="text" name="txtuserBranch" id="txtuserBranch" value="<?php echo $_SESSION['userBranch']; ?>"/>
        </div>
        <input type="text" style="width:40px;" name="txtrow1" id="txtrow1" value="1" disabled="disabled"/>
        
   </td>
  </tr>
</table>
<input type="submit" style="font-size:12px;" name="btnDocSave" id="btnDocSave" value="Confirm"/>
<!--<input type="button" style="width: 100px;" class='buttonManage' name="btnExport" id="btnExport" value="Excel"/>-->
<!--<input type="button" style="font-size:12px;" value="Print" name="btnRefresh" id="btnRefresh" onclick="getPrint()"/>-->
<input type="button" style="font-size:12px;" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
<!--<div id="getVal_txt">
    <input type="text" name="txt_sqy_typ" id="txt_sqy_typ" value="0"  onkeypress="return disableEnterKey(event)" readonly="readonly" />
    <input type="text" name="txt_sqy_branch" id="txt_sqy_branch" value=""  onkeypress="return disableEnterKey(event)" readonly="readonly" />
</div>-->
<?php
	 if(isset($_POST['btnDocSave']) && $_POST['btnDocSave']=='Confirm'){
		mysqli_autocommit($conn,FALSE);
			try{
				if(trim($_POST['txtrow'])!=0){
					$DocCouNum = "";
					 
					 for ($i = 1; $_POST['txtrow']>= $i; $i++){		//For each box
						if(isset($_POST['txte'.$i])){
							date_default_timezone_set('Asia/Colombo');
							
							// Update the box master
							$sql_FileStacUpdate = "UPDATE `doc_line_file_stack` SET `action_stat`='RQ' WHERE `box_number`='".trim($_POST['txtb'.$i])."' AND `doc_number`='".trim($_POST['txtc'.$i])."' AND `doc_type`='".trim($_POST['txtd'.$i])."' AND `action_stat`='ST'";
							$query_FileStacUpdate= mysqli_query($conn,$sql_FileStacUpdate)  or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
							
							//Insert new record(s) to document movement tables
							$sql_InsertStackHistory ="INSERT INTO `doc_line_stat_history`(`box_number`,`doc_number`, `doc_type`, `action_date_time`, `action_stat`, `action_user`, `perpas_code`,`branch_Numbar`) VALUES ('".trim($_POST['txtb'.$i])."','".trim($_POST['txtc'.$i])."','".trim($_POST['txtd'.$i])."',now(),'RQ','".trim($_POST['txtuserID'])."','".trim($_POST['selpaerpas'])."','".trim($_POST['txtuserBranch'])."');";						
							$rsInsertStackHistory =  mysqli_query($conn,$sql_InsertStackHistory)  or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
							
						}else{
						
						}
					 }
					mysqli_commit($conn);
					$getmail = GetParamValue(1,$conn);
					if($getmail != ""){
					   $sql_branch = "SELECT `branchName` FROM `branch` WHERE `branchNumber` = '".$_SESSION['userBranch']."';";
                        $que_branch = mysqli_query($conn,$sql_branch);
                        while($rec_branch = mysqli_fetch_array($que_branch)){
                            $userBranch_n = $rec_branch[0];
                        }
						$title = "Dcoument Request from :".$userBranch_n." By : ".$_SESSION['user'];
						$mail  = "";
						for ($i = 1; $_POST['txtrow']>= $i; $i++){		//For each box
							if(isset($_POST['txte'.$i])){
								$mail  = $mail."Box Num : ".chr(9).trim($_POST['txtb'.$i]).chr(9)."Doc Num : ".chr(9).trim($_POST['txtc'.$i]).chr(9)."Doc Type : ".chr(9).trim($_POST['txtd'.$i]).chr(13);
							}else{
							
							}
						}
						sendMail($getmail,$title,$mail);
					}else{
						echo "<script> alert('Null'); </script>";
					}
					
					echo "<script> alert('Request completed successfully !.');
									pageClose();
						</script>";
							
				}else{
					echo "<script> alert('Required information missing!'); </script>";
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