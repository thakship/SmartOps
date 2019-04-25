<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Courier Management System
Page Name		: Courier Sub File Management
Purpose			: To Create Courier Sub Files
Author			: Madushan Wikramaara
Date & Time		: 12.26 A.M 20/08/2014 (Modified)
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="cou/e/009";
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
	include ('../../../php_con/function_PHP/reader.php');
	include('../../loguser.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CCourier Sub File Management</title>
<!-- Common function Libariries -->
<!-- CSS-->
<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../CMS_DEVELOPMENT/CSS/courier_Management_System_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../CMS_DEVELOPMENT/JAVASCRIPT_FUNCTION/courier_Management_System_JavaScript.js"></script>
<!--END Common fumction Libariries-->
<script type="text/javascript">
    function pageRef(){
        window.open('http://cdberp:8080/cdb/pages/Courier%20Management%20System/Entry/courier_document_file_Sub.php?DispName=Entering%20Bulk%20Courier%20Items','conectpage');
    }
</script>
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
	function getValue(obj){
    		//alert('id - ' + obj.id);
    		var txtIDnum = obj.id;
			var r = document.getElementById("myTable").rows.length;
			var r1 = r-1
			//alert(r1);
			document.getElementById('tx').value = txtIDnum;
			document.getElementById('ty').value = 'txtc'+r1;
	}
	function documentsub(){
		var nullval=document.getElementById('txtb1').value;
		if(nullval!=""){
			var mydata1;
			mydata1= new XMLHttpRequest();
			mydata1.onreadystatechange=function(){
				if(mydata1.readyState==4){
					document.getElementById('subDocument').innerHTML=mydata1.responseText;
				}
			}
			var doc=document.getElementById('txtb1').value;
			mydata1.open("GET","ajaxDocumentFile_SubFrome.php"+"?txtdoc="+doc,true);
			mydata1.send();
			document.getElementById('btnSave').disabled=false;
		}else{
			alert('Enter Document!');
		}
	}
	function readdata(y,x) {

        // Use the <input type='file'...> object to get a filename without showing the object.
		//alert(y);
		//alert(x);
        //document.all["fileInput"].click();
		
		//alert(fileName);
		var fileget = document.getElementById('txtread').value;
		var filePath = "C:/uploadsCMSExcel/"+ fileget;
		//alert(filePath);
		if(filePath!=""){
			var mydata2;
			mydata2= new XMLHttpRequest();
			mydata2.onreadystatechange=function(){
				if(mydata2.readyState==4){
					document.getElementById('newdoctb1').innerHTML=mydata2.responseText;
				}
			}
			mydata2.open("GET","ajaxDocumentFile_SubFromeOpe.php"+"?txtpartha="+filePath,true);
			mydata2.send();
		}else{
			alert('Enter Document!');
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
<label for="file" class="linetop">Excel File Upload:</label>
<input class="buttonManage" type="file" name="fileGet" id="fileGet" />
<input class="buttonManage" type="submit" id="exup" name="exup" value="Upload" /><br/>
<hr/>
<div style="display: none;">
<input type="text" name="txtUser" id="txtUser" value="<?php echo $_SESSION['user']; ?>"  onkeypress="return disableEnterKey(event)"/>
<input type="text" name="txtubranch" id="txtubranch" value="<?php echo $_SESSION['userBranch']; ?>"  onkeypress="return disableEnterKey(event)"/>
<input type="text" name="txtuDepartment" id="txtuDepartment" value="<?php echo $_SESSION['userDepartment']; ?>"  onkeypress="return disableEnterKey(event)"/>
</div>
<table>
    <tr>
        <td style=" width:110px;"><label class="linetop">Courier &nbsp;&nbsp;&nbsp;Reference : <span style="color: #E10000;">*</span></label></td>
        <td>
        <?php 
            $sql_date = "SELECT `currentDate` FROM `systemdate`;";
            $que_date = mysqli_query($conn, $sql_date);
            while($res_date = mysqli_fetch_array($que_date)){
               echo "<input style='width:80px;background-color: #C3C3C3;' class='box_decaretion' type='text' name='txtFName1' id='txtFName1' value='".$res_date[0]."'  onkeypress='return disableEnterKey(event)' readonly='readonly'/>"; 
            }
        ?>
            <input style="width:100px;background-color: #C3C3C3;" class="box_decaretion" type="text" name="txtFName2" id="txtFName2" value="<?php
                if($_SESSION['userBranch'] == '0001'){
                    echo $_SESSION['userDepartment'];
                }else{
                    echo $_SESSION['userBranch'];
                }
            ?>"  onkeypress="return disableEnterKey(event)" readonly="readonly"/>
   		    <input style="width:250px;" class="box_decaretion" type="text" name="txtFName" id="txtFName" value=""  onkeypress="return disableEnterKey(event)"/>
            <label class="linetop"> (ex : Client Code , ID Numbers , Iterm Name)</label>
        </td>
  </tr>
  <tr>
  <td style=" width:110px;"><label class="linetop">Courier Type : <span style="color: #E10000;">*</span></label></td>
    <td>
    	<select class="box_decaretion" name="selFileType" id="selFileType" onkeypress="return disableEnterKey(event)">
            <option value="Normal">Normal</option>
            <option value="Special ">Special</option>
        </select>
    </td>
  </tr>
</table>
<table>
  <tr>
    <td style=" width:110px;"><label class="linetop">Receiving <br/> &nbsp;&nbsp;&nbsp;Branch : <span style="color: #E10000;">*</span></label></td>
    <td>
    	<?php
			$addsql01="SELECT `branchNumber`,`branchName` FROM `branch`  WHERE `branchNumber`!='".$_SESSION['userBranch']."';";
			$quary101 = mysqli_query($conn,$addsql01);
		?>
        <select class="box_decaretion" name="selBranchNumber" id="selBranchNumber" onkeypress="return disableEnterKey(event)" onchange="department()">
            			<option value="">--Select Branch Name--</option>
            			<?php
			 				while ($rec1 = mysqli_fetch_array($quary101)){
			 					echo "<option value='".$rec1[0]."'>".$rec1[1]."</option>";
			 				}
						?>
            		</select>
    </td>
     <td><label class="linetop">Receiving Department : <span style="color: #E10000;">*</span></label></td>
     <td>
    	 <div id="diva">
    		 &nbsp;&nbsp; <select class="box_decaretion" name="selDepartmentNumber" id="selDepartmentNumber" onkeypress="return disableEnterKey(event)">
            	 		  	<option value="">--Select Department Name--</option>
              			  </select>
         </div>
    </td>
    <td><label class="linetop">Receiving Officer :</label></td>
    <td>
    	&nbsp;&nbsp;<input class="box_decaretion" type="text" required="required" name="txtResiveOfficer" id="txtResiveOfficer" value=""  onkeypress="return disableEnterKey(event)"/>
    	</td>
  </tr>
</table>
<table>
	<tr>
    <td style=" width:110px; vertical-align:top;"><label class="linetop">Remarks :</label></td>
    <td>
   		<textarea class="box_decaretion" rows="3" cols="40" name="txtareSN" id="txtareSN"></textarea>
   </td>
  </tr>
</table>
<table>
  <tr>
    <td style=" width:110px; vertical-align:top;"><label class="linetop">Previous File &nbsp;&nbsp;&nbsp;&nbsp;Number :</label></td>
    <td>
   		<input style="width:250px;" class="box_decaretion" type="text" name="txtPreFNum" id="txtPreFNum" value=""  onkeypress="return disableEnterKey(event)" />
   </td>
  </tr>
</table><br/>
<hr /> 
<br/>
	<div id="outer">
		
	</div>
	<div id="conten">
		<p class="topline">Search Document 
        <input class="buttonManage" style="margin-left:200px;" type="button" onclick="popup(0)" value="Colse" id="popupclose" name="popupclose" />
        </p>
        <div style='display:none;'>
        <input style="width:100px;" type="text" name="tx" id="tx" value=""  onkeypress="return disableEnterKey(event)" readonly='readonly' required='required'/>
        <input style="width:100px;" type="text" name="ty" id="ty" value=""  onkeypress="return disableEnterKey(event)" readonly='readonly' required='required'/>
        </div>
        Search Document name : <input class="box_decaretion" style="width:200px; background-color:#E0E0E0;" type="text" name="popupsearch" id="popupsearch" value=""/> 
        <input class="buttonManage" type="button" value="Search" id="popupSearchBTN" name="popupSearchBTN" onclick="fileSelect()" />
        <script>
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
	
        </script>
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
                        echo "<input style='font-size: 12px;' type='button' id='btnselect".$a."' name='btnselect".$a."' value='Select' onclick='selectDB".$a."();popup(0);'/>";
                        echo "</td>";
                        echo "</tr>";
                        $a++;
                    }
                ?>
			</table>
            </div>
	</div>
    <div id="outer1">
		
	</div>
    <div id="conten1">
    	 <?php
		$selectGDN = "SELECT `groupCodeDoc`,`groupDetels` FROM `courier_groupdoctype`";
		$add_selectGDN = mysqli_query($conn,$selectGDN);
		?>
    <table style="text-align: left;" border="0">
    <tr>
    	<td style="width:200px; vertical-align:middle"><p class="linetop">Select Group Doc Description </p></td>
 		<td> 
          <select class="box_decaretion" name="selectCodeDoc" id="selectCodeDoc" onkeypress="return disableEnterKey(event)">
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
    </div>
    <script>
        var i = 1;
        function displayResult(){
			var ss = document.getElementById('txtbb'+i).value;
			var cc = document.getElementById('txtcc'+i).value;
			var x = document.getElementById("myTable1").rows.length;
				if(ss != "" && cc != ""){
				var table=document.getElementById("myTable1");
				var row=table.insertRow(-1);
				var cell1=row.insertCell(0);
				var cell2=row.insertCell(1);
				var cell3=row.insertCell(2);
				 var cell4=row.insertCell(3);
				cell1.innerHTML="<input style='width:100px;' type='text' name='txtaa"+(x)+"' id='txtaa"+(x)+"' value='"+(x)+"'  onKeyPress='return disableEnterKey(event)'  required='required'/>";
				cell2.innerHTML="<input style='width:350px;' type='text' name='txtbb"+(x)+"' id='txtbb"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)' required='required'/>";
				cell3.innerHTML="<input style='width:350px;' type='text' name='txtcc"+(x)+"' id='txtcc"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)' required='required'/>";
				cell4.innerHTML="<input type='button' value='Delete' onclick='deleteRow(this)'>";
				document.getElementById('txtrow').value = document.getElementById("myTable1").rows.length-1;
				document.getElementById('txtrow1').value = document.getElementById("myTable1").rows.length-1;
				i++;
				}else{
					alert("Insert to data in befor row");
					//i = document.getElementById("myTable").rows.length;
				}
			
        }
		function deleteRow(n){
			var m=n.parentNode.parentNode.rowIndex;
			document.getElementById('myTable1').deleteRow(m);
			var num1 = document.getElementById("myTable1").rows.length;
			var num2 = num1 - 1;
			//alert(m);
			//alert(num2);
			document.getElementById('txtrow').value = num2;
			document.getElementById('txtrow1').value = num2;
			var y = 1;
			
			var  rowcount = document.getElementById("myTable1").rows.length;
			i = rowcount-1;
			for(var mloop=2;mloop <=100;mloop++){
				var elementA =  document.getElementById('txtaa' + (mloop - 1));
				var elementB =  document.getElementById('txtbb' + (mloop - 1));
				var elementC =  document.getElementById('txtcc' + (mloop - 1));
				if (elementA != null)
				{
				  // Re-order the sequence of the table rows.............
				  elementA.value = y;
				  
				  //Changing the element ID's to capture in the php
				  elementA.id = 'txtaa' + y;				  
				  elementB.id = 'txtbb' + y;
				  elementC.id = 'txtcc' + y;
				  
				  //Changing the element name's to capture in the php				  
  			      elementA.name = 'txtaa' + y;				  
				  elementB.name = 'txtbb' + y;
				  elementC.name = 'txtcc' + y;
				  y++;
				}			
			}
		}
