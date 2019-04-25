<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Courier Management System
Page Name		: Access Group Doc
Purpose			: To Access Group Doc
Author			: Madushan Wikramaarachchi
Date & Time		: 01.58 P.M 22/08/2014 (Modified)
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="cou/m/006";
	$_SESSION['Module'] = "Courier Management System";
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Access Group Doc</title>
<!-- Common function Libariries -->
<!-- CSS-->
<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../CMS_DEVELOPMENT/CSS/courier_Management_System_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../CMS_DEVELOPMENT/JAVASCRIPT_FUNCTION/courier_Management_System_JavaScript.js"></script>
<!--END Common fumction Libariries-->
<link type="text/css" href="../CSS CMS/comanGrid.css" rel="stylesheet"/>
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
	#outer1{
		visibility: hidden;
		position: fixed;
		left: 0px;
		top:0px;
		width: 100%;
		height: 100%;
		background: #6DA6E4;
		opacity: 0.7;
	}
	#conten1{
		position: fixed;
		margin-top:-150px;
		margin-left: -200px;
		top:50%;
		left:50%;
		visibility: hidden;
		z-index: 5;
		height:100px;
		overflow-y: scroll;
		border:#000000 solid 1px;
		background: #eeeeee; /* Old browsers */
		background: -moz-linear-gradient(top, #eeeeee 0%, #cccccc 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#eeeeee), color-stop(100%,#cccccc)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* IE10+ */
		background: linear-gradient(to bottom, #eeeeee 0%,#cccccc 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#eeeeee', endColorstr='#cccccc',GradientType=0 ); /* IE6-9 */
	}
</style>
<script type="text/javascript">
	function department(){
		if(document.getElementById('selBranchNumber').value==""){
			document.getElementById('selDepartmentNumber').disabled=false;
		}else{
			document.getElementById('selDepartmentNumber').disabled=true;
		}
		var mydata;
		mydata= new XMLHttpRequest();
		mydata.onreadystatechange=function(){
			if(mydata.readyState==4){
				document.getElementById('diva').innerHTML=mydata.responseText;
			}
		}
		var no=document.getElementById('selBranchNumber').value;
		mydata.open("GET","ajaxdemartmentselect.php"+"?txt1="+no,true);
		mydata.send();
	}
	function popup(x){
	  if(x==1){
		document.getElementById('outer').style.visibility = "visible";
		document.getElementById('conten').style.visibility = "visible";
	  }else{
		document.getElementById('outer').style.visibility = "hidden";
		document.getElementById('conten').style.visibility = "hidden";
	  }	
	}
	function popupa(y){
	  if(y==1){
		document.getElementById('outer1').style.visibility = "visible";
		document.getElementById('conten1').style.visibility = "visible";
	  }else{
		document.getElementById('outer1').style.visibility = "hidden";
		document.getElementById('conten1').style.visibility = "hidden";
	  }	
	}
	function getValue(obj){
    		//alert('id - ' + obj.id);
    		var txtIDnum = obj.id;
			var r = document.getElementById("myTable").rows.length;
			var r1 = r-1
			//alert(r1);
			document.getElementById('tx').value = txtIDnum;
			document.getElementById('ty').value = 'txtc'+r1;
	}
	
</script>
</head>
<body oncontextmenu="return false">
<form action="" method="post">
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<table>
  <tr>
    <td style="width:150px;"><label class="linetop">Group Doc Description :</label></td>
    <td>
    <?php
		$selectGDN = "SELECT `groupCodeDoc`,`groupDetels` FROM `courier_groupdoctype`";
		$add_selectGDN = mysqli_query($conn,$selectGDN);
	?>
   <select class="box_decaretion" name="selCodeDoc" id="selCodeDoc" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
        <option value="">--Select Group Doc Description--</option>
        <?php
            while($recGDD = mysqli_fetch_array($add_selectGDN)){
                echo "<option value='".$recGDD[0]."'>".$recGDD[1]."</option>";
            }
        ?>
    </select> 
   </td>
  </tr>
</table>
<hr/>
<input class="buttonManage" type="button" onclick="displayResult()" value="Insert new row" id="rowNew" name="rowNew" />

<hr/>
<div id="outer">
		
	</div>
	<div id="conten">
		<p class="topline">Search Document 
        <input style="margin-left:200px; font-size: 12px;" type="button" onclick="popup(0)" value="Colse" id="popupclose" name="popupclose" />
        </p>
        <div style='display:none;'>
        <input style="width:100px;" type="text" name="tx" id="tx" value=""  onkeypress="return disableEnterKey(event)" readonly="readonly" required="required"/>
        <input style="width:100px;" type="text" name="ty" id="ty" value=""  onkeypress="return disableEnterKey(event)" readonly="readonly" required="required"/>
        </div>
        Search Document name : <input class="box_decaretion" style="width:200px; background-color:#E0E0E0;" type="text" name="popupsearch" id="popupsearch" value=""/> 
        <input class="buttonManage" type="button" value="Search" id="popupSearchBTN" name="popupSearchBTN" onclick="fileSelect()" />
        <br/>
        <br/>
        <div id="getNewtblPopup">
		<?php
            $viewDoc = "SELECT `documentNumber`,`documentName` FROM `courier_masters_document`";
            $sql_viewDoc = mysqli_query($conn,$viewDoc);
        ?>
        
        <table class="tbl1" border="1">
              <tr>
                <td style="text-align:center; padding-top:5px; padding-bottom:5; width:200px;">Document Number</td>
                <td style="text-align:center; padding-top:5px; padding-bottom:5;width:200px;">Document Name</td>
                <td style="text-align:center; padding-top:5px; padding-bottom:5;width:100px;">Access</td>
              </tr>
				<?php
                    $a = 1 ;
                    while ($add = mysqli_fetch_array($sql_viewDoc)){
                        echo "<script>
								function selectDB".$a."(){
									var id1 = document.getElementById('txt1".$a."').value;
									var newID = document.getElementById('tx').value;
									document.getElementById(newID).value = id1;
									var id2 = document.getElementById('txt2".$a."').value;
									var newName = document.getElementById('ty').value;
									document.getElementById(newName).value = id2;
								}
                              </script>";
                        echo "<tr style='background-color:#FFFFFF;'>";
                        echo "<td style='width:150px;'>
                              <div style='display:none;'>
                              <input class='txt' type='text' name='txt1".$a."' id='txt1".$a."' value='".$add[0]."'/></div> 
                              <input style='width:150px;' type='text' name='txt1".$a."' id='txt1".$a."' value='".$add[0]."' disabled='disabled'/></td>";
                        echo "<td style='width:200px;'>
                              <div id='divb".$a."' style='display:none;'>
                              <input class='txt' type='text' name='txt2".$a."' id='txt2".$a."' value='".$add[1]."'/></div>
                              <input style='width:200px;' type='text' name='txt2".$a."' id='txt2".$a."' value='".$add[1]."' disabled='disabled'/></td>";
                        echo "<td style='width:100px;'>";
                        echo "<input type='button' id='btnselect".$a."' name='btnselect".$a."' value='Select' onclick='selectDB".$a."();popup(0);'/>";
                        echo "</td>";
                        echo "</tr>";
                        $a++;
                    }
                ?>
			</table>
            </div>
	</div>
    <div id="newdoctb">
 <table width="921" border="1" id="myTable" style="width:800px;">
  <tr style="width:800px;" class="tbl1">
    <td width="100" style="width:100px;">Index</td>
    <td width="350" style="width:350px;">Document Number</td>
    <td width="449" style="width:350px;">Document Name</td>
    <td width="449" style="width:100px;"></td>
  </tr>
  <tr style="width:800px;">
    <td style="width:100px;"><input style="width:100px;" type="text" name="txta1" id="txta1" value="1"  onkeypress="return disableEnterKey(event)" readonly="readonly" required="required"/></td>
    <td style="width:350px;"><input style="width:350px;" type="text" name="txtb1" id="txtb1" value=""  onkeypress="return disableEnterKey(event)" onclick="popup(1);getValue(this);" readonly="readonly" required="required"/></td>
    <td style="width:350px;"><input style="width:350px;" type="text" name="txtc1" id="txtc1" value=""  onkeypress="return disableEnterKey(event)" readonly="readonly" required="required"/></td>
     <td style="width:100px;"><input type="button" value="Delete" onclick="deleteRow(this)" /></td>
  </tr>
</table>
<br/>
<table>
  <tr>
    <td><label class="linetop">Number of Document(s) :</label></td>
    <td>
   		&nbsp;&nbsp;
        <div>
			<input type="text" name="txtrow" id="txtrow" value="1"/>
        </div>
        <input class="box_decaretion" type="text" name="txtrow1" id="txtrow1" value="1" disabled="disabled"/>
   </td>
  </tr>
</table>
</div>
<div><span id="qwert"></span></div>
<input class="buttonManage" type="button" name="btnModuleSave" value="Save" onclick="saveDocument();"/>
<input type="button" class="buttonManage" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
</form>
<script type="text/javascript">
     
        var i = 1;
        function displayResult(){
			var ss = document.getElementById('txtb'+i).value;
			var cc = document.getElementById('txtc'+i).value;
			var x = document.getElementById("myTable").rows.length;
				if(ss != "" && cc != ""){
				var table=document.getElementById("myTable");
				var row=table.insertRow(-1);
				var cell1=row.insertCell(0);
				var cell2=row.insertCell(1);
				var cell3=row.insertCell(2);
				 var cell4=row.insertCell(3);
				cell1.innerHTML="<input style='width:100px;' type='text' name='txta"+(x)+"' id='txta"+(x)+"' value='"+(x)+"'  onKeyPress='return disableEnterKey(event)'  required='required'/>";
				cell2.innerHTML="<input style='width:350px;' type='text' name='txtb"+(x)+"' id='txtb"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)' onclick='popup(1);getValue(this);' readonly='readonly' required='required' />";
				cell3.innerHTML="<input style='width:350px;' type='text' name='txtc"+(x)+"' id='txtc"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)' readonly='readonly' required='required'/>";
				 cell4.innerHTML="<input type='button' value='Delete' onclick='deleteRow(this)'>";
				document.getElementById('txtrow').value = document.getElementById("myTable").rows.length-1;
				document.getElementById('txtrow1').value = document.getElementById("myTable").rows.length-1;
				i++;
				}else{
					alert("Insert to data in befor row");
					//i = document.getElementById("myTable").rows.length;
				}
			
        }
		

		function deleteRow(n){
			var m=n.parentNode.parentNode.rowIndex;
			document.getElementById('myTable').deleteRow(m);
			var num1 = document.getElementById("myTable").rows.length;
			var num2 = num1 - 1;
			//alert(m);
			//alert(num2);
			document.getElementById('txtrow').value = num2;
			document.getElementById('txtrow1').value = num2;
			var y = 1;
			
			var  rowcount = document.getElementById("myTable").rows.length;
			i = rowcount-1;
			for(var mloop=2;mloop <=100;mloop++){
				var elementA =  document.getElementById('txta' + (mloop - 1));
				var elementB =  document.getElementById('txtb' + (mloop - 1));
				var elementC =  document.getElementById('txtc' + (mloop - 1));
				if (elementA != null)
				{
				  // Re-order the sequence of the table rows.............
				  elementA.value = y;
				  
				  //Changing the element ID's to capture in the php
				  elementA.id = 'txta' + y;				  
				  elementB.id = 'txtb' + y;
				  elementC.id = 'txtc' + y;
				  
				  //Changing the element name's to capture in the php				  
  			      elementA.name = 'txta' + y;				  
				  elementB.name = 'txtb' + y;
				  elementC.name = 'txtc' + y;
				  y++;
				}			
			}
		}
		
		function newTbldoc(){
			var mydataSub;
			mydataSub= new XMLHttpRequest();
			mydataSub.onreadystatechange=function(){
				if(mydataSub.readyState==4){
					document.getElementById('newdoctb').innerHTML=mydataSub.responseText;
				}
			}
			var sub1=document.getElementById('selectCodeDoc').value;
			mydataSub.open("GET","ajaxDocumentFile_GroupDoc.php"+"?sub2="+sub1,true);
			mydataSub.send();
		}
        
        function fileSelect(){
				//var no=document.getElementById('txtFilename').value;
				//alert('aa2 - ');
				//document.getElementById('selectFilName').style.visibility = "visible";
				var mydata5;
				mydata5= new XMLHttpRequest();
				mydata5.onreadystatechange=function(){
					if(mydata5.readyState==4){
						document.getElementById('getNewtblPopup').innerHTML=mydata5.responseText;
					}
				}
				var searchup=document.getElementById('popupsearch').value;
				//var no1=document.getElementById('selFileType').value;
				mydata5.open("GET","ajaxEntryPopu1.php"+"?txtsearch="+searchup,true);
				mydata5.send();
			}
            
   function saveDocument(){
        //alert(val_retn);
        var txtrow = document.getElementById('txtrow').value;
        var txtCodeDoc = document.getElementById('selCodeDoc').value;
        if(txtrow == 0){
            alert('Missing Data');
        }else if(txtCodeDoc == ""){
            alert('Select Group Doc Description');
        }else{
            for(var cc = 1; cc <= txtrow; cc++){
                            //alert(val_retn);
                var txtb = document.getElementById('txtb'+cc).value;
                var txtc = document.getElementById('txtc'+cc).value;
                //alert(val_retn +txtb+txtc);
                var mydata5;
                mydata5= new XMLHttpRequest();
                mydata5.onreadystatechange=function(){
                    if(mydata5.readyState==4){
                        document.getElementById('qwert').innerHTML=mydata5.responseText;
                        //alert(cc);
                    }
                }
                //var no1=document.getElementById('selFileType').value;
        		mydata5.open("GET","action_document.php"+"?getCodeDoc="+txtCodeDoc+"&get_txtb="+txtb+"&get_txtc="+txtc+"&get_con="+cc,true);
        		mydata5.send();
            }
            pageClose(); 
        }
        
    }
    </script>

</body>
</html>