var metaChar = false;
var exampleKey = 120;

function keyEvent(event) {
  var key = event.keyCode || event.which;
  var keychar = String.fromCharCode(key);
  if (key == exampleKey) {
    metaChar = true;
  }
  if (key != exampleKey) {
    if (metaChar) {
      alert("Combination of metaKey + " + keychar);
      metaChar = false;
    } else {
      /*alert("Key pressed " + key);*/
    }
  }else{
  	/*alert("Key pressed " + key);*/
	 var o = 1;
			var ss = document.getElementById('txtbb'+o).value;
			var cc = document.getElementById('txtcc'+o).value;
			var x = document.getElementById("myTable1").rows.length;
				if(ss != "" && cc != ""){
				var table=document.getElementById("myTable1");
				var row=table.insertRow(-1);
				var cell1=row.insertCell(0);
				var cell2=row.insertCell(1);
				var cell3=row.insertCell(2);
				 var cell4=row.insertCell(3);
				cell1.innerHTML="<input style='width:100px;' type='text' name='txtaa"+(x)+"' id='txtaa"+(x)+"' value='"+(x)+"'  onkeypress='return disableEnterKey(event)'  required='required'/>";
				cell2.innerHTML="<input style='width:350px;' type='text' name='txtbb"+(x)+"' id='txtbb"+(x)+"' value=''  onkeypress='return disableEnterKey(event)' required='required'/>";
				cell3.innerHTML="<input style='width:350px;' type='text' name='txtcc"+(x)+"' id='txtcc"+(x)+"' value=''  onkeypress='return disableEnterKey(event)' required='required'/>";
				cell4.innerHTML="<input type='button' value='Delete' onclick='deleteRow(this)'>";
				document.getElementById('txtrow').value = document.getElementById("myTable1").rows.length-1;
				document.getElementById('txtrow1').value = document.getElementById("myTable1").rows.length-1;
				o++;
				}else{
					alert("Insert to data in befor row");
					//i = document.getElementById("myTable").rows.length;
				}
  }
}

function metaKeyUp (event) {
  var key = event.keyCode || event.which;

  if (key == exampleKey) {
    metaChar = false;
  }
}
    </script>
 <div id="newdoctb">
 <table width="921" border="1" id="myTable" style="width:800px;">
  <tr style="width:800px;" class="tbl1">
    <td width="100" style="width:100px;">Index</td>
    <td width="350" style="width:350px;">Document Number</td>
    <td width="449" style="width:350px;">Document Name</td>
    <td width="449" style="width:100px;"></td>
  </tr>
  <tr style="width:800px;">
    <td style="width:100px;"><input style="width:100px;" type="text" name="txta1" id="txta1" value="1"  onkeypress="return disableEnterKey(event)" readonly='readonly' /></td>
    <td style="width:350px;"><input style="width:350px;" type="text" name="txtb1" id="txtb1" value=""  onkeypress="return disableEnterKey(event)" onclick="popup(1);getValue(this);"/></td>
    <td style="width:350px;"><input style="width:350px;" type="text" name="txtc1" id="txtc1" value=""  onkeypress="return disableEnterKey(event)" readonly='readonly'/></td>
     <td style="width:100px;"><input type="button" value="Edit" onclick="documentsub()" /></td>
  </tr>
</table>
<br/>
<div id="subDocument">
	
</div>
</div>
<br/>
<input type="button" style="width: 100px;" class="buttonManage" id="btnSave" name="btnSave" value="Save" onclick="pageSAVE()" disabled="disabled"/>
<!--<input class="buttonManage" type="submit" style="width:100px;" id="btnDFSave" name="btnDFSave" value="Save" disabled="disabled"/>-->
<script>
    function pageSAVE(){
        //alert('aaa');
        var txtrow = 0 ;
        var fileName = document.getElementById('txtFName').value;
        var fileName1 = document.getElementById('txtFName1').value;
        var fileName2 = document.getElementById('txtFName2').value;
        var fname = fileName1+" "+fileName2+" "+fileName;
        var selFileType = document.getElementById('selFileType').value;
        var selBranchNumber = document.getElementById('selBranchNumber').value;
        var selDepartmentNumber = document.getElementById('selDepartmentNumber').value;
        var txtResiveOfficer = document.getElementById('txtResiveOfficer').value;
        var txtareSN = document.getElementById('txtareSN').value;
        var txtPreFNum = document.getElementById('txtPreFNum').value;
        var txtb1_doc = document.getElementById('txtb1').value;
        var txtc1_doc = document.getElementById('txtc1').value;
        var txtUser = document.getElementById('txtUser').value;
        var txtubranch = document.getElementById('txtubranch').value;
        var txtuDepartment = document.getElementById('txtuDepartment').value;
        var txtrow = document.getElementById('txtrow').value;
        //alert(fname+'--'+selFileType+'--'+selBranchNumber+'--'+selDepartmentNumber+'--'+txtResiveOfficer+'--'+txtareSN+'--'+txtPreFNum);
        if(fileName == ""){
            alert("File name is missing.");
        }else if(selBranchNumber == ""){
            alert("Branch is missing.");
        }else if(selDepartmentNumber == ""){
            alert("Department is missing.");
        }else if(txtb1_doc == ""){
            alert("Document is missing.");
        }else if(txtResiveOfficer == ""){
                alert("Resive Officer is missing.");
        }else{
            //alert(txtrow);
            var get_txt_sub = 'YES';
           for(var q = 1; q <= txtrow; q++){
                var txt_sub = "";
                var get_txt_sub = 'YES';
                //txt_sub = document.getElementById('txtbb'+q).value;
                //alert(txt_sub);
                if((document.getElementById('txtbb'+q).value == "") ||  (document.getElementById('txtcc'+q).value == "")){
                    var get_txt_sub = q;
                    //alert(get_txt_sub);
                    break;
                }
            }
           if(get_txt_sub != 'YES'){
                alert(q+" row : Data is missing.");
            }else{
                //alert('ok');
                var r = confirm('Are you sure you want to save this?')
                if (r==true){
                    //alert('aaa');
                   	$.ajax({ 
    				    type:'POST', 
    				    data: {get_fname : fname , get_selFileType : selFileType , get_selBranchNumber : selBranchNumber , get_selDepartmentNumber : selDepartmentNumber , get_txtResiveOfficer : txtResiveOfficer , get_txtareSN : txtareSN , get_txtPreFNum : txtPreFNum , get_txtrow : txtrow , get_txtUser : txtUser , get_txtubranch : txtubranch , get_txtuDepartment : txtuDepartment , get_txtb1_doc : txtb1_doc , get_txtc1_doc : txtc1_doc }, 
    				    url: '../CMS_DEVELOPMENT/PHP_FUNCTION/sub_document_save_function.php', 
    				    success: function(val_retn) { 
    				        //alert(val_retn); 
                            //pageCloseDefineLetterTypes();
                            document.getElementById('txtuDepartment').value = val_retn;
                            saveDocument(val_retn);
    				    }
    			     });	
                    alert('Record Successfully Saved!');
				    pageRef();  
                }
            }
        }
    }
    function saveDocument(val_retn){
       //alert(val_retn);
        var txtrow = document.getElementById('txtrow').value;
        var txtb1 = document.getElementById('txtb1').value;
        for(var cc = 1; cc <= txtrow; cc++){
                            //alert(val_retn);
            var txtb = document.getElementById('txtbb'+cc).value;
            var txtc = document.getElementById('txtcc'+cc).value;
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
    		mydata5.open("GET","../CMS_DEVELOPMENT/PHP_FUNCTION/sub_document_save_function.php"+"?get_fnumber="+val_retn+"&get_txtb="+txtb+"&get_txtc="+txtc+"&get_txtb1_sub_doc="+txtb1,true);
    		mydata5.send();
        }
    }
</script>
<div style="display: none;"><span id="qwert"></span></div>
<?php
    if(isset($_POST['exup']) && $_POST['exup']=='Upload'){
	   //$file = 'fileGet';
        $allowedExts = array("xls");
        $temp = explode(".", $_FILES["fileGet"]["name"]);
        $extension = end($temp);
        if(($_FILES["fileGet"]["type"] == "application/vnd.ms-excel") && ($_FILES["fileGet"]["size"] < 500000) && in_array($extension, $allowedExts)){
            if($_FILES["fileGet"]["error"] > 0){
                echo "Return Code: " . $_FILES["fileGet"]["error"] . "<br>";
            }else{
                //echo "Upload: " . $_FILES["fileGet"]["name"] . "<br>";
				$_SESSION['fileGetName'] = $_FILES["fileGet"]["name"];
				//echo "Type: " . $_FILES["fileGet"]["type"] . "<br>";
				//echo "Size: " . ($_FILES["fileGet"]["size"] / 1024) . " kB<br>";
				//echo "Temp file: " . $_FILES["fileGet"]["tmp_name"] . "<br>";
				$sql = "SELECT `currentDate` FROM `systemdate` WHERE `index`='1'";
				$add = mysqli_query($conn,$sql);
				while($rec = mysqli_fetch_array($add)){
				    $dateNow = $rec[0];
				}
                if(file_exists("C:/uploadsCMSExcel/" .$_SESSION['user'].$dateNow.$_FILES["fileGet"]["name"])){
				    //echo $_FILES["fileGet"]["name"] . " already exists. ";
				    echo "<script> alert('already exists');</script>";
				    $_SESSION['fileGetName']="";	
                }else{
	      	        move_uploaded_file($_FILES["fileGet"]["tmp_name"],
	                   "C:/uploadsCMSExcel/" .$_SESSION['user'].$dateNow.$_FILES["fileGet"]["name"]);
   					//echo "Stored in: " . "C:/aa/" . $_FILES["fileGet"]["name"];
				    echo "<script> alert('Uploaded file');</script>";
				    echo " <div style='display:none;'><input type='text' name='txtread' id='txtread' value='".$_SESSION['user'].$dateNow.$_SESSION['fileGetName']."'  onKeyPress='return disableEnterKey(event)'readonly /></div><br/>";
				    $_SESSION['fileGetName']="";
				}
 			}
        }else{
            echo "Invalid file";
        }
    }
		
?>
 <input type="button" class="buttonManage" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
</form>
</body>
</html